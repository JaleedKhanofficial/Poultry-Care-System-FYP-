<?php
include('include/connection.inc.php');
include('include/header.inc.php');
$msg = "";

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $amount  = $_POST['amount'];
    $price_per_egg = $_POST['price_per_egg'];

    $query = "INSERT INTO eggs(date, quantity, chicks_stock_id, amount,  price_per_egg)
    VALUES ('$date', '$quantity', '3', '$amount', '$price_per_egg')";
    $result = mysqli_query($con, $query);

   ?>
     <script>
          window.location.href = "https://jafasa.com/ChickenFarm/eggsList.php";
     </script>
   <?php
    if ($result) {
        echo '<script>showAlert("Eggs successfully inserted!", "success");</script>';
    } else {
        $msg = "Eggs not inserted: " . mysqli_error($con);
        echo '<script>showAlert("Eggs not inserted. ' . $msg . '", "error");</script>';
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Eggs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Eggs</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="inputDate" required>
                    </div>
                     <div class="col-6">
                        <label for="inputPricePerEgg" class="form-label">Price Per Egg</label>
                        <input type="number" name="price_per_egg" class="form-control" id="inputPricePerEgg" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputQuantity" class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="inputQuantity" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" id="inputAmount" readonly>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <p class="mt-2 text-danger"><?php echo $msg; ?></p>
                    </div>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php
include('include/footer.inc.php');
?>

<script>
function validateForm() {
    var quantity = document.getElementById("inputQuantity").value;
    var amount = document.getElementById("inputAmount").value;
    
    var digitRegex = /^\d+$/;

    if (!digitRegex.test(quantity)) {
        alert("Quantity must contain only digits.");
        return false;
    }
    
    if (!digitRegex.test(amount)) {
        alert("Amount must contain only digits.");
        return false;
    }
    
    return true;
}

function showAlert(message, type) {
    var alertDiv = document.createElement('div');
    alertDiv.className = 'custom-alert show';
    alertDiv.textContent = message;

    if (type === 'success') {
        alertDiv.style.backgroundColor = '#4CAF50'; // Green color for success
    } else if (type === 'error') {
        alertDiv.style.backgroundColor = '#f44336'; // Red color for error
    }

    document.body.appendChild(alertDiv);

    setTimeout(function() {
        alertDiv.classList.remove('show');
        setTimeout(function() {
            alertDiv.remove();
        }, 400);
    }, 3000); // Remove after 3 seconds
}

function calculateAmount() {
    var pricePerEgg = document.getElementById("inputPricePerEgg").value;
    var quantity = document.getElementById("inputQuantity").value;
    var amountField = document.getElementById("inputAmount");

    if (pricePerEgg && quantity) {
        var amount = pricePerEgg * quantity;
        amountField.value = amount;
    } else {
        amountField.value = '';
    }
}
</script>

<style>
/* Custom alert styles */
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 15px;
    background-color: #4CAF50; /* Green background color */
    color: white;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 9999;
    display: none; /* Initially hidden */
}

.custom-alert.show {
    display: block; /* Show when it has 'show' class */
}
</style>
