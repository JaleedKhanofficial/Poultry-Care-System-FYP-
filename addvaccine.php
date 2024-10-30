<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $dov = $_POST['date_of_vaccination'];
    $chicks = $_POST['chicks_stock_id'];
    $amount = $_POST['amount'];

    $query = "INSERT INTO `vaccine`(`title`, `date_of_vaccination`, `chicks_stock_id`, `amount`)
              VALUES ('$title', '$dov', '$chicks', '$amount')";
    $result = mysqli_query($con, $query);

    if ($result) {
        ?>
        <script>
            window.location.href = "vaccineList.php";
        </script>
        <?php
    } else {
        $msg = "Vaccine insertion failed: " . mysqli_error($con);
    }
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Add Vaccine</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Vaccine</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="inputTitle" required>
                    </div>
                    <div class="col-6">
                        <label for="inputDOV" class="form-label">Date of Vaccination</label>
                        <input type="date" name="date_of_vaccination" class="form-control" id="inputDOV" required>
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" id="inputAmount" required>
                    </div>
                    <div class="col-6">
                        <label for="inputChicksStock" class="form-label">Chick Stock</label>
                        <select name="chicks_stock_id" class="form-control" id="inputChicksStock" required>
                            <?php
                            $chickQuery = "SELECT * FROM chicks_stock";
                            $chickResult = mysqli_query($con, $chickQuery);
                            while ($cRow = mysqli_fetch_assoc($chickResult)) {
                                ?>
                                <option value="<?php echo $cRow['id']; ?>"><?php echo $cRow['title']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <p class="text-danger"><?php echo $msg; ?></p>
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
    var title = document.getElementById("inputTitle").value;
    var amount = document.getElementById("inputAmount").value;

    var titleRegex = /^[A-Za-z\s]+$/;
    var digitRegex = /^\d+$/;

    if (!titleRegex.test(title)) {
        alert("Title must contain only alphabets and spaces.");
        return false;
    }

    if (!digitRegex.test(amount)) {
        alert("Amount must contain only digits.");
        return false;
    }

    return true;
}
</script>
