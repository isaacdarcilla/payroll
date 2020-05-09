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

/*EDIT PROFILE*/

if(isset($_POST['editProfile'])){
  $fullname = $_POST['fullname'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  //$birthday =$_POST['birthday'];
  $civil_status = $_POST['civil_status'];
  //$position =$_POST['position'];
  $sex = $_POST['sex'];
  $citizenship = $_POST['citizenship'];
  $height =$_POST['height'];
  $weight = $_POST['weight'];
  $religion = $_POST['religion'];
  $spouse = $_POST['spouse'];
  $spouse_occupation = $_POST['spouse_occupation'];
  $father = $_POST['father'];
  $father_occupation= $_POST['father_occupation'];
  $mother = $_POST['mother'];
  $mother_occupation = $_POST['mother_occupation'];
  $parent_address = $_POST['parent_address'];
  $emergency_name =$_POST['emergency_name'];
  $emergency_contact =$_POST['emergency_contact'];

  $updateQuery = "UPDATE `employees` SET `fullname` = '$fullname', `address` = '$address', `email` = '$email', `phonenumber` = '$phonenumber', `sex` = '$sex', `civil_status` = '$civil_status', `citizenship` = '$citizenship', `height` = '$height', `weight` = '$weight', `religion` = '$religion', `spouse` = '$spouse', `spouse_occupation` = '$spouse_occupation', `father` = '$father', `father_occupation` = '$father_occupation', `mother` = '$mother', `mother_occupation` = '$mother_occupation', `parent_address` = '$parent_address', `emergency_name` = '$emergency_name', `emergency_contact` = '$emergency_contact' WHERE `employee_id` = '$emid';";
  $query2 = mysqli_query($connection, $updateQuery);
  //echo $query2;
  header("Location: profile.php?edit=1");
}

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
                <a href="profile.php" class="text-primary">Profiling</a> <i style="font-size: 20px;" class="fe fe-chevron-right"></i> Edit Profile
              </h1>
            </div>
            
              <?php require_once('modals/modal_add_education.php') ?>                             
              <div class="col-12">
                <div class="card">
               <div class="">
              <form class="" method="post" action="">
                <div class="card-body">
                  <h3 class="card-title"><strong>Personal Data</strong></h3>
                  <div class="row">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Fullname</label>
                        <input type="text" required="" name="fullname" class="form-control" value="<?php echo $emp['fullname'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Address</label>
                        <input type="text" required="" name="address" class="form-control" value="<?php echo $emp['address'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" required="" name="email" class="form-control" value="<?php echo $emp['email'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" required="" name="phonenumber"  value="<?php echo $emp['phonenumber'] ?>">
                      </div>
                    </div>
              <!--       <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Birthday</label>
                        <input type="text" class="form-control" required="" name="birthday" value="<?php echo date('F d, Y', strtotime($emp['birthdate'])) ?>">
                      </div>
                    </div> -->
           <!--          <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Position</label>
                        <input type="text" class="form-control" required="" name="position" value="<?php echo $emp['description'] ?>">
                      </div>
                    </div> -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Civil Status</label>
                        <input type="text" class="form-control" required="" name="civil_status"  value="<?php echo $emp['civil_status'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Sex</label>
                        <input type="text" class="form-control" required="" name="sex" value="<?php echo $emp['sex'] ?>">
                      </div>
                    </div> 
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Citizenship</label>
                        <input type="text" class="form-control" required="" name="citizenship" value="<?php echo $emp['citizenship'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Height</label>
                        <input type="text" class="form-control" required="" name="height" value="<?php echo $emp['height'] ?>">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-label">Weight</label>
                        <input type="text" class="form-control" required="" name="weight" value="<?php echo $emp['weight'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Religion</label>
                        <input type="text" class="form-control" required="" name="religion" value="<?php echo $emp['religion'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Spouse</label>
                        <input type="text" class="form-control" required="" name="spouse" value="<?php echo $emp['spouse'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" required="" name="spouse_occupation" value="<?php echo $emp['spouse_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Father's Name</label>
                        <input type="text" class="form-control" required="" name="father" value="<?php echo $emp['father'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" required="" name="father_occupation" value="<?php echo $emp['father_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Mother's Name</label>
                        <input type="text" class="form-control" required="" name="mother" value="<?php echo $emp['mother'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Occupation</label>
                        <input type="text" class="form-control" required="" name="mother_occupation" value="<?php echo $emp['mother_occupation'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Parent's Address</label>
                        <input type="text" class="form-control" required="" name="parent_address"  value="<?php echo $emp['parent_address'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Person to be contacted in case of emergency</label>
                        <input type="text" class="form-control" required="" name="emergency_name" value="<?php echo $emp['emergency_name'] ?>">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-0">
                        <label class="form-label">His/her contact details</label>
                        <input rows="1" class="form-control" required="" name="emergency_contact" value="<?php echo $emp['emergency_contact'] ?>"></input>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-right">
                  <div class="d-flex">
                    <a href="profile.php" class="btn btn-link">Cancel</a>
                    <button type="submit" name="editProfile" class="btn btn-primary ml-auto">Save</button>
                  </div>
                </div>
              </form>

            </div>           
          </div>
        </div>
      </div>  
    <?php require_once('includes/footer.php') ?>
    </div>   

    <?php require_once('includes/datatables.php') ?>
  </body>
</html>