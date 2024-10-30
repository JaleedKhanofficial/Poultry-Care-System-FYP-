<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query ="SELECT * FROM supplier WHERE id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  if(isset($_POST['submit']))
  {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $contact = $_POST['contact'];
      $address = $_POST['address'];
      $created_at = date('d-m-Y');
      $status = 1;
      $id = $_GET['id'];
      $query = "UPDATE supplier SET name='$name', email='$email', password='$password', contact='$contact', address='$address' WHERE id = '$id' ";
      $result = mysqli_query($con, $query);
      
      if($result)
      {
          ?>
          <script>
            window.location.href = "supplierList.php";
          </script>
          <?php
      }
      else 
      {
          $msg = "Supplier Updation Failed ".mysqli_error($con);
      }
  }
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Supplier</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Edit Supplier</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  
  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Supplier </h5>
        
        <!-- Vertical Form -->
        <form method="POST" class="row g-3" onsubmit="return validateForm()">
          <div class="col-6">
            <label for="inputName4" class="form-label">Supplier Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" class="form-control" id="inputName4" required>
          </div>
          <div class="col-6">
            <label for="inputEmail4" class="form-label">Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" class="form-control" id="inputEmail4" required>
          </div>
          <div class="col-6">
            <label for="inputPassword4" class="form-label">Password</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" class="form-control" id="inputPassword4" required>
          </div>
          <div class="col-6">
            <label for="inputContact" class="form-label">Contact</label>
            <input type="text" name="contact" value="<?php echo htmlspecialchars($row['contact']); ?>" class="form-control" id="inputContact" required>
          </div>
          <div class="col-6">
            <label for="inputAddress" class="form-label">Address</label>
            <input type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" class="form-control" id="inputAddress" required>
          </div>
          <div class="text-center">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            <p><?php echo $msg; ?></p>
          </div>
        </form><!-- Vertical Form -->
        
      </div>
    </div>
  </section>

</main><!-- End #main -->

<script>
  function validateForm() {
    var name = document.getElementById('inputName4').value;
    var email = document.getElementById('inputEmail4').value;
    var password = document.getElementById('inputPassword4').value;
    var contact = document.getElementById('inputContact').value;
    var address = document.getElementById('inputAddress').value;
    
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
    
    // Validate password (optional, depending on your requirements)
    // Password validation can be added if needed
    
    // Validate contact (only digits)
    if (!/^[0-9]+$/.test(contact)) {
      alert('Please enter a valid contact number (only digits)');
      return false;
    }
    
    // Validate address (only alphabets and spaces)
    if (!/^[A-Za-z ]+$/.test(address)) {
      alert('Please enter a valid address (only alphabets and spaces)');
      return false;
    }
    
    return true;
  }
</script>

<?php
include('include/footer.inc.php');
?>
