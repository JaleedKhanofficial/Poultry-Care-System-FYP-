<?php
include('include/connection.inc.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve start and end dates from the form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Modify the SQL query to fetch data within the selected date range
    $user_qry = "select employee.name , expenses.id, expenses.emp_id, expenses.amount, expenses.date, expenses.time, 
               expenses.status, expenses.description from expenses INNER JOIN employee on employee.id = expenses.emp_id 
               WHERE date BETWEEN '$start_date' AND '$end_date';";
    $user_res = mysqli_query($con, $user_qry);
    
    // Reset total
    $total = 0;
} else {
    // Set default start and end dates (e.g., current month)
    $start_date = date('Y-m-01');
    $end_date = date('Y-m-t');
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Expenses Report</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
    @media print {
      .no-print {
        display: none !important;
      }
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <center>
        <img src="https://jafasa.com/ChickenFarm/chicken.png" height="100px" width="100px">
      </center>
      <br>
      <h2 style="text-align:center">Marhaba Chicken Point</h2>
      <h5 style="text-align:center">Expenses Report</h5>

      <!-- Form for selecting start and end dates -->
      <form method="post" class="no-print">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="start_date">Start Date:</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $start_date; ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="end_date">End Date:</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo $end_date; ?>">
          </div>
        </div>
        <center><button type="submit" name="submit" class="btn btn-primary mb-2">Generate Report</button></center>
      </form>

      <table class="table table-bordered print">
        <thead>
          <tr>
            <th>S.No</th>
            <th>Expenser</th>
            <th>Amount</th>
         
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sn = 1;
          // Fetch data from the database
          while($user_data = mysqli_fetch_assoc($user_res)) {
              $total += $user_data['amount'];
          ?>
          <tr>
            <td><?php echo $sn; ?></td>
            <td><?php echo $user_data['name']; ?></td>
            <td><?php echo $user_data['amount']; ?></td>
        
            <td><?php echo $user_data['date']; ?> </td>
          </tr>
          <?php
          $sn++;
          }
          ?>
          <tr>
            <td></td>
            <td><b>Total</b></td>
            <td><b><?php echo $total; ?></b></td>
          </tr>
        </tbody>
      </table>

      <div class="text-center no-print" >
        <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
