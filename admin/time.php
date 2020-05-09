
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
	

$newtimein_am = date('H:i:s', strtotime($_POST['time_in_am']));
$newtimeout_am = date('H:i:s', strtotime($_POST['time_out_am']));

$newtimein_pm = date('H:i:s', strtotime($_POST['time_in_pm']));
$newtimeout_pm = date('H:i:s', strtotime($_POST['time_out_pm']));

/* Interval Morning */

$start = $newtimein_am;

              $time_start = new DateTime($start);
              $time_end = new DateTime($newtimeout_am);
              $interval = $time_start->diff($time_end);
              $hrs = $interval->format('%h');
              $mins = $interval->format('%i');
              $mins = $mins/60;
              $intAm = $hrs + $mins;

/* Interval Afternoon */

$startPm = $newtimein_pm;

              $time_startPm = new DateTime($startPm);
              $time_endPm = new DateTime($newtimeout_pm);
              $intervalPm = $time_startPm->diff($time_endPm);
              $hrsPm = $intervalPm->format('%h');
              $minsPm = $intervalPm->format('%i');
              $minsPm = $minsPm/60;
              $intPm = $hrsPm + $minsPm;


if(isset($_GET['id'])){
	$idEm = $_GET['id'];

	$delete = "UPDATE `attendance` SET `time_in_morning`='$newtimein_am', `time_out_morning`='$newtimeout_am', `time_in_afternoon`='$newtimein_pm', `time_out_afternoon`='$newtimeout_pm', `num_hr_morning`='$intAm', `num_hr_afternoon`='$intPm' WHERE `attendance_id`='$idEm';
    ";
	$query = mysqli_query($connection, $delete) or die('Could not insert');
    $date = date("Y-m-d");
	header("location: ../admin/attendance.php?filter=$date&id=$idEm");
}

if(isset($_GET['uid'])){
    $uid = $_GET['uid'];
}

if(isset($_POST['edit'])){

    $amount=$_POST['amount'];

    $delete = "UPDATE `cashadvance` SET `amount` = '$amount' WHERE `cash_id` = '$uid';";
    $query = mysqli_query($connection, $delete);

    header("location: ../advance.php?status=1");    
}

?>