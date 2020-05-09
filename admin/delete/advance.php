
<?php 

require_once('../includes/script.php');  
require_once('../session/Login.php'); 

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
	

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$delete = "DELETE FROM `cashadvance` WHERE `cash_id` = '$id';";
	$query = mysqli_query($connection, $delete);

	header("location: ../advance.php?status=1");
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