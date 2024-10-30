<?php
include('include/connection.inc.php');
include('include/header.inc.php');


   
// Fetch chicken sale data
$chicken_sale_query = "SELECT DATE(created_at) AS sale_date, SUM(amount) AS total_amount
FROM chicken_sale GROUP BY DATE(created_at) ORDER BY DATE(created_at)";
$chicken_sale_result = mysqli_query($con, $chicken_sale_query);

// Initialize arrays to store labels and data for the chart
$cslabels = [];
$csdata = [];

// Extracting data from the result set
while ($csrow = mysqli_fetch_assoc($chicken_sale_result)) {
    $cslabels[] = $csrow['sale_date'];
    $csdata[] = $csrow['total_amount'];
}
   
   
   // Fetch Egg sale data
$egg_sale_query = "SELECT DATE(created_at) AS sale_date, SUM(amount) AS total_amount
FROM egg_sale GROUP BY DATE(created_at) ORDER BY DATE(created_at)";
$egg_sale_result = mysqli_query($con, $egg_sale_query);

// Initialize arrays to store labels and data for the chart
$egglabels = [];
$eggdata = [];

// Extracting data from the result set
while ($erow = mysqli_fetch_assoc($egg_sale_result)) {
    $egglabels[] = $erow['sale_date'];
    $eggdata[] = $erow['total_amount'];
}
   
   
   


?>

 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Graph Analytics</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
           <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Analytics</h5>
             
                   <div class="container mt-5 mb-2">
                     <div class="row">
                      <div style="col-md-6 col-lg-6 border border-primary m-3">
                     <h2 class="text-center">Chicken Sale  Graph</h2>
                      <canvas id="chickenSaleChart"></canvas>
                      </div>
                    </div>
                  </div>
                  
                  
                   <div class="container mt-5 mb-2">
                     <div class="row">
                      <div style="col-md-6 col-lg-6 border border-primary m-3">
                     <h2 class="text-center">Egg Sale  Graph</h2>
                      <canvas id="eggSaleChart"></canvas>
                      </div>
                    </div>
                  </div>

            </div>
          </div>
          
          <hr>
          

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  
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
                label: 'Total Amount Sold',
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
    var labels = <?php echo json_encode($egglabels); ?>;
    var data = <?php echo json_encode($eggdata); ?>;

    // Create the line chart
    var ctx = document.getElementById('eggSaleChart').getContext('2d');
    var chickenSaleChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Amount Sold',
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
<?php
include('include/footer.inc.php');
?>