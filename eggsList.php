<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'activate')
       {
            $query = "update eggs set status = '1' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
             <script> window.location.href = "eggsList.php"; </script>
            <?php
       }
       else if($op == 'deactivate')
       {
            $query = "update eggs set status = '0' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
              <script>
                   window.location.href = "eggsList.php"; 
              </script>
            <?php
       }
       else if($op == 'delete')
       {
            $query = "delete from eggs where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "eggsList.php";
              </script>
            <?php
       }
  }
?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Eggs List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Eggs</li>
          <li class="breadcrumb-item active">Eggs List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Eggs List</h5>
            

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                      Date
                    </th>
                    <th>Quantity</th>
                    <th>Amount</th>

                    
                    <th colspan="2">Actions</th>
                   
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $counter = 0;
                      $query = "select *from eggs";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
                            <tr>
                                <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['date']; ?> </td>
                    <td><?php echo $row['quantity']; ?> </td>
                      <td><?php echo $row['amount']; ?> </td>

                    
                    <td> <a href="editeggs.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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