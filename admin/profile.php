<?php 

require_once('includes/script.php');  
require_once('session/Login.php'); 

 $model = new Dashboard();
 $session = new AdministratorSession();
 $session->LoginSession();

 if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])){
    header("location:index.php?utm_campaign=expired");
 }

 $model = new Dashboard();
 $password = $_SESSION['official_password'];
 $username = $_SESSION['official_username'];
 $uid = $_SESSION['official_id'];

 $connection = $model->TemporaryConnection();

 $query = $model->GetAdministrator($username, $password);
 $admin = mysqli_fetch_assoc($query);
        $id = $admin['id'];
        $firstname = $admin['firstname'];
        $lastname = $admin['lastname'];
        $photo = $admin['photo'];
        $create = $admin['created_on'];
 $generate = '';
 $stat = '';
 if(isset($_GET['edit'])){
  $generate = $_GET['edit'];
 }

     if($generate == '1' ){
      $stat = '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert"></button>
      Employee profile successfully edited.
      </div>';
    } else { }        
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <title>Profiling and Payroll Management System</title>
  </head>
  <body class="" v-on:click="Reload">
    <div class="page" id="app">
      <div class="page-main">
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
              <div class="d-flex">
                <?php require_once('includes/header.php') ?>
              </div>
              <div class="col-lg order-lg-first">
                <?php require_once('includes/subheader.php') ?>
              </div>
            </div>
          </div>
        </div>
        <div class="my-3 my-md-5">
          <div class="container">
            <?php echo $stat ?>
            <div class="page-header">
              <h1 class="page-title">
                Profiling
              </h1>
            </div>
            <div class="row row-cards">           
              <div style="padding-left: 12px; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-employee">
                   <i class="fe fe-plus mr-2"></i> Add Employee
                </button>
              </div>    
                                    
              <div class="col-12">
                <div class="card">
                  <div class="card-header py-3">
                    <h3 class="card-title">Employee Profiling</h3>
                  </div>
                  <?php require_once('modals/modal_add_employee.php') ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hovered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th class="w-1" >ID</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Address</th>
                            <!-- <th>Civil Status</th> -->
                            <th>Schedule</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                                $query = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                                $result = mysqli_query($connection, $query);

                                while($row = mysqli_fetch_assoc($result)) {
                           ?>
                          <tr>
                            <td><a ><?php echo $row['employee_id'] ?></a></td>
                            <td><a class="text-inherit"><?php echo $row['fullname'] ?></a></td>
                            <td>
                              <?php echo $row['description'] ?>
                            </td>
                            <td>
                              <?php echo $row['address'] ?>
                            </td>
                           <!--  <td>
                              <?php echo $row['civil_status'] ?>
                            </td> -->
                            <td>
                              <?php echo date('H:i A', strtotime($row['time_in_morning'])) ?> - <?php echo date('H:i A', strtotime($row['time_out_morning'])) ?> / <?php echo date('H:i', strtotime($row['time_in_afternoon'])) ?> PM - <?php echo date('H:i', strtotime($row['time_out_afternoon'])) ?> PM
                            </td>
                            <td >
                              <a href="view.php?id=<?php echo $row['employee_id'] ?>"><button class="btn btn-success btn-sm">View</button></a>
                               <a href="edit.php?id=<?php echo $row['employee_id'] ?>"><button class="btn btn-primary btn-sm">Edit</button></a>

                            </td>
                            <?php } ?>

                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div> 
            </div>           
          </div>
        </div>
      </div>  
    <?php require_once('includes/footer.php') ?>
    </div>   

    <?php require_once('includes/datatables.php') ?>
  </body>
</html>