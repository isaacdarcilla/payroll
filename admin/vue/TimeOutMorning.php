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

 $queryEmployeeId = "SELECT * FROM `employees` WHERE `employee_id` = '$content';";
 $queryResult = mysqli_query($connection, $queryEmployeeId);
 $rowQuery = mysqli_fetch_assoc($queryResult);

 $employee_id = $rowQuery['id']; 
 $schedule = $rowQuery['schedule_id'];

    $sched = "SELECT * FROM `schedules` WHERE `id` = '$schedule_id';";
    $querySched = mysqli_query($connection, $sched);
    $schedRow = mysqli_fetch_assoc($querySched);

    $logstatus = ($time_in > $schedRow['time_in_morning']) ? 0 : 1;
    
            $insert = "UPDATE `attendance` SET `time_out_morning` = '$time_in' WHERE `employee_id` = '$employee_id' AND `date` = '$date';";

            $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

          
            //number of hours in the morning
            $sql2 = "SELECT * FROM `attendance` WHERE `employee_id` = '$employee_id' AND `date` = '$date'";
            $query2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

             $start = $row2['time_in_morning'];

              $time_start = new DateTime($start);
              $time_end = new DateTime($time_in);
              $interval = $time_start->diff($time_end);
              $hrs = $interval->format('%h');
              $mins = $interval->format('%i');
              $mins = $mins/60;
              $int = $hrs + $mins;

              if($int > 4.5){
                $int = $int - 1;
              }   

              $num_hr = "UPDATE `attendance` SET `num_hr_morning` = '$int' WHERE `employee_id` = '$employee_id' AND `date` = '$date'";
              $update = mysqli_query($connection, $num_hr) or die(mysqli_error().$num_hr);


 

?>