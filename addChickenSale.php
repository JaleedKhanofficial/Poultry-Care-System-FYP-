<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";
$showAlert = false; // Flag to determine whether to show the alert

if(isset($_POST['submit'])) {
    $date = date('Y-m-d');
    $time = date('h:i');
    $amount = $_POST['amount'];
    $kg = $_POST['kg'];
    $price_per_kg = $_POST['price_per_kg'];
    $customer_id = $_POST['customer_id'];
    $paid_amount = $_POST['paid_amount'];
    $remaining = $_POST['remaining'];
    $chicken_stock_id = $_POST['chicken_stock_id'];
    $status = '1';
    
    // Server-side validation
    if (!is_numeric($amount) || $amount <= 0) {
        $msg = "Invalid amount. Please enter a valid numeric amount.";
    } elseif (!is_numeric($kg) || $kg <= 0) {
        $msg = "Invalid KG. Please enter a valid numeric value.";
    } elseif (!is_numeric($price_per_kg) || $price_per_kg <= 0) {
        $msg = "Invalid price per KG. Please enter a valid numeric price.";
    } else {
        $q = "SELECT * FROM chicks_stock WHERE id = '$chicken_stock_id'";
        $r = mysqli_query($con, $q);
        $rr = mysqli_fetch_assoc($r);
        
        $date1 = new DateTime($rr['entry_date']);
        $date2 = new DateTime($date);
        $interval = $date1->diff($date2)->days;
        
        ?>
          <script>
                 console.log(<?php echo $interval; ?> );
          </script>
        <?php
        
        if($interval > 30) {
            $query = "INSERT INTO `chicken_sale`(`created_at`, `amount`, `kg`, `price_per_kg`, `customer_id`, `status`, 
            `time`, `paid_amount`, `remaining`, `chick_stock_id`)
            VALUES ('$date', '$amount', '$kg', '$price_per_kg', '$customer_id', '$status', '$time', '$paid_amount', '$remaining',
            '$chicken_stock_id')";
            $result = mysqli_query($con, $query);
        
            if($result) {
                ?>
                <script>
                    window.location.href = "chickeSaleList.php";
                </script>
                <?php
            } else {
                $msg = "Chicken Sale Insertion Failed: " . mysqli_error($con);
            }
        } else {
            $showAlert = true; // Set the flag to true if the interval is less than 30 days
        }
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Chicken Sale</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Chicken Sale</h5>

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
                        <input type="text" name="kg" class="form-control" id="inputKG" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                         <label for="inputStock" class="form-label">Chicken Stock </label>
                         <select name="chicken_stock_id" class="form-control">
                             <?php 
                               $query = "SELECT `id`, `age`, `weight`, `quantity`, `entry_date`, `price`, `status`, `type`, `title` FROM `chicks_stock`";
                               $result = mysqli_query($con, $query);
                               while($row = mysqli_fetch_assoc($result)) {
                                   ?>
                                 <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                                   <?php
                               }
                               ?>
                         </select>
                    </div>
                    <div class="col-6">
                        <label for="inputPrice" class="form-label">Price Per KG</label>
                        <input type="text" name="price_per_kg" class="form-control" id="inputPrice" required oninput="calculateAmount()">
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" id="inputAmount" required readonly>
                    </div>
                     <div class="col-6">
                        <label for="inputPaidAmount" class="form-label">Paid Amount</label>
                        <input type="text" name="paid_amount" class="form-control" id="inputPaidAmount" required oninput="calculateRemaining()">
                    </div>
                     <div class="col-6">
                        <label for="inputRemaining" class="form-label">Remaining</label>
                        <input type="text" name="remaining" class="form-control" id="inputRemaining" required readonly>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <p class="mt-2 text-danger"><?php echo $msg; ?></p>
                    </div>
                </form><!-- Vertical Form -->

                <!-- Alert Message -->
                <?php if ($showAlert): ?>
                <div class="alert alert-danger" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">
                    Chickens are not ready for sale. Please wait until they are 30 days old.
                </div>
                <?php endif; ?>

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
