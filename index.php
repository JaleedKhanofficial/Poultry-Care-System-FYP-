<?php 
   session_start();
   include('include/connection.inc.php');
   include('include/header.inc.php');
   
   if(!isset($_SESSION['aemail']))
   {
        ?>
         <script>
              window.location.href = "login.php";
         </script>
        <?php
   }


   $customerQuery = "select count(id) as totalCustomers from customer";
   $customerResult = mysqli_query($con, $customerQuery);
   $customerRow = mysqli_fetch_assoc($customerResult);
   
   
   $expensesQuery = "select sum(amount) as totalExpenses from expenses";
   $expenseResult = mysqli_query($con, $expensesQuery);;
   $expenseRow = mysqli_fetch_assoc($expenseResult);
   
   
   $supplierQuery= "select count(id) as totalSupplier from supplier";
   $supplierResult =  mysqli_query($con, $supplierQuery);
   $supplierRow = mysqli_fetch_assoc($supplierResult);
   $totalSupplier = $supplierRow['totalSupplier'];
   
   
   $chickenQuery = "select sum(quantity) as totalChickens from chicks_stock";
   $chickenResult = mysqli_query($con, $chickenQuery);
   $chickenRow = mysqli_fetch_assoc($chickenResult);
   
   
   $employeeQuery = "select count(id) as totalEmployee from employee";
   $employeeResult = mysqli_query($con, $employeeQuery);
   $employeeRow = mysqli_fetch_assoc($employeeResult);
   $totalEmployee = $employeeRow['totalEmployee'];
   
   
   $totalEggsQuery = "select sum(quantity) as totalEggs from eggs";
   $employeeResult = mysqli_query($con, $totalEggsQuery);
   $eggRow = mysqli_fetch_assoc($employeeResult);
   $totalEggs = $eggRow['totalEggs'];
   
   
   $totalVaccineQuery = "select count(id) as totalVaccines from vaccine";
   $vaccineResult = mysqli_query($con, $totalVaccineQuery);
   $vaccineRow = mysqli_fetch_assoc($vaccineResult);
   $totalVaccines = $vaccineRow['totalVaccines'];
   
   
   $salaryQuery = "select sum(amount) as totalSalaries from salary";
   $salaryResult = mysqli_query($con, $salaryQuery);
   $salaryRow = mysqli_fetch_assoc($salaryResult);
   $totalSalaries = $salaryRow['totalSalaries'];
   
   
   $supplierQuery = "select count(id) as totalSuppliers from supplier";
   $supplierResult = mysqli_query($con, $supplierQuery);
   $supplierRow = mysqli_fetch_assoc($supplierResult);
   $totalSupplier = $supplierRow['totalSuppliers'];
   
   
   
   
   
   
   
   
   // Fetch expense data
$expense_query = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(amount) AS total_amount FROM expenses GROUP BY DATE_FORMAT(date, '%Y-%m') ORDER BY DATE_FORMAT(date, '%Y-%m') ASC";
$result = mysqli_query($con, $expense_query);

// Initialize arrays to store labels and data for the chart
$labels = [];
$data = [];

// Extracting data from the result set
while ($row = mysqli_fetch_assoc($result)) {
    $labels[] = $row['month'];
    $data[] = $row['total_amount'];
}
   

// Fetch stock data
$stock_query = "SELECT DATE_FORMAT(entry_date, '%Y-%m') AS month, SUM(quantity) AS total_quantity FROM chicks_stock GROUP BY DATE_FORMAT(entry_date, '%Y-%m') ORDER BY DATE_FORMAT(entry_date, '%Y-%m') ASC";
$stockresult = mysqli_query($con, $stock_query);

// Initialize arrays to store labels and data for the chart
$slabels = [];
$sdata = [];

// Extracting data from the result set
while ($srow = mysqli_fetch_assoc($stockresult)) {
    $slabels[] = $srow['month'];
    $sdata[] = $srow['total_quantity'];
}
   
   
// Fetch chicken sale data
$chicken_sale_query = "SELECT DATE(created_at) AS sale_date, SUM(amount) AS total_amount FROM chicken_sale GROUP BY DATE(created_at) ORDER BY DATE(created_at)";
$chicken_sale_result = mysqli_query($con, $chicken_sale_query);

// Initialize arrays to store labels and data for the chart
$cslabels = [];
$csdata = [];

