<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

if(isset($_POST['submit']))
{
    $title = $_POST['title'];
    $age = $_POST['age'];
    $weight = $_POST['weight'];
    $quantity = $_POST['quantity'];
    $entry_date = $_POST['entry_date'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $status = 1;

    $query = "INSERT INTO `chicks_stock`(`title`,`age`, `weight`, `quantity`, `entry_date`, `price`, `status`, `type`) VALUES ('$title','$age', '$weight', '$quantity', '$entry_date', '$price', '$status', '$type')";
    $result = mysqli_query($con, $query);

    if($result)
    {
        ?>
        <script>
            window.location.href = "chickenStockList.php";
        </script>
        <?php
    }
    else 
    {
        $msg = "chickenStock Insertion Failed ".mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Chicken Stock</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Chicken Stock</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    
                    <div class="col-6">
                        <label for="inputWeight" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="inputWeight" required>
                    </div>
                    <div class="col-6">
                        <label for="inputAge" class="form-label">Age (in days) </label>
                        <input type="text" name="age" class="form-control" id="inputAge" required>
                    </div>
                    <div class="col-6">
                        <label for="inputWeight" class="form-label">Weight</label>
                        <input type="number" name="weight" class="form-control" id="inputWeight" required>
                    </div>
                    <div class="col-6">
                        <label for="inputQuantity" class="form-label">Quantity</label>
                        <input type="text" name="quantity" class="form-control" id="inputQuantity" required>
                    </div>
                    <div class="col-4">
                        <label for="inputDate" class="form-label">Entry date</label>
                        <input type="date" name="entry_date" class="form-control" id="inputDate" required>
                    </div>
                    <div class="col-4">
                        <label for="inputPrice" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" id="inputPrice" required>
                    </div>
                    <div class="col-4">
                        <label for="inputType" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" id="inputType" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <p class="text-danger"><?php echo $msg ; ?></p>
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
    var age = document.getElementById("inputAge").value;
    var quantity = document.getElementById("inputQuantity").value;
    var price = document.getElementById("inputPrice").value;
    var type = document.getElementById("inputType").value;

    var digitRegex = /^\d+$/;

    if (!digitRegex.test(age)) {
        alert("Age must be only digits.");
        return false;
    }

    if (!digitRegex.test(quantity)) {
        alert("Quantity must be only digits.");
        return false;
    }

    if (!digitRegex.test(price)) {
        alert("Price must be only digits.");
        return false;
    }

    if (type.trim() === "") {
        alert("Type cannot be empty.");
        return false;
    }

    return true;
}
</script>
