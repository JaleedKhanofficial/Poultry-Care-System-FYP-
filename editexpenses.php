<?php
include('include/connection.inc.php');
include('include/header.inc.php');

$msg = "";
  $id = $_GET['id'];
  $query ="select *from expenses where id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  

if(isset($_POST['submit']))
{
    $emp_id = $_POST['emp_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    $status = 1;
    $time = date('H:i:s');

     $query = "UPDATE expenses SET emp_id='$emp_id', 
                amount='$amount', date='$date', description='$description' , time ='$time' WHERE id = '$id' ";

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
        $msg = "Expenses Insertion Failed ".mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Edit Expenses</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Expenses</h5>
            <form method="POST" class="row g-3" onsubmit="return validateForm()">
                                  <div class="col-6">
                        <label for="inputEmployee" class="form-label">Employee</label>
                        <select class="form-control" name="emp_id">
                            <?php
                            $employeeQuery = "SELECT * FROM employee";
                            $employeeResult = mysqli_query($con, $employeeQuery);
                            
                            while($employeeRow = mysqli_fetch_assoc($employeeResult))
                            {
                            ?>
                                <option value="<?php echo $employeeRow['id']; ?>"> <?php echo $employeeRow['name']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
              <div class="col-md-6">
                <label for="inputAmount5" class="form-label">Amount</label>
                <input type="number" name="amount" value="<?php echo $row['amount'];?> " class="form-control" id="inputAmount5" required>
              </div>
              <div class="col-md-6">
                <label for="inputDescription5" class="form-label">Description</label>
                <input type="text" name="description" value="<?php echo $row['description'];?> " class="form-control" id="inputDescription5" required>
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Date</label>
                <input type="text" name="date" value="<?php echo $row['date'];?> " class="form-control" id="inputAddress5" required>
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


