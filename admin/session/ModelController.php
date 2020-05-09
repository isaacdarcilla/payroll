<?php
 include "Global.php";

 $controller = new Controller();

 /*
  * 
  * Main Dashboard Controller 
  *
  *
  */

 class Dashboard{

    public function TemporaryConnection(){
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

	public function SelectQuery($string){
        $connection = $this->TemporaryConnection();
        if(($this -> ConnectionCheck($connection) === true)){
            $this -> TemporaryDatabase();
            $result = mysqli_query($connection, $string); 
            return $result;
        }
    }

	public function GetAdministrator($username, $password){
		$query = $this->SelectQuery("SELECT * FROM `admin` WHERE `username` = '$username' AND `password` = '$password'");
		return $query;
	}    

  public function AddPosition($position, $rate, $number){
    $connection = $this->TemporaryConnection();
    if($this->ConnectionCheck($connection) == true){
      $this->TemporaryDatabase();
      $query = "INSERT INTO `position` (`description`, `rate`, `position_id`) VALUES ('$position', '$rate', '$number');";
      mysqli_query($connection, $query);

    }  
  }

 public function AddSchedule($id, $time_in_morning, $time_out_morning, $time_in_afternoon, $time_out_afternoon){
    $connection = $this->TemporaryConnection();
    if($this->ConnectionCheck($connection) == true){
      $this->TemporaryDatabase();
      $query = "INSERT INTO `schedules` (`schedule_id`, `time_in_morning`, `time_out_morning`, `time_in_afternoon`, `time_out_afternoon`) VALUES ('$id', '$time_in_morning', '$time_out_morning', '$time_in_afternoon', '$time_out_afternoon');";
      mysqli_query($connection, $query);

    }  
  }

  public function GetEmployee(){
    $connection = $this->TemporaryConnection();
    if($this->ConnectionCheck($connection) == true){
      $this->TemporaryDatabase();
      $query = "SELECT *, employees.id AS empid FROM employees LEFT JOIN position ON position.id=employees.position_id";
      $result = mysqli_query($connection, $query);

      mysqli_close($connection);
    }
  }
}
?>