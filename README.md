<p align="center"><img src="https://events.nokidhungry.org/wp-content/uploads/2018/01/Payroll-Final-Logo.png" width="500"></p>

<h4 align="center">Payroll management system with employee profiling and attendance monitoring</h4>
    
## 💕 System Features 

* User role login 
* Barcode scanning
* Employee profiling 
* Employee ID generator  
* Attendance monitoring  
* Automatic payslip
* Filter of attendance
* Filter of payrolls
* Employee adding
* Scheduling of employees
* Barcode scanner integration
* And so much more...  
 
## ✨ Prerequisites

* XAMPP ^7.4
* Git ~2.25
* PHP ^7.3

Before you proceed to installation, make sure you have installed `XAMPP` first and import the database in `phpmyadmin`.

PLEASE STAR ⭐ OR FORK IF YOU THINK THIS IS HELPFUL TO YOU.

**Message me on [Facebook](https://web.facebook.com/isaacdarcilla) for the database file**

## ✨ Installation
 
* `git clone https://github.com/isaacdarcilla/payroll.git` - clone the repository
* `cd payroll` - change to project directory
* `cd admin/session` - go to database 
* `nano Global.php` - edit database config

```php
public function SQLConnection(){
		$connection = array("server" => "localhost", 
				    "user" => "root", 
				    "password" => "", 
				    "database" => "payroll");
    ...
```

```php
public function Database(){
		$database = mysqli_select_db($this->SQLConnection(), 'payroll');
		return $database;
}
```

* Edit server credentials and database name
 
## 💻 Demonstration

* Username: `admin`
* Password: `1234`

* Username: `timekeeper`
* Password: `1234`

* Username: `secretary`
* Password: `1234`

## ✨ Screenshots

More screenshot can be found in ```docs``` folder.

Home  | Dashboard
------------- | -------------
![HOME](https://github.com/isaacdarcilla/payroll/blob/master/docs/Screenshot_2019-09-15%20Profiling%20and%20Payroll%20Management%20System(1).png) | ![HOME](https://github.com/isaacdarcilla/payroll/blob/master/docs/Screenshot_2019-09-15%20Profiling%20and%20Payroll%20Management%20System(11).png)

## ✨ License

[Apache 2.0 License](https://github.com/isaacdarcilla/DesktopQuery/blob/master/LICENSE)
 
## 💻 Developer

Developed by Isaac [(facebook.com/isaacdarcilla)](https://web.facebook.com/isaacdarcilla).

## ✨ Support

Fork or star this repository for support.

## 🐞 Issues and Pull Requests

Not accepting any issues and pull requests. 

## 🚫 No Scammer
