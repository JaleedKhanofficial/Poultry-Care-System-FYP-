0<?php
include('include/connection.inc.php');
include('include/header.inc.php');

if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'delete')
       {
            $query = "delete from employee where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "employeeList.php";
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
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Employee list</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
           <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Employee list</h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    
                        <th>Sno</th>
                        <th>Name</th>
                    <th>Joined Date</th>
                    <th>Contect</th>
                    <th> CNIC </th>
                    <th>Wage Type</th>
                    <th>Wage</th>
                    <th>Status</th>
                    <th colspan="2">Action</th>
                  </tr>
                </thead>
                <tbody>
          
                  <?php 
                     $counter = 0;
                      $query = "SELECT * FROM employee";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
                  <tr>
                     <td> <?php echo $counter; ?> </td>
                    <td><?php echo $row['name']; ?> </td>
                    <td><?php echo $row['joined_date']; ?> </td>
                    <td><?php echo $row['contact']; ?> </td>
                     <td> <?php echo $row['cnic']; ?> </td>
                    <td><?php echo $row['wage_type']; ?> </td>
                    <td><?php echo $row['wage']; ?> </td>
                   
                   <td> <a href="editemployee.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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