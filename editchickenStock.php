<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query ="SELECT * FROM chicks_stock WHERE id = '$id' ";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  if(isset($_POST['submit']))
  {
      $title = $_POST['title'];
      $age = $_POST['age'];
      $weight = $_POST['weight'];
      $quantity = $_POST['quantity'];
      $entry_date = $_POST['entry_date'];
      $price = $_POST['price'];
      $type = $_POST['type'];
      $status = 1;
      $id = $_GET['id'];
      $query = "UPDATE chicks_stock SET title='$title', age='$age',
      weight='$weight', quantity='$quantity', entry_date='$entry_date',
      price='$price', status='$status', type='$type' WHERE id = '$id' ";
      $result = mysqli_query($con, $query);
      
      if($result)
      {
          ?>
          <script>
            window.location.href = "chickenStockList.php";
          </script>
          <?php
      }
      else 
      {
          $msg = "Chicken stock Updation Failed " . mysqli_error($con);
      }
  }
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Edit Chicken Stock</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Chicken Stock</h5>
        
        <!-- Vertical Form -->
        <form method="POST" class="row g-3" onsubmit="return validateForm()">
          <div class="col-6">
            <label for="inputTitle" class="form-label">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" class="form-control" id="inputTitle" required>
          </div>
          <div class="col-6">
            <label for="inputAge" class="form-label">Age</label>
            <input type="number" name="age" value="<?php echo $row['age']; ?>" class="form-control" id="inputAge" required>
          </div>
          <div class="col-6">
            <label for="inputWeight" class="form-label">Weight</label>
            <input type="text" name="weight" value="<?php echo $row['weight']; ?>" class="form-control" id="inputWeight" required>
          </div>
          <div class="col-6">
            <label for="inputQuantity" class="form-label">Quantity</label>
            <input type="text" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" class="form-control" id="inputQuantity" required>
          </div>
          <div class="col-4">
            <label for="inputEntryDate" class="form-label">Entry date</label>
            <input type="date" name="entry_date" value="<?php echo htmlspecialchars($row['entry_date']); ?>" class="form-control" id="inputEntryDate" required>
          </div>
          <div class="col-4">
            <label for="inputPrice" class="form-label">Price</label>
            <input type="text" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" class="form-control" id="inputPrice" required>
          </div>
          <div class="col-4">
            <label for="inputType" class="form-label">Type</label>
            <input type="text" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" class="form-control" id="inputType">
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

<script>
  function validateForm() {
    var title = document.getElementById('inputTitle').value;
    var age = document.getElementById('inputAge').value;
  
    var quantity = document.getElementById('inputQuantity').value;
    var price = document.getElementById('inputPrice').value;
    
    // Validate title (only alphabets and spaces)
    if (!/^[A-Za-z ]+$/.test(title)) {
      alert('Please enter a valid title (only alphabets and spaces)');
      return false;
    }
    
    // Validate age, weight, quantity, price (only digits)
    if (!/^\d+$/.test(age)) {
      alert('Please enter a valid age (only digits)');
      return false;
    }
   
    if (!/^\d+$/.test(quantity)) {
      alert('Please enter a valid quantity (only digits)');
      return false;
    }
    if (!/^\d+$/.test(price)) {
      alert('Please enter a valid price (only digits)');
      return false;
    }
    
    return true;
  }
</script>

<?php
include('include/footer.inc.php');
?>
