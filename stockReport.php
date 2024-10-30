<?php
include('include/connection.inc.php');

// Check if the form is submitted
if(isset($_POST['submit'])) {
    // Retrieve start and end dates from the form
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Modify the SQL query to fetch stock data within the selected date range
    $stock_query = "SELECT * FROM chicks_stock WHERE entry_date BETWEEN '$start_date' AND '$end_date';";
    $stock_result = mysqli_query($con, $stock_query);
    
    // Reset total
    $total_quantity = 0;
    $total_price = 0;
} else {
    // Set default start and end dates (e.g., current month)
    $start_date = date('Y-m-01');
    $end_date = date('Y-m-t');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Stock Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
            <h5 style="text-align:center">Stock Report</h5>

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
                    <th>Age</th>
                    <th>Weight</th>
                    <th>Quantity</th>
                    <th>Entry Date</th>
                    <th>Price</th>
                  
                    <th>Type</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $sn = 1;
                // Fetch data from the database
                while($row = mysqli_fetch_assoc($stock_result)) {
                    $total_quantity += $row['quantity'];
                    $total_price += $row['price'];
                ?>
                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['weight']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['entry_date']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    
                    <td><?php echo $row['type']; ?></td>
                </tr>
                <?php
                $sn++;
                }
                ?>
                <tr>
                    <td colspan="3"></td>
                    <td><b>Total Quantity: <?php echo $total_quantity; ?></b></td>
                    <td colspan="2"><b>Total Price: <?php echo $total_price; ?></b></td>
                    <td colspan="2"></td>
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
