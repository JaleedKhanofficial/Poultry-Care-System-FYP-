<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $status = 1;

    $query = "INSERT INTO `supplier`(`name`, `email`, `password`, `address`, `contact`, `status`) VALUES ('$name', '$email', '$password', '$address', '$contact', '$status')";
    $result = mysqli_query($con, $query);

    if ($result) {
        ?>
        <script>
            window.location.href = "supplierList.php";
        </script>
        <?php
    } else {
        $msg = "Supplier Insertion Failed " . mysqli_error($con);
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Supplier</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Supplier</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputName" class="form-label">Your Name</label>
                        <input type="text" name="name" class="form-control" id="inputName">
                    </div>
                    <div class="col-6">
                        <label for="inputEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="inputEmail">
                    </div>
                    <div class="col-6">
                        <label for="inputPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                    <div class="col-6">
                        <label for="inputContact" class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-control" id="inputContact">
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress">
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

<script>
function validateForm() {
    const name = document.getElementById('inputName').value;
    const contact = document.getElementById('inputContact').value;
    const namePattern = /^[A-Za-z\s]+$/;
    const contactPattern = /^[0-9]+$/;

    if (!name.match(namePattern)) {
        alert('Name must contain only alphabetic characters and spaces');
        return false;
    }

    if (!contact.match(contactPattern)) {
        alert('Contact must contain only digits');
        return false;
    }

    return true;
}
</script>

<?php
include('include/footer.inc.php');
?>
