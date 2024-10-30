<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";

if(isset($_POST['submit']))
{
    $emp_id = $_POST['emp_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $status = 1;
    $time = date('H:i:s');
    $type = $_POST['type'];
    
    $query = "INSERT INTO `expenses`(`emp_id`, `amount`, `date`, `time`, `status`, `description`, `type`)
    VALUES ('$emp_id','$amount','$date','$time','$status','$description', '$type')";
    
    $result = mysqli_query($con, $query);
    if($result)
    {
        ?>
        <script>
            window.location.href = "expensesList.php";
        </script>
        <?php
    }
    else
    {
        $msg = "Insertion Failed: " . mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Add Expenses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Expenses</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputEmployee" class="form-label">Expenser</label>
                        <select class="form-control" name="emp_id">
                            <?php
                            $employeeQuery = "SELECT * FROM employee";
                            $employeeResult = mysqli_query($con, $employeeQuery);
                            
                            while($employeeRow = mysqli_fetch_assoc($employeeResult))
                            {
                            ?>
                                <option value="<?php echo $employeeRow['id']; ?>"> <?php echo htmlspecialchars($employeeRow['name']); ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-6">
                         <label for="inputAmount" class="form-label">Type</label>
                         <select class="form-control" name="type">
                             <option value="Electricity Bill"> Electrictiy Bill </option>
                             <option value="Rent"> Rent </option>
                             <option value="Food">Food</option>
                             <option value="Micellaneous">Miscellaneous</option>
                         </select>
                    </div>
                    <div class="col-6">
                        <label for="inputAmount" class="form-label">Amount</label>
                        <input type="text" name="amount" class="form-control" id="inputAmount" required>
                    </div>
                    <div class="col-6">
                        <label for="inputDate" class="form-label">Date</label>
                        <input type="date" name="date" class="form-control" id="inputDate" required>
                    </div>
                    <div class="col-6">
                        <label for="inputDescription" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="inputDescription" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <p><?php echo $msg; ?></p>
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
    var description = document.getElementById('inputDescription').value;
    var amount = document.getElementById('inputAmount').value;
  //  var weight = document.getElementById('inputWeight').value;
    
    // Validate title (only alphabets and spaces)
    if (!/^[A-Za-z ]+$/.test(description)) {
      alert('Please enter a valid description (only alphabets and spaces)');
      return false;
    }
    
    // Validate age, weight, quantity, price (only digits)
    if (!/^\d+$/.test(amount)) {
      alert('Please enter a valid amount (only digits)');
      return false;
    }
   // if (!/^\d+$/.test(weight)) {
     // alert('Please enter a valid weight (only digits)');
     // return false;
//    }
   
    return true;
  }
</script>
