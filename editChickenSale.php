<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

$id = $_GET['id'];

$chickenQuery = "select *From chicken_sale where id = '$id' ";
$chickenResult = mysqli_query($con, $chickenQuery);
$chickenRow = mysqli_fetch_assoc($chickenResult);



if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $date = date('Y-m-d');
    $time = date('h:i');
    $amount = $_POST['amount'];
    $kg = $_POST['kg'];
    $price_per_kg = $_POST['price_per_kg'];
    $customer_id = $_POST['customer_id'];
    $paid_amount = $_POST['paid_amount'];
    $remaining = $_POST['remaining'];
    $status = '1';
    
    
        $query = "UPDATE `chicken_sale` SET `created_at`='$date',
        `amount`='$amount',`kg`='$kg',`price_per_kg`='$price_per_kg',`customer_id`='$customer_id',
                  `status`='1',`paid_amount`='$paid_amount',`remaining`='$remaining',`time`='$time'
                  WHERE id = '$id' ";
       
        $result = mysqli_query($con, $query);
        
        if($result) {
            ?>
            <script>
                window.location.href = "chickeSaleList.php";
            </script>
            <?php
        } else {
            $msg = "Chicken Sale Updation Failed: " . mysqli_error($con);
        }
    
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Edit Chicken Sale</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Chicken Sale</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputName1" class="form-label">Customer</label>
                        <select name="customer_id" class="form-control">
                            <?php 
                            $customerQuery = "SELECT * FROM customer";
                            $customerResult = mysqli_query($con, $customerQuery);
                            while($customerRow = mysqli_fetch_assoc($customerResult)) {
                            ?>
                            <option value="<?php echo $customerRow['id']; ?>"><?php echo $customerRow['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                   
                    <div class="col-6">
                        <label for="inputKG" class="form-label">KG</label>
                        <input type="text" name="kg"  value="<?php echo $chickenRow['kg']; ?> " class="form-control" id="inputKG" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputPrice" class="form-label">Price Per KG</label>
                        <input type="text" name="price_per_kg" value="<?php echo $chickenRow['price_per_kg']; ?> " class="form-control" id="inputPrice" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" value="<?php echo $chickenRow['amount']; ?> " class="form-control" id="inputAmount" required readonly>
                    </div>
                     <div class="col-6">
                        <label for="inputPaidAmount" class="form-label">Paid Amount</label>
                        <input type="text" name="paid_amount" value="<?php echo $chickenRow['paid_amount']; ?> " class="form-control" id="inputPaidAmount" required oninput="calculateRemaining()">
                    </div>
                     <div class="col-6">
                        <label for="inputRemaining" class="form-label">Remaining</label>
                        <input type="text" name="remaining" value="<?php echo $chickenRow['remaining']; ?> " class="form-control" id="inputRemaining" required readonly>
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
function calculateAmount() {
    var kg = document.getElementById('inputKG').value;
    var price = document.getElementById('inputPrice').value;
    var amountField = document.getElementById('inputAmount');

    if (!isNaN(kg) && !isNaN(price) && kg > 0 && price > 0) {
        var amount = parseFloat(kg) * parseFloat(price);
        amountField.value = amount.toFixed(2);
    } else {
        amountField.value = '';
    }

    calculateRemaining(); // Recalculate remaining if amount changes
}

function calculateRemaining() {
    var amount = document.getElementById('inputAmount').value;
    var paidAmount = document.getElementById('inputPaidAmount').value;
    var remainingField = document.getElementById('inputRemaining');

    if (!isNaN(amount) && !isNaN(paidAmount) && amount > 0 && paidAmount >= 0) {
        var remaining = parseFloat(amount) - parseFloat(paidAmount);
        remainingField.value = remaining.toFixed(2);
    } else {
        remainingField.value = '';
    }
}

function validateForm() {
    var kg = document.getElementById('inputKG').value;
    var price = document.getElementById('inputPrice').value;
    var amount = document.getElementById('inputAmount').value;

    // Validate KG (numeric and positive)
    if (isNaN(kg) || parseFloat(kg) <= 0) {
        alert("Invalid KG. Please enter a valid numeric value.");
        return false;
    }

    // Validate Price (numeric and positive)
    if (isNaN(price) || parseFloat(price) <= 0) {
        alert("Invalid price per KG. Please enter a valid numeric price.");
        return false;
    }

    // Validate Amount (numeric and positive)
    if (isNaN(amount) || parseFloat(amount) <= 0) {
        alert("Invalid amount. Please enter a valid numeric amount.");
        return false;
    }

    return true; // Form submission allowed
}
</script>
