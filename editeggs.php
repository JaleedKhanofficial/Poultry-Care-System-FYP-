<?php 
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";
$id = $_GET['id'];
$query = "SELECT * FROM eggs WHERE id = '$id'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    $amount = $_POST['amount'];
    $price_per_egg = $_POST['price_per_egg'];

    // Server-side validation
    if (!is_numeric($quantity) || $quantity <= 0) {
        $msg = "Invalid quantity. Please enter a valid numeric value.";
    } elseif (!is_numeric($amount) || $amount <= 0) {
        $msg = "Invalid amount. Please enter a valid numeric amount.";
    } else {
        $query = "UPDATE eggs SET date='$date', quantity='$quantity', amount='$amount', price_per_egg='$price_per_egg' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            ?>
            <script>
                window.location.href = "eggsList.php";
            </script>
            <?php
        } else {
            $msg = "Eggs updation failed: " . mysqli_error($con);
        }
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Eggs</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Eggs</li>
                <li class="breadcrumb-item">Eggs List</li>
                <li class="breadcrumb-item active">Edit Eggs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Eggs</h5>

                        <form method="POST" class="row g-3" onsubmit="return validateForm()">
                            <div class="col-md-6">
                                <label for="inputName5" class="form-label">Date</label>
                                <input type="date" name="date" value="<?php echo $row['date']; ?>" class="form-control" id="inputName5" required>
                            </div>
                              <div class="col-md-6">
                                <label for="inputPricePerEgg" class="form-label">Price Per Egg</label>
                                <input type="text" name="price_per_egg" value="<?php echo $row['price_per_egg']; ?>" class="form-control" id="inputPricePerEgg" required oninput="calculateAmount()">
                            </div>
                            <div class="col-md-6">
                                <label for="inputQuantity" class="form-label">Quantity</label>
                                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" class="form-control" id="inputQuantity" required oninput="calculateAmount()">
                            </div>
                            <div class="col-6">
                                <label for="inputAmount" class="form-label">Amount</label>
                                <input type="text" name="amount" value="<?php echo $row['amount']; ?>" class="form-control" id="inputAmount" readonly>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <p class="mt-2 text-danger"><?php echo $msg; ?></p>
                        </form><!-- End Multi Columns Form -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include('include/footer.inc.php');
?>
    
<script>
function validateForm() {
    var quantity = document.getElementById('inputQuantity').value;
    var amount = document.getElementById('inputAmount').value;

    // Validate Quantity (numeric and positive)
    if (isNaN(quantity) || parseFloat(quantity) <= 0) {
        alert("Invalid quantity. Please enter a valid numeric value.");
        return false;
    }

    // Validate Amount (numeric and positive)
    if (isNaN(amount) || parseFloat(amount) <= 0) {
        alert("Invalid amount. Please enter a valid numeric amount.");
        return false;
    }

    return true; // Form submission allowed
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
