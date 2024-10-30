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
            $query = "delete from chicks_stock where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "chickenStockList.php";
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
          <li class="breadcrumb-item active">Chicken Stock List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
         <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Chicken Stock List</h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                      <th>Title</th>
                    <th>
                    Entry Date
                    </th>
                    <th>Weight</th>
                    <th>Quantity</th>
                   
                    <th>Price</th>
                     
                     
                   <th colspan="3">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $counter = 0;
                      $query = "select *from chicks_stock";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
          
                  <tr>
                      <td><?php echo $counter; ?> </td>
                        <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['entry_date']; ?> </td>
                    <td><?php echo $row['weight']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                  
                    <td><?php echo $row['price']; ?></td>
               
                   
                    <td> <a href="editchickenStock.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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