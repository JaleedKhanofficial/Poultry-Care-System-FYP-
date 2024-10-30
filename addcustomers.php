<?php
include('include/connection.inc.php');
include('include/header.inc.php');
   
$msg = "";

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $created_at = date('d-m-Y');
    $status = 1;

    $query = "INSERT INTO `customer`(`name`, `email`, `address`, `contact`, `status`, `created_at`) VALUES ('$name', '$email', '$address', '$contact', '$status', '$created_at')";
    $result = mysqli_query($con, $query);

    if($result)
    {
        ?>
        <script>
            window.location.href = "customerList.php";
        </script>
        <?php
    }
    else 
    {
        $msg = "Customer Insertion Failed ".mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Customers</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Customers</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputName" class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" required>
                    </div>
                    <div class="col-6">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail" required>
                    </div>
                    <div class="col-6">
                        <label for="inputContact" class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-control" id="inputContact" required>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        <p class="mt-2 text-danger"><?php echo $msg ; ?></p>
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
    var name = document.getElementById("inputName").value;
    var contact = document.getElementById("inputContact").value;

    var nameRegex = /^[A-Za-z\s]+$/;
    var contactRegex = /^\d+$/;

    if (!nameRegex.test(name)) {
        alert("Name can only contain alphabets and spaces.");
        return false;
    }

    if (!contactRegex.test(contact)) {
        alert("Contact must be only digits.");
        return false;
    }

    return true;
}
</script>
