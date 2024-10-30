<?php
include('include/connection.inc.php');
include('include/header.inc.php');

  if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
      
       if($op == 'delete')
       {
            $query = "delete from vaccine where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "vaccineList.php";
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
          <li class="breadcrumb-item active">vaccine List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
         <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">vaccine List</h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                    Title
                    </th>
                    <th>Date of Vaccination</th>
                    <th>Amount</th>
                    <th>Chicken Stock</th>
                    
                   <th colspan="2">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $counter = 0;
                      $query = "select vaccine.id, vaccine.title, vaccine.date_of_vaccination, vaccine.chicks_stock_id, vaccine.amount,
                      chicks_stock.title as chick_title from vaccine INNER JOIN chicks_stock on chicks_stock.id = vaccine.chicks_stock_id;";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
          
                  <tr>
                      <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['title']; ?> </td>
                    <td><?php echo $row['date_of_vaccination']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['chick_title']; ?></td>
                  
                    <td> <a href="editvaccine.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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