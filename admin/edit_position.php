
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
	
$position = ucwords($_POST['position']);
$rate = $_POST['rate_per_hour'];

if(isset($_GET['id'])){
	$idEm = $_GET['id'];

	$delete = "UPDATE `position` SET `description`='$position', `rate`='$rate' WHERE `position_id`='$idEm';
    ";
	$query = mysqli_query($connection, $delete) or die('Could not insert');
    $date = date("Y-m-d");
	header("location: ../admin/position.php?id=$idEm");
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