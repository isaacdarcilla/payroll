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
?>
<!doctype html>

<html lang="en" dir="ltr">
  <head>
    <title>Profiling and Payroll Management System</title>
  </head>
  <body >
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
            <div class="page-header">
              <h1 class="page-title">
                Schedule
              </h1>
            </div>
            <div class="row row-cards">           
<!--               <div style="padding-left: 12px; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-schedule">
                   <i class="fe fe-add mr-2"></i> Add 
                </button>
              </div>  -->                                      
              <div class="col-12">
                <div class="card">
                  <div class="card-header py-3">
                    <h3 class="card-title">Employee Schedules</h3>
                  </div>
                  <?php require_once('modals/modal_add_schedule.php') ?>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-hovered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th >ID</th>
                            <th>employee id</th>
                            <th >name</th>
                            <th>Position</th>
                            <th >schedule</th>
                            <!-- <th>Actions</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $getSched = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id LEFT JOIN position ON position.id=employees.position_id ;";
       
                          $res = mysqli_query($connection, $getSched);
                          while($row = mysqli_fetch_assoc($res)) { 

                            ?>
                          <tr>
                            
                            <td ><span class="text-muted"><?php echo $row['id'] ?></span></td>
                            <td ><span class="text-primary"><?php echo $row['employee_id'] ?></span></td>
                            <td ><a class="text-inherit"><?php echo $row['fullname'] ?></a></td>
                            <td ><span class="text"><?php echo $row['description'] ?></span></td>
                            <td >
                              <?php echo date('H:i A', strtotime($row['time_in_morning'])) ?> - <?php echo date('H:i A', strtotime($row['time_out_morning'])) ?> / <?php echo date('H:i', strtotime($row['time_in_afternoon'])) ?> PM - <?php echo date('H:i', strtotime($row['time_out_afternoon'])) ?> PM
                            </td>
                            <!--  <td >
                             
                              <button class="btn btn-success btn-sm ">Edit</button>

                            </td> -->
                          
                          </tr>
                          <?php } ?>

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