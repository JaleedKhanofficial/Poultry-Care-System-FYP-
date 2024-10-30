<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query = "SELECT * FROM customer WHERE id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  if(isset($_POST['submit']))
  {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $contact = $_POST['contact'];
      $address = $_POST['address'];
      $created_at = date('d-m-Y');
      $status = 1;
      $id = $_GET['id'];
      $query = "UPDATE customer SET name='$name', 
                email='$email', contact='$contact', address='$address' WHERE id = '$id' ";
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
          $msg = "Customer Updation Failed ".mysqli_error($con);
      }
  }
  
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Customer</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Customers</li>
        <li class="breadcrumb-item">Customer List</li>
        <li class="breadcrumb-item active">Edit Customer</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  
  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Customer</h5>
            <form method="POST" class="row g-3" onsubmit="return validateForm()">
              <div class="col-md-6">
                <label for="inputName5" class="form-label">Customer Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" id="inputName5" required>
              </div>
              <div class="col-md-6">
                <label for="inputEmail5" class="form-label">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" id="inputEmail5" required>
              </div>
              <div class="col-6">
                <label for="inputAddress5" class="form-label">Address</label>
                <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" class="form-control" id="inputAddress5" required>
              </div>
              <div class="col-md-6">
                <label for="inputZip" class="form-label">Contact</label>
                <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" class="form-control" id="inputZip" required>
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

<script>
  function validateForm() {
    var name = document.getElementById('inputName5').value;
    var email = document.getElementById('inputEmail5').value;
    var address = document.getElementById('inputAddress5').value;
    var contact = document.getElementById('inputZip').value;
    
    // Validate name (only alphabets and spaces)
    if (!/^[A-Za-z ]+$/.test(name)) {
      alert('Please enter a valid name (only alphabets and spaces)');
      return false;
    }
    
    // Validate email
    if (!/\S+@\S+\.\S+/.test(email)) {
      alert('Please enter a valid email address');
      return false;
    }
    
    // Validate address (only alphabets and spaces)
    if (!/^[A-Za-z ]+$/.test(address)) {
      alert('Please enter a valid address (only alphabets and spaces)');
      return false;
    }
    
    // Validate contact (only digits)
    if (!/^[0-9]+$/.test(contact)) {
      alert('Please enter a valid contact number (only digits)');
      return false;
    }
    
    return true;
  }
</script>

<?php 
  include('include/footer.inc.php');
?>