// Extracting data from the result set
while ($csrow = mysqli_fetch_assoc($chicken_sale_result)) {
    $cslabels[] = $csrow['sale_date'];
    $csdata[] = $csrow['total_amount'];
}
   
   
?>

 
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Customer Card -->
            <div class="col-xxl-4 col-md-6" >
              <div class="card info-card sales-card" style="background-color:teal">

              

                <div class="card-body">
                  <h5 class="card-title text-light">Customer <span class="text-light">| Total </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center ">
                      <img src="user.png" height="45" width="45">
                    </div>
                    <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php echo $customerRow['totalCustomers']; ?> </h2>
                  
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Customer Card -->
            
            <!-- Chicken Card -->
            <div class="col-xxl-4 col-md-6" >
              <div class="card info-card sales-card" style="background-color:#FF5722">
                <div class="card-body">
                  <h5 class="card-title text-light">Chickens <span class="text-light">| Total </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center ">
                      <img src="chic.png" height="50" width="50">
                    </div>
                    <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php echo $chickenRow['totalChickens']; ?> </h2>
                  
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Chicken Card -->

          

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card" style="background-color:#303F9F">

              

                <div class="card-body">
                  <h5 class="card-title text-light">Expenses <span class="text-light">| Total </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                       <img src="expenses.png" height="50" width="50">
                    </div>
                     <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php echo $expenseRow['totalExpenses']; ?> </h2>
                  
                    </div>
                    
                  
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

               <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card" style="background-color:#D81B60">

              

                <div class="card-body" >
                  <h5 class="card-title text-light">Employee <span class="text-light">| Total </span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="userr.png" height="50" width="50">
                    </div>
                    <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php echo $totalEmployee; ?> </h2>
                  
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            
              <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card" style="background-color:#FFC107">

              

                <div class="card-body">
                  <h5 class="card-title text-light">Eggs <span style="color:white">| Total </span> <span style="font-size:10px" class="text-light">Production</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="eggs.png" height="50" width="50">
                    </div>
                   <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php echo $totalEggs; ?> </h2>
                  
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            
            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card sales-card" style="background-color:#006064">
              

                <div class="card-body">
                  <h5 class="card-title text-light">Chicken Stock <span class="text-light">| Total </span> <span class="text-light" style="font-size:10px;">Production</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="book.png" height="50" width="50">
                    </div>
                    <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold"><?php
                      
                        $stockQuery = "select sum(quantity) as totalStockPrice  from chicks_stock";
                        $stockResult = mysqli_query($con, $stockQuery);
                        $stockRow = mysqli_fetch_assoc($stockResult);
                        
                        
                      
                      
                      
                      echo $stockRow['totalStockPrice']; ?> chicks </h2>
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->
            
            
             <!-- Vaccine Card -->
            <div class="col-xxl-4 col-xl-6">

            <div class="card info-card sales-card" style="background-color:#EF6C00">
              

                <div class="card-body">
                  <h5 class="card-title text-light">Vaccine <span class="text-light">| Total </span> <span style="font-size:10px"></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="plus.png" height="50" width="50">
                    </div>
                    <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold">
                          <?php  echo $totalVaccines;  ?>
                        </h2>
                    
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Vaccine Card -->
            
               <!-- Supplier Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card" style="background-color:#311B92">

              

                 <div class="card-body">
                  <h5 class="card-title text-light">Supplier <span class="text-light">| Total </span> <span style="font-size:10px"></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="supplier.png" height="50" width="50">
                    </div>
                   <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold">
                      <?php
                      
                    
                        echo $totalSupplier; 
                        
                        
                        ?>  </h2>
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Vaccine Card -->
            
            
               <!-- Vaccine Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card" style="background-color:#4A148C">

              

                <div class="card-body">
                  <h5 class="card-title text-light">Salaries <span class="text-light">| Total </span> <span style="font-size:10px"></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="rounded-circle d-flex align-items-center justify-content-center">
                      <img src="bank.png" height="50" width="50">
                    </div>
                   <div class="ps-4 ms-5 mt-1">
                      <h2 class="text-light" style="font-size:40px; font-weight:bold">
                      <?php
                      
                    
                        echo $totalSalaries; 
                        
                        
                        ?>  PKR</h2>
                     
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Vaccine Card -->
            
            
            



   

          </div>
          
  

        </div><!-- End Left side columns -->

       
       <div class="container mt-5">
    <div class="row">
        <div class="col-md-6 col-lg-6 border border-primary">
            <h2 class="text-center">Expense  Graph</h2>
            <canvas id="expenseChart"></canvas>
        </div>
        
          <div class="col-md-6 col-lg-6 border border-primary">
            <h2 class="text-center">Stock  Graph</h2>
            <canvas id="stockChart"></canvas>
        </div>
    </div>
    
     
</div>
  <div class="container mt-5 mb-2">
       <div class="row">
          <div style="col-md-6 col-lg-6 border border-primary m-3">
             <h2 class="text-center">Chicken Sale  Graph</h2>
           <canvas id="chickenSaleChart"></canvas>
          </div>
    </div>
  </div>

      </div>
    </section>

  <script>
    // Get the data from PHP
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;

    // Create the line chart
    var ctx = document.getElementById('expenseChart').getContext('2d');
    var expenseChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Expense',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>


<script>
    // Get the data from PHP
    var labels = <?php echo json_encode($slabels); ?>;
    var data = <?php echo json_encode($sdata); ?>;

    // Create the line chart
    var ctx = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Stock Quantity',
                data: data,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

<script>
    // Get the data from PHP
    var labels = <?php echo json_encode($cslabels); ?>;
    var data = <?php echo json_encode($csdata); ?>;

    // Create the line chart
    var ctx = document.getElementById('chickenSaleChart').getContext('2d');
    var chickenSaleChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Amount Sold (kg)',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 3
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
  </main><!-- End #main -->
<?php 
  include('include/footer.inc.php');
  
 ?>