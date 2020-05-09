<?php
  include "ModelController.php";

  /*  
  *
  * Class Administrator Session
  *
  */

  class AdministratorSession{

    private function TemporaryConnection(){
      $sql = new Controller();
      return $sql->SQLConnection();
    }

    private function TemporaryDatabase(){
      $sql = new Controller();
      return $sql->Database();
    }

    private function ConnectionCheck($connection){
      $sql = new Controller();
      return $sql->Connection($connection);
    }

    private function Identification($username){
      $connection = $this->TemporaryConnection();
      if(($this->ConnectionCheck($connection)) === true){
        $this->TemporaryDatabase();
        $query = "SELECT `id` FROM `admin` WHERE `username` = '$username' LIMIT 1;";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        return $row['id'];
      }
    }

    private function SelectAdministrator($username, $password){
      $connection = $this->TemporaryConnection();
      if(($this->ConnectionCheck($connection)) === true){
        $this->TemporaryDatabase();
        $query = "SELECT `username`, `password` FROM `admin` WHERE `username` = '$username' AND `password` = '$password' LIMIT 1;";
        $result = mysqli_query($connection, $query);
        $row = mysqli_num_rows($result);
        $result = ($row == 1 ? true: false);
        
        return $result; 
      }
    }

    function Redirect(){
      header("location:index.php?utm_campaign=incorrect");
    }

    public function Logout(){
       session_destroy();
       header("Location: index.php?utm_campaign=logout");
    }

    public function LoginSession(){
      session_start();
      $connection = $this->TemporaryConnection();
      if(isset($_POST['login'])){
        if(!empty($_POST['username']) && (!empty($_POST['password']))){
          $u = $_POST['username'];
          $p = $_POST['password'];

          $username = stripslashes(mysqli_real_escape_string($connection, $u));
          $password = stripslashes(mysqli_real_escape_string($connection, $p));

          $bcrypt = md5($password);

          $administrator = $this->SelectAdministrator($username, $bcrypt);
          if($administrator == true){           
              $_SESSION['official_username'] = $username;
              $_SESSION['official_password'] = $bcrypt;

              $official_id = $this->Identification($username);

              $_SESSION['official_id'] = $official_id;

              if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password'])){
                $this->Redirect();
              }else{
                header("location:home.php");
              }
            }else{
              $this->Redirect();
          }          
        }
      }
    }

    public function Validate(){
      $alert='';
      if(isset($_GET['utm_campaign'])){
          $alert = $_GET['utm_campaign'];
          if($alert == 'incorrect'){
            $alert = '<div class="alert alert-danger text-center" role="alert"><strong>Username or password is incorrect</strong></div>';          
          }elseif($alert == 'expired'){
            $alert = '<div class="alert alert-danger text-center" role="alert"><strong>Session has expired</strong></div>';  
          }elseif($alert == 'logout'){
            $alert = '<div class="alert alert-success text-center" role="alert"><strong>You have been logout</strong></div>';  
          }else{
            $alert='';
          }          
          return $alert; 
        }else{
          $alert='';
        }
     }
  } 
?>