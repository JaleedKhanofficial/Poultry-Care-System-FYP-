0<?php
include('include/connection.inc.php');
include('include/header.inc.php');

if(isset($_GET['op']))
  {
       $op = $_GET['op'];
       $id = $_GET['id'];
       if($op == 'activate')
       {
            $query = "update expenses set status = '1' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
             <script> window.location.href = "expensesList.php"; </script>
            <?php
       }
       else if($op == 'deactivate')
       {
            $query = "update expenses set status = '0' where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
              <script>
                   window.location.href = "expensesList.php"; 
              </script>
            <?php
       }
       else if($op == 'delete')
       {
            $query = "delete from expenses where id = '$id' ";
            $result = mysqli_query($con, $query);
            ?>
            
              <script>
                   window.location.href = "expensesList.php";
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
          <li class="breadcrumb-item active">Expenses List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section dashboard">
       <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Expenses List</h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                      <th>Sno</th>
                    <th>
                    Employee
                    </th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th data-type="date">Date</th>
                  
                    <th colspan="3" >Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                      $counter = 0;
                      $query ="select expenses.id, employee.name, expenses.amount, expenses.date, expenses.time, expenses.description, expenses.status from expenses
                              INNER JOIN employee on employee.id = expenses.emp_id";
                      $result = mysqli_query($con, $query);
                      while($row = mysqli_fetch_assoc($result))
                      {
                           $counter++;
                           $id = $row['id'];
                          ?>
                      
          
                  <tr>
                    <td><?php echo $counter; ?> </td>
                    <td><?php echo $row['name']; ?> </td>
                    <td><?php echo $row['amount'];?> </td>
                    <td><?php echo $row['description'];?> </td>
                    <td><?php echo $row['date']; ?>  </td>
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
                    
                    <td> <a href="editexpenses.php?id=<?php echo $id; ?> "> <button class="btn btn-primary btn-sm">
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