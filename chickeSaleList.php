<?php
include('include/connection.inc.php');
include('include/header.inc.php');

  if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'activate')
       {
            $query = "update chicks_stock set status = '1' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
             <script> window.location.href = "chickenStockList.php"; </script>
            <?php
       }
       else if($op == 'deactivate')
       {
            $query = "update chicks_stock set status = '0' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
              <script>
                   window.location.href = "chickenStockList.php"; 
              </script>
            <?php
       }
       else if($op == 'delete')
       {
            $query = "delete from chicken_sale where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "chickeSaleList.php";
              </script>
            <?php
       }
  }


?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Chicken Sale List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
         <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Chicken Sale List</h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                    Name
                    </th>
                    <th>KG</th>
                    <th>Price Per KG</th>
                    <th >Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining</th>
                    <th>Date</th>
                
                   <th colspan="3">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $amount= 0;
                     $counter = 0;
                     $remaining_amount = 0;
                     $paid_amount = 0;
                     
                      $query = "select customer.name, chicken_sale.id, chicken_sale.created_at,
                      chicken_sale.amount, chicken_sale.kg, chicken_sale.price_per_kg, chicken_sale.paid_amount,
                      chicken_sale.remaining,
                      chicken_sale.customer_id, chicken_sale.status from chicken_sale INNER JOIN customer on customer.id = chicken_sale.customer_id;";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                           $amount = $amount + $row['amount'];
                           $remaining_amount += $row['remaining'];
                           $paid_amount += $row['paid_amount'];
                           
                          ?>
          
                  <tr>
                      <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['name']; ?> </td>
                    <td><?php echo $row['kg']; ?> <span style="font-size:9px">KG</span></td>
                    <td><?php echo $row['price_per_kg']; ?> <span style="font-size:9px">PKR</span> </td>
                    <td><?php echo $row['amount']; ?> <span style="font-size:9px">PKR</span></td>
                     <td><?php echo $row['paid_amount']; ?> <span style="font-size:9px">PKR</span></td>
                      <td><?php echo $row['remaining']; ?> <span style="font-size:9px">PKR</span></td>
                    
                    <td><?php echo $row['created_at']; ?></td>
               
                
                    <td> <a href="editChickenSale.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
                                     Edit 
                                     </button>
                         </a>
                    </td>
                    <td>
                        <a href="?op=delete&id=<?php echo $id;?> ">
                             <button class="btn btn-danger btn-sm">
                                  Delete
                             </button>
                        </a>
                        
                    </td>
                    
                  </tr>
                          
                          <?php 
                      }
                      ?>
                  </tr>
                  <tr>
                       <td></td>
                       <td></td>
                       <td></td>
                       <td class="fw-bold"></td>
                       <td class="fw-bold"><?php echo $amount; ?> PKR</td>
                        <td class="fw-bold"><?php echo $paid_amount; ?> PKR</td>
                        <td class="fw-bold"><?php echo $remaining_amount; ?> PKR</td>
                       <td></td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

<?php
include('include/footer.inc.php');
?>