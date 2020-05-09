<!doctype html>
<?php 
  include "includes/script.php";
  include "session/Login.php";

  $session = new AdministratorSession();
  $session->LoginSession();

  if(isset($_SESSION['official_username']) && isset($_SESSION['official_password']) && isset($_SESSION['official_id'])){
       header("location:home.php");
  }  
?>
<html lang="en" dir="ltr">
  <head>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />    
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/> 
    <script src="scripts/vue.js"></script>
    <title>Profiling and Payroll Management System</title>
  </head>
  <body>
    <div class="page" id="app">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col-md-4 col-login mx-auto">
              <div class="text-center mb-6">
               <!-- <img src="./demo/brand/tabler.svg" class="h-6" alt="">-->
              </div>
              <form class="card" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="card-body p-6">
                  <div class="card-title">Login to your account</div>
                  <?php echo $session->Validate() ?>
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control login" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter username" v-model="election" data-toggle="popover" data-content="Username is required" data-placement="left">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <!--<a href="" class="float-right small">Forgot password?</a>-->
                    </label>
                    <input type="password" class="form-control login" id="password" name="password" placeholder="Enter password" v-model="election" data-toggle="popover" data-content="Password is required" data-placement="left">
                  </div>
                  <div class="form-footer">
                    <button type="submit" name="login" class="btn btn-primary btn-block">Log in</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div> 
  </body>
</html>