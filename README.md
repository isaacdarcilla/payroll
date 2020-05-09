<p align="center"><img src="https://www.anexia-it.com/blog/wp-content/uploads/2015/01/codeigniter_logo.png" width="500"></p>

<h4 align="center">Payroll management system with employee profiling and attendance monitoring</h4>

## ✨ Prerequisites

* XAMPP ^7.4
* Git ~2.25
* PHP ^7.4

Before you proceed to installation, make sure you have installed `XAMPP` first and import the database in `phpmyadmin`.

## ✨ Installation

* `git clone https://github.com/isaacdarcilla/booking-system.git` - clone the repository
* `cd payroll` - change to project directory
* `cd admin/session` - go to database 
* `nano Global.php` - edit database config

```php
public function SQLConnection(){
		$connection = array("server" => "localhost", "user" => "root", "password" => "", "database" => "payroll");
    ...
```

```php
public function Database(){
		$database = mysqli_select_db($this->SQLConnection(), 'payroll');
		return $database;
}
```

* Edit server credentials and database name


## 💻 Admin Demonstration

* Username: `admin`
* Password: `1234`

## ✨ Screenshot

More screenshot can be found in ```screenshots``` folder.

Home  | Search
------------- | -------------
![App](https://github.com/isaacdarcilla/booking-system/blob/master/screenshots/DeepinScreenshot_20200331180906.png) | ![App](https://github.com/isaacdarcilla/booking-system/blob/master/screenshots/DeepinScreenshot_20200331180935.png)

## ✨ License

[Apache 2.0 License](https://github.com/isaacdarcilla/DesktopQuery/blob/master/LICENSE)

## 💻 Developer

Developed by Isaac [(facebook.com/isaacdarcilla)](https://web.facebook.com/isaacdarcilla)

## ✨ Support

Fork or star this repository for support.

## 🐞 Issues and Pull Requests

Not accepting any issues and pull requests. 

## 🚫 No Scammer
