<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  $msg = "";
  $id = $_GET['id'];
  $query = "SELECT * FROM vaccine WHERE id = '$id'";
  $result = mysqli_query($con, $query);
  $row = mysqli_fetch_assoc($result);
  
  if(isset($_POST['submit']))
  {
      $title = $_POST['title'];
      $dov = $_POST['date_of_vaccination'];
      $amount = $_POST['amount'];
      $chicks = $_POST['chicks_stock_id'];
    
      $id = $_GET['id'];
      $query = "UPDATE vaccine SET title='$title', amount='$amount', date_of_vaccination='$dov', chicks_stock_id='$chicks' WHERE id = '$id'";
      $result = mysqli_query($con, $query);
      
      if($result)
      {
          echo "<script>window.location.href = 'vaccineList.php';</script>";
      }
      else 
      {
          $msg = "Vaccine updation failed: " . mysqli_error($con);
      }
  }
?>
  
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Edit Vaccine</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Vaccine</li>
        <li class="breadcrumb-item">Vaccine List</li>
        <li class="breadcrumb-item active">Edit Vaccine</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Vaccine</h5>
            <form method="POST" class="row g-3" onsubmit="return validateForm()">
              <div class="col-md-6">
                <label for="inputTitle" class="form-label">Title</label>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" class="form-control" id="inputTitle" required>
              </div>
              <div class="col-md-6">
                <label for="inputDOV" class="form-label">Date of Vaccination</label>
                <input type="date" name="date_of_vaccination" value="<?php echo $row['date_of_vaccination']; ?>" class="form-control" id="inputDOV" required>
              </div>
              <div class="col-6">
                <label for="inputAmount" class="form-label">Amount</label>
                <input type="text" name="amount" value="<?php echo $row['amount']; ?>" class="form-control" id="inputAmount" required>
              </div>
              <div class="col-6">
                <label for="inputChicksStock" class="form-label">Chick Stock</label>
                <select name="chicks_stock_id" class="form-control" id="inputChicksStock" required>
                  <?php
                    $chickQuery = "SELECT * FROM chicks_stock";
                    $chickResult = mysqli_query($con, $chickQuery);
                    while($cRow = mysqli_fetch_assoc($chickResult))
                    {
                        echo "<option value='{$cRow['id']}'" . ($cRow['id'] == $row['chicks_stock_id'] ? ' selected' : '') . ">{$cRow['title']}</option>";
                    }
                  ?>
                </select>
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
