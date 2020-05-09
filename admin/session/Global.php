<?php

 /*  
 *
 * Class Query Controller
 *
 */
	
 class Controller{

	public function SQLConnection(){
		$connection = array("server" => "localhost", "user" => "root", "password" => "", "database" => "payroll");
		
		$connections = mysqli_connect($connection["server"], $connection["user"], $connection["password"], $connection["database"]);
		return $connections;	
	}

	public function Connection($connection){
		if(!$connection){
			return false;
		}else{
			return true;
		}
	}

	public function Database(){
		$database = mysqli_select_db($this->SQLConnection(), 'payroll');
		return $database;
	}
}
?>