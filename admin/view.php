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

 $emid = $_GET['id'];

 $generate = '';
 $stat = '';
 if(isset($_GET['generate'])){
  $generate = $_GET['generate'];
 }

     if($generate == '1' ){
      $stat = '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert"></button>
      Employee barcode successfully generated.
      </div>';
    } else { }

 $query = $model->GetAdministrator($username, $password);
 $admin = mysqli_fetch_assoc($query);
        $id = $admin['id'];
        $firstname = $admin['firstname'];
        $lastname = $admin['lastname'];
        $photo = $admin['photo'];
        $create = $admin['created_on'];

$employee = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id LEFT JOIN barcode ON barcode.employee_id=employees.employee_id LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.employee_id = $emid;";
$result = mysqli_query($connection, $employee);
$emp = mysqli_fetch_assoc($result);

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
<script type="text/javascript">
function printPage(){
    var divElements = document.getElementById('printDataHolder').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''></p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>          
          <div class="container">
            <?php echo $stat ?>
            <div class="page-header">
              <h1 class="page-title">
                <a href="profile.php" class="text-primary">Profiling</a> <i style="font-size: 20px;" class="fe fe-chevron-right"></i> Profile
              </h1>
            </div>
            <div class="row row-cards">           
              <div style="padding-left: 12px; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-education">
                   <i class="fe fe-book-open mr-2"></i> Add Education
                </button>
              </div>
             <div style="padding-left: 12px; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-add-deployment">
                   <i class="fe fe-map-pin mr-2"></i> Add Deployment
                </button>
              </div>              
              <div style="padding-left: 12px; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-view-barcode">
                   <i class="fe fe-eye mr-2"></i> View Barcode
                </button>
              </div>  
              <?php if($emp['bool_gen'] == 0){ ?>
              <div style="padding-left: 12px; padding-bottom: 25px;">
                <a href="generate.php?id=<?php echo $emid ?>"  class="btn btn-secondary" >
                   <i class="fe fe-code mr-2"></i> Generate Barcode
                </a>
              </div>  
              <?php } else { ?> 
              <div style="padding-left: 12px; padding-bottom: 25px;">
                <button disabled href="generate.php?id=<?php echo $emid ?>"  class="btn btn-secondary" >
                   <i class="fe fe-code mr-2"></i> Generate Barcode
                </button>
              </div>
              <?php } ?>             
              <div style="padding-left: 12px; float: right; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" onclick="printPage()">
                   <i class="fe fe-printer mr-2"></i> Print Profile
                </button>
              </div> 
              <div style="padding-left: 12px; float: right; padding-bottom: 25px;">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modal-view-card">
                   <i class="fe fe-user mr-2"></i> View ID
                </button>
              </div> 
              <?php require_once('modals/modal_add_deployment.php') ?>        
              <?php require_once('modals/modal_add_education.php') ?>  
              <?php require_once('modals/modal_view_card.php') ?>                             
              <div class="col-12">
                <div class="card">
               <div class="">
              <form class="">
                <div class="card-body" id="printDataHolder">
                  <h3 class="card-title"><strong>Personal Data</strong></h3>
                  <center><img height="120" width="120" src="../image/<?php echo $emp['photo'] ?>"></center><br><br>
                  <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Fullname</label>
                        <input type="text" class="form-control" readonly="" placeholder="" value="<?php echo $emp['fullname'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" readonly="" placeholder="Username" value="<?php echo $emp['address'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" readonly="" value="<?php echo $emp['email'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" readonly="" placeholder="Company" value="<?php echo $emp['phonenumber'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Birthday</label>
                        <input type="text" class="form-control" readonly="" placeholder="Last Name" value="<?php echo date('F d, Y', strtotime($emp['birthdate'])) ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control" readonly="" placeholder="Home Address" value="<?php echo $emp['description'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo date('H:i A', strtotime($emp['time_in_morning'])) ?> - <?php echo date('H:i A', strtotime($emp['time_out_morning'])) ?> / <?php echo date('H:i', strtotime($emp['time_in_afternoon'])) ?> PM - <?php echo date('H:i', strtotime($emp['time_out_afternoon'])) ?> PM">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Registered</label>
                        <input type="text" class="form-control" placeholder=" " readonly="" value="<?php echo date('F, d Y', strtotime($emp['created_on'])) ?>">
                      </div>
                    </div>                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Employee ID</label>
                        <input type="text" class="form-control" readonly placeholder=" " value="<?php echo $emid?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Civil Status</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['civil_status'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Sex</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['sex'] ?>">
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Citizenship</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['citizenship'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Height</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['height'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Weight</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['weight'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Religion</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['religion'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group ">
                        <label class="form-label">Project Name</label>
                        <input rows="1" readonly="" class="form-control"  value="<?php echo $emp['project_name'] ?>"></input>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Project/Site Location</label>
                        <input rows="1" readonly="" class="form-control"  value="<?php echo $emp['site_location'] ?>"></input>
                      </div>
                    </div>                     
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Spouse</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['spouse'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['spouse_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Father's Name</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['father'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['father_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" readonly="" placeholder=" " value="<?php echo $emp['mother'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" readonly="" class="form-control" placeholder=" " value="<?php echo $emp['mother_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Parent's Address</label>
                        <input type="text" readonly="" class="form-control" placeholder=" " value="<?php echo $emp['parent_address'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Person to be contacted in case of emergency</label>
                        <input type="text" readonly="" class="form-control" placeholder=" " value="<?php echo $emp['emergency_name'] ?>">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group mb-0">
                        <label class="form-label">His/her contact details</label>
                        <input rows="1" readonly="" class="form-control"  value="<?php echo $emp['emergency_contact'] ?>"></input>
                      </div>
                    </div>                   
                  </div><br><br>
                  <h3 class="card-title"><strong>Educational Attainment</strong></h3>
                  <div class="row">
                    <?php $edu = "SELECT * FROM `education` WHERE `eid` = $emid ORDER BY `id` ASC;";
                          $thisQ = mysqli_query($connection, $edu);
                          while($emp = mysqli_fetch_assoc($thisQ)) {
                     ?>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Attainment</label>
                        <input type="text" class="form-control" readonly="" placeholder="" value="<?php echo $emp['attained'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Year Graduated</label>
                        <input type="text" class="form-control" readonly="" placeholder="Username" value="<?php echo $emp['year_graduated'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Degree/Honors</label>
                        <input type="email" class="form-control" readonly="" value="<?php echo $emp['degree_received'] ?>">
                      </div>
                    </div>
                  <?php } ?>
                  </div>
                </div>
              </form>
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