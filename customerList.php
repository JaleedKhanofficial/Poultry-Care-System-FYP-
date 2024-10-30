<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'activate')
       {
            $query = "update customer set status = '1' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
             <script> window.location.href = "customerList.php"; </script>
            <?php
       }
       else if($op == 'deactivate')
       {
            $query = "update customer set status = '0' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
              <script>
                   window.location.href = "customerList.php"; 
              </script>
            <?php
       }
       else if($op == 'delete')
       {
            $query = "delete from customer where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "customerList.php";
              </script>
            <?php
       }
  }
?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Customer List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Customers</li>
          <li class="breadcrumb-item active">Customer List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Customer List</h5>
            

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                      Name
                    </th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Created Date</th>
                    <th>Status</th>
                    <th colspan="3">Actions</th>
                   
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $counter = 0;
                      $query = "select *from customer";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
                            <tr>
                                <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['name']; ?> </td>
                    <td><?php echo $row['email']; ?> </td>
                    <td><?php echo $row['address']; ?> </td>
                    <td><?php echo $row['contact']; ?> </td>
                    <td><?php echo $row['created_at']; ?> </td>
                    <td>
                         <?php 
                           if($row['status'] == 1)
                           {
                               ?>
                              <a  href="?op=deactivate&id=<?php echo $id; ?> " ><button class="btn btn-success btn-sm">Activate</button>
                              </a>
                             <?php   
                           }
                           else 
                           {
                              ?>
                              <a href="?op=activate&id=<?php echo $id; ?> "> <button class="btn btn-danger btn-sm">Deactivate</button>
                              </a>
                              <?php   
                           }
                        
                        ?>
                        
                        
                    </td>
                    <td> <a href="editCustomer.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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