<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query ="select *from salary where id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  
  if(isset($_POST['submit']))
  {
      $emp_id = $_POST['emp_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    
      $id = $_GET['id'];
      $query = "update salary set emp_id='$emp_id', 
      amount='$amount',salary_date='$date', description = '$description' where id = '$id' ";
      $result = mysqli_query($con, $query);
      
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
          $msg = "salary Updation Failed ".mysqli_error($con);
      }
  }
  
?>
  
    
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit salary</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">salary</li>
          <li class="breadcrumb-item">salary List</li>
            <li class="breadcrumb-item active">Edit salary</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit salary</h5>

                 <form method="POST" class="row g-3">
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
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Amount</label>
                  <input type="text"  name="amount" value="<?php echo $row['amount']; ?> " class="form-control" id="inputName5" required>
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Date</label>
                  <input type="date" name="date" value="<?php echo $row['date']; ?> " class="form-control" id="inputEmail5" required>
                </div>
            
                <div class="col-6">
                  <label for="inputAddress5" class="form-label">Description</label>
                  <input type="text" name="description" value="<?php echo $row['address'];?> " class="form-control" id="inputAddres5s" placeholder="1234 Main St" required>
                </div>
               
               
               
                
               
                <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                
                <p class="mt-2 text-danger"><?php echo $msg; ?> </p>
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