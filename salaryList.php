<?php 
  include('include/connection.inc.php');
  include('include/header.inc.php');
  
  if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'activate')
       {
            $query = "update salary set status = '1' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
             <script> window.location.href = "salaryList.php"; </script>
            <?php
       }
       else if($op == 'deactivate')
       {
            $query = "update salary set status = '0' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
              <script>
                   window.location.href = "salaryList.php"; 
              </script>
            <?php
       }
       else if($op == 'delete')
       {
            $query = "delete from salary where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "salaryList.php";
              </script>
            <?php
       }
  }
?>
  
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Salary List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Salaries</li>
          <li class="breadcrumb-item active">Salary List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Salary List</h5>
            

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                      Employee
                    </th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th colspan="2">Description</th>
                   
                    <th colspan="3">Actions</th>
                   
                  </tr>
                </thead>
                <tbody>
                    <?php 
                     $counter = 0;
                      $query = "select salary.id, employee.name, salary.emp_id, salary.amount, salary.salary_date, salary.description from salary INNER JOIN employee on salary.emp_id = employee.id"; 
                     
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
                          
                    <tr>
                    <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['name']; ?> </td>
                    <td><?php echo $row['salary_date']; ?> </td>
                    <td><?php echo $row['amount']; ?> </td>
                    <td style="font-size:12px"><?php echo $row['description']; ?> </td>
                    
                    
                    <td> <a href="editsalaryList.php?id=<?php echo $id;?> "> <button class="btn btn-primary btn-sm">
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