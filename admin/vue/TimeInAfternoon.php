<?php 

require_once('../includes/script.php');  
require_once('../session/Login.php'); 

$set_timezone = date_default_timezone_set("Asia/Manila");

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

 $content = $_POST['content'];

 $connection = $model->TemporaryConnection();

 $query = $model->GetAdministrator($username, $password);
 $admin = mysqli_fetch_assoc($query);
        $id = $admin['id'];
        $firstname = $admin['firstname'];
        $lastname = $admin['lastname'];
        $photo = $admin['photo'];
        $create = $admin['created_on'];

 $numbers = '';
    for($i = 0; $i < 7; $i++){
      $numbers .= $i;
    }
 $id = substr(str_shuffle($numbers), 0, 9);

 $date = date("Y-m-d");
 $time_in = date('H:i:s');
 $month = date("F");
 $year = date("Y");


 $queryEmployeeId = "SELECT * FROM `employees` WHERE `employee_id` = '$content';";
 $queryResult = mysqli_query($connection, $queryEmployeeId);
 $rowQuery = mysqli_fetch_assoc($queryResult);

 $employee_id = $rowQuery['id']; 
 $schedule = $rowQuery['schedule_id'];

    $sched = "SELECT * FROM `schedules` WHERE `id` = '$schedule';";
    $querySched = mysqli_query($connection, $sched);
    $schedRow = mysqli_fetch_assoc($querySched);

    $logstatus = ($time_in > $schedRow['time_in_afternoon']) ? 1 : 1;

              $insert = "UPDATE `attendance` SET `time_in_afternoon` = '$time_in', `status_afternoon` = '$logstatus' WHERE `employee_id` = '$employee_id' AND `date` = '$date';";

              $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

 

?>