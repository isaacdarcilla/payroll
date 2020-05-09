<?php 

 include "/session/Login.php";
session_start();
session_destroy();
header("location:index.php?utm_campaign=logout");

?>