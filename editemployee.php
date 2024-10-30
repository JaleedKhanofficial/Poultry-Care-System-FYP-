<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query ="select *from employee where id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  
  if(isset($_POST['submit']))
  {
    $name = $_POST['name'];
    $joined_date = $_POST['joined_date'];
    $contact = $_POST['contact'];
    $cnic = $_POST['cnic'];
    $address = $_POST['address'];
    $wage_type = $_POST['wage_type'];
    $wage = $_POST['wage'];
    
      $id = $_GET['id'];
      $query = "update employee set name='$name', 
      joined_date='$joined_date',contact='$contact', cnic = '$cnic', address = '$address', wage_type = '$wage_type', wage = '$wage' where id = '$id' ";
      $result = mysqli_query($con, $query);
      
      if($result)
      {
          ?>
            <script>
                 window.location.href = "employeeList.php";
            </script>
          <?php
      }
      else 
      {
          $msg = "Employee Updation Failed ".mysqli_error($con);
      }
  }
  
?>
  
    
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Employee</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Employee</li>
          <li class="breadcrumb-item">Employee List</li>
            <li class="breadcrumb-item active">Edit Employee</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Employee</h5>

                <!-- Vertical Form -->
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-6">
                        <label for="inputName" class="form-label">Employee Name</label>
                        <input type="text" name="name"  value="<?php echo $row['name'];?> " class="form-control" id="inputName" required>
                    </div>
                    <div class="col-6">
                        <label for="inputJoinedDate" class="form-label">Joined Date</label>
                        <input type="date" name="joined_date" value="<?php echo $row['joined_date'];?> " class="form-control" id="inputJoinedDate" required>
                    </div>
                    <div class="col-6">
                        <label for="inputContact" class="form-label">Contact</label>
                        <input type="text" name="contact" value="<?php echo $row['contact']; ?> " class="form-control" id="inputContact" required>
                    </div>
                    <div class="col-6">
                        <label for="inputCnic" class="form-label">CNIC</label>
                        <input type="number" name="cnic" value="<?php echo $row['cnic']; ?>" class="form-control" id="inputCnic" required>
                    </div>
                    <div class="col-4">
                        <label for="inputAddress" class="form-label">Address</label>
                        <input type="text" name="address" value="<?php echo $row['address'];?> " class="form-control" id="inputAddress" required>
                    </div>
                    <div class="col-4">
                        <label for="inputWageType" class="form-label">Wage Type</label>
                        <select class="form-control" name="wage_type" value="<?php echo $row['wage_type'];?> " id="inputWageType" required>
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="inputWage" class="form-label">Wage</label>
                        <input type="text" name="wage" value="<?php echo $row['wage'];?> " class="form-control" id="inputWage" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <p class="text-danger mt-2"><?php echo $msg; ?></p>
                </form><!-- Vertical Form -->
            </div>
        </div>
    </section>

  </main><!-- End #main -->

<?php 
  include('include/footer.inc.php');
?>