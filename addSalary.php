<?php
include('include/connection.inc.php');
include('include/header.inc.php');
 $msg = "";
 
 
if(isset($_POST['submit']))
{
    $emp_id = $_POST['emp_id'];
    $amount = $_POST['amount'];
    $salary_date = $_POST['salary_date'];
    $description = $_POST['description'];
    $status = '1';
   
    
    $query = "INSERT INTO `salary`(`emp_id`, `amount`, `salary_date`, `description`, `status`)
    VALUES ('$emp_id', '$amount', '$salary_date', '$description', '1' )";
    
    $result = mysqli_query($con , $query);
    if($result)
    {
        ?>
        <script>
            window.location.href = "salaryList.php";
        </script>
        <?php
    }
    else
    {
         $msg = "Insertion Failed ".mysqli_error($con);
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Add Salary</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Salary</h5>

              <!-- Vertical Form -->
              <form method="POST" class="row g-3" onsubmit="return validateForm()">
                <div class="col-6">
                  <label for="inputNanme4" class="form-label">Employee</label>
                  <select class="form-control" name="emp_id" id="inputNanme4">
                       <?php
                        $employeeQuery = "select * from employee";
                        $employeeResult = mysqli_query($con, $employeeQuery);
                        
                        while($employeeRow = mysqli_fetch_assoc($employeeResult))
                        {
                        ?>
                          <option value="<?php echo $employeeRow['id']; ?> "> <?php echo $employeeRow['name']; ?> </option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
                <div class="col-6">
                  <label for="inputAmount" class="form-label">Amount</label>
                  <input type="text" name="amount" class="form-control" id="inputAmount" required>
                </div>
                <div class="col-6">
                  <label for="inputDate" class="form-label">Date</label>
                  <input type="date" name="salary_date" class="form-control" id="inputDate" required>
                </div>
                <div class="col-6">
                  <label for="inputDescription" class="form-label">Description</label>
                  <input type="text" name="description" class="form-control" id="inputDescription" required>
                </div>
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                <p class="text-danger mt-2"><?php echo $msg ; ?></p>
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
    var amount = document.getElementById("inputAmount").value;
    var name = document.getElementById("inputNanme4").options[document.getElementById("inputNanme4").selectedIndex].text;
    
    var digitRegex = /^\d+$/;
    var nameRegex = /^[A-Za-z\s]+$/;
    
    if (!digitRegex.test(amount)) {
        alert("Amount must contain only digits.");
        return false;
    }
    
    if (!nameRegex.test(name)) {
        alert("Name must contain only alphabets and spaces.");
        return false;
    }
    
    return true;
}
</script>
