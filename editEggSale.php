<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

$id = $_GET['id'];

$eggQuery = "SELECT * FROM `egg_sale` WHERE id = '$id' ";
$eggResult = mysqli_query($con, $eggQuery);
$eggRow = mysqli_fetch_assoc($eggResult);

if(isset($_POST['submit'])) {
    $id = $_GET['id'];
    $date = date('Y-m-d');
    $time = date('h:i');
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];
    $price_per_egg = $_POST['price_per_egg'];
    $customer_id = $_POST['customer_id'];
    $status = '1';
    $paid_amount = $_POST['paid_amount'];
    $remaining = $_POST['remaining'];
    
    $query = "UPDATE `egg_sale` SET `created_at`='$date',`amount`='$amount',`quantity`='$quantity',`price_per_egg`='$price_per_egg',
    `customer_id`='$customer_id',
    `status`='1',`time`='$time',`paid_amount`='$paid_amount',`remaining`='$remaining'  where id = '$id' ";
    $result = mysqli_query($con, $query);
    
    if($result) {
        ?>
        <script>
            window.location.href = "eggSaleList.php";
        </script>
        <?php
    } else {
        $msg = "Egg Sale Insertion Failed ".mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Edit Egg Sale</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Edit Egg Sale</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3">
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
                        <label for="inputQuantity" class="form-label">Quantity</label>
                        <input type="text" name="quantity" value="<?php echo $eggRow['quantity']; ?> " class="form-control" id="inputQuantity" oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputPrice" class="form-label">Price Per Egg</label>
                        <input type="text" name="price_per_egg" value="<?php echo $eggRow['price_per_egg']; ?> " class="form-control" id="inputPrice" oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" value="<?php echo $eggRow['amount']; ?> " class="form-control" id="inputAmount" readonly>
                    </div>
                    <div class="col-6">
                        <label for="inputPaidAmount" class="form-label">Paid Amount</label>
                        <input type="text" name="paid_amount" value="<?php echo $eggRow['paid_amount']; ?> " class="form-control" id="inputPaidAmount" oninput="calculateRemaining()">
                    </div>
                    <div class="col-6">
                        <label for="inputRemaining" class="form-label">Remaining</label>
                        <input type="text" name="remaining" value="<?php echo $eggRow['remaining']; ?> " class="form-control" id="inputRemaining" readonly>
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
    var quantity = document.getElementById('inputQuantity').value;
    var price = document.getElementById('inputPrice').value;
    var amountField = document.getElementById('inputAmount');

    if (!isNaN(quantity) && !isNaN(price) && quantity > 0 && price > 0) {
        var amount = parseFloat(quantity) * parseFloat(price);
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
</script>
