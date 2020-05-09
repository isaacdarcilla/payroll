<?php 

 if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])){
    header("location:index.php?utm_campaign=expired");
 }

$today = '';
if(isset($_GET['filter'])){
  $today = $_GET['filter'];
}

 $queryPosition = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id WHERE attendance.date='$today';";
 $queryResult = mysqli_query($connection, $queryPosition);



  $numbers = '';
    for($i = 0; $i < 7; $i++){
      $numbers .= $i;
    }
  $id = substr(str_shuffle($numbers), 0, 9);

 if(isset($_POST['add_time_in'])){

    $employee = $_POST['employee'];
    $date = $_POST['overtime_year'].'-'.$_POST['overtime_month'].'-'.$_POST['overtime_day'];
    $time_in = date('H:i:s', strtotime($_POST['time_in']));
    $time_in_option = $_POST['time_in_option'];
      
       if($time_in_option == 'Morning'){

            $sql2 = "SELECT * FROM attendance WHERE employee_id = '$employee' AND `date` = '$date'";
            $query2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

            if(mysqli_affected_rows($connection) > 0){
              echo "<script>window.location.href='attendance.php?filter=$today&status=1&logstatus=$logstatus'</script>";
              mysqli_close($connection);
            } else {                 
 
                $sql = "SELECT * FROM `employees` WHERE `id` = '$employee'";
                $sqlEmployee = mysqli_query($connection, $sql);
                $sqlRow = mysqli_fetch_assoc($sqlEmployee);

                $schedule_id = $sqlRow['schedule_id'];

                $sched = "SELECT * FROM `schedules` WHERE `id` = '$schedule_id';";
                $querySched = mysqli_query($connection, $sched);
                $schedRow = mysqli_fetch_assoc($querySched);

                $logstatus = ($time_in > $schedRow['time_in_morning']) ? 0 : 1;
                $month = date('F');
                $year = date("Y");

                $insert = "INSERT INTO `attendance` (`employee_id`, `attendance_id`, `date`, `time_in_morning`, `time_out_morning`, `time_in_afternoon`, `time_out_afternoon`, `status_morning`, `status_afternoon`, `num_hr_morning`, `num_hr_afternoon`, `month`, `year`) VALUES ('$employee', '$id', '$date', '$time_in', null, null, null, '$logstatus', null, null, null, '$month', '$year');";

                $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

                  echo "<script>window.location.href='attendance.php?filter=$today&am=$logstatus'</script>";
            }

        } else {

              $sql = "SELECT * FROM `employees` WHERE `id` = '$employee'";
              $sqlEmployee = mysqli_query($connection, $sql);
              $sqlRow = mysqli_fetch_assoc($sqlEmployee);

              $schedule_id = $sqlRow['schedule_id'];

              $sched = "SELECT * FROM `schedules` WHERE `id` = '$schedule_id';";
              $querySched = mysqli_query($connection, $sched);
              $schedRow = mysqli_fetch_assoc($querySched);

              $logstatus = ($time_in > $schedRow['time_in_afternoon']) ? 1 : 0;

              $insert = "UPDATE `attendance` SET `time_in_afternoon` = '$time_in', `status_afternoon` = '$logstatus' WHERE `employee_id` = '$employee' AND `date` = '$date';";

              $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

              echo "<script>window.location.href='attendance.php?filter=$today&pm=$logstatus'</script>";  
                
        }
  }//END TIME IN MORNING


 if(isset($_POST['add_time_out'])){

    $employee = $_POST['employee'];
    $date = $_POST['overtime_year'].'-'.$_POST['overtime_month'].'-'.$_POST['overtime_day'];
    $time_in = date('H:i:s', strtotime($_POST['time_in']));
    $time_in_option = $_POST['time_in_option'];
      
     if($time_in_option == 'Morning'){

            $insert = "UPDATE `attendance` SET `time_out_morning` = '$time_in' WHERE `employee_id` = '$employee' AND `date` = '$date';";

            $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

          
            //number of hours in the morning
            $sql2 = "SELECT * FROM `attendance` WHERE `employee_id` = '$employee' AND `date` = '$date'";
            $query2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

             $start = $row2['time_in_morning'];

              $time_start = new DateTime($start);
              $time_end = new DateTime($time_in);
              $interval = $time_start->diff($time_end);
              $hrs = $interval->format('%h');
              $mins = $interval->format('%i');
              $mins = $mins/60;
              $int = $hrs + $mins;

             /*  if($int > 4.5){
                $int = $int - 1;
              }   
 */
              $num_hr = "UPDATE `attendance` SET `num_hr_morning` = '$int' WHERE `employee_id` = '$employee' AND `date` = '$date'";
              $update = mysqli_query($connection, $num_hr) or die(mysqli_error().$num_hr);

              echo "<script>window.location.href='attendance.php?filter=$today&timeout=1'</script>";            
  } else {

            $insert = "UPDATE `attendance` SET `time_out_afternoon` = '$time_in' WHERE `employee_id` = '$employee' AND `date` = '$date';";

            $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

             //number of hours in the afternoon
            $sql2 = "SELECT * FROM `attendance` WHERE `employee_id` = '$employee' AND `date` = '$date'";
            $query2 = mysqli_query($connection, $sql2);
            $row2 = mysqli_fetch_assoc($query2);

             $start = $row2['time_in_afternoon'];

              $time_start = new DateTime($start);
              $time_end = new DateTime($time_in);
              $interval = $time_start->diff($time_end);
              $hrs = $interval->format('%h');
              $mins = $interval->format('%i');
              $mins = $mins/60;
              $int = $hrs + $mins;

              /* if($int > 4.5){
                $int = $int - 1;
              }   */ 


              $num_hr = "UPDATE `attendance` SET `num_hr_afternoon` = '$int' WHERE `employee_id` = '$employee' AND `date` = '$date'";
              $update = mysqli_query($connection, $num_hr) or die(mysqli_error().$num_hr);

              echo "<script>window.location.href='attendance.php?filter=$today&timeout=1'</script>";  
                
           }
}//END AFTERNOON
?>


<div id="modal-add-attendance-in" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">New Time In</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Employee</label>
                        <select name="employee"  required="true" class="form-control">
                              <option  value="" class="text-muted">Select Employee</option>

                              <?php 
                              $pos = "SELECT `id`, `fullname` FROM `employees`;";
                              $res = mysqli_query($connection, $pos);
                              while($row = mysqli_fetch_assoc($res)){

                              ?>
                              
                              <option value="<?php echo $row['id']  ?>"><?php echo $row['fullname']  ?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div style="padding-left: px;"" class="row">
                        <div class="form-group" style="padding-right: 15px;  padding-left: 10px">
                        <label class="form-label">Date of Attendance</label>
                          <select style="padding-right: 40px;"  required="" name="overtime_month" class="form-control custom-select">
                              <option class="text-muted" value="">Month</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                      </div> 
                      <div style="" class="col-md-4">
                        <label class="form-label">&nbsp</label>
                              <select   required="" name="overtime_day" class="form-control custom-select">
                              <option class="text-muted" value="">Day</option>
                              <option value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                      </div>   
                      <div  class="col-md-4">
                        <label class="form-label">&nbsp</label>
                              <select  required="" name="overtime_year" class="form-control custom-select">
                              <option class="text-muted" value="">Year</option>
                              <?php 
                              $start_year = 2015;
                              $current_year = date("Y", time())+1;

                              $diff_bt_year = $current_year - $start_year;

                              while($start_year != $current_year){
                                $current_year--;
                              ?>
                                <option value="<?php echo $current_year ?>"><?php echo $current_year ?></option>
                              <?php } ?>
                            </select>
                      </div> 
                  
                      </div> 

                      <div class="-group">
                        <div class="form-label">Options</div>
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-radio custom-control-inline">
                            <input required="" type="radio" class="custom-control-input" name="time_in_option" value="Morning" >
                            <span class="custom-control-label">Time In Morning</span>
                          </label>
                          <label class="custom-control custom-radio custom-control-inline">
                            <input required="" type="radio" class="custom-control-input" name="time_in_option" value="Afternoon">
                            <span class="custom-control-label">Time In Aftenoon</span>
                          </label>

                        </div>
                      </div>
                
                      <div style="padding-top: 12px;" class="form-group">
                        <label class="form-label">Time In</label>
                      <div class="bootstrap-timepicker">
                        <input required="true" type="text" class="form-control timepicker"  name="time_in">
                      </div>
                      </div>
                                                     
                    </div>               
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add_time_in" class="btn success p-x-md">Add Time In</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

<div id="modal-add-attendance-out" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Time Out</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Employee</label>
                        <select name="employee"  required="true" class="form-control">
                              <option  value="" class="text-muted">Select Employee</option>

                              <?php 
                              $pos = "SELECT `id`, `fullname` FROM `employees`;";
                              $res = mysqli_query($connection, $pos);
                              while($row = mysqli_fetch_assoc($res)){

                              ?>
                              
                              <option value="<?php echo $row['id']  ?>"><?php echo $row['fullname']  ?></option>
                            <?php } ?>
                          </select>
                      </div>
                      <div style="padding-left: 0px;"" class="row">
                        <div class="form-group" style="padding-right: 15px; padding-left: 10px"">
                        <label class="form-label">Date of Attendance</label>
                          <select style="padding-right: 40px;"  required="" name="overtime_month" class="form-control custom-select">
                              <option class="text-muted" value="">Month</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                            </select>
                      </div> 
                      <div style="" class="col-md-4">
                        <label class="form-label">&nbsp</label>
                              <select   required="" name="overtime_day" class="form-control custom-select">
                              <option class="text-muted" value="">Day</option>
                              <option value="01">1</option>
                              <option value="02">2</option>
                              <option value="03">3</option>
                              <option value="04">4</option>
                              <option value="05">5</option>
                              <option value="06">6</option>
                              <option value="07">7</option>
                              <option value="08">8</option>
                              <option value="09">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15">15</option>
                              <option value="16">16</option>
                              <option value="17">17</option>
                              <option value="18">18</option>
                              <option value="19">19</option>
                              <option value="20">20</option>
                              <option value="21">21</option>
                              <option value="22">22</option>
                              <option value="23">23</option>
                              <option value="24">24</option>
                              <option value="25">25</option>
                              <option value="26">26</option>
                              <option value="27">27</option>
                              <option value="28">28</option>
                              <option value="29">29</option>
                              <option value="30">30</option>
                              <option value="31">31</option>
                            </select>
                      </div>   
                      <div  class="col-md-4">
                        <label class="form-label">&nbsp</label>
                              <select  required="" name="overtime_year" class="form-control custom-select">
                              <option class="text-muted" value="">Year</option>
                              <?php 
                              $start_year = 2015;
                              $current_year = date("Y", time())+1;

                              $diff_bt_year = $current_year - $start_year;

                              while($start_year != $current_year){
                                $current_year--;
                              ?>
                                <option value="<?php echo $current_year ?>"><?php echo $current_year ?></option>
                              <?php } ?>
                            </select>
                      </div> 
                  
                      </div> 
                      <div class="-group">
                        <div class="form-label">Options</div>
                        <div class="custom-controls-stacked">
                          <label class="custom-control custom-radio custom-control-inline">
                            <input required="" type="radio" class="custom-control-input" name="time_in_option" value="Morning" >
                            <span class="custom-control-label">Time Out Morning</span>
                          </label>
                          <label class="custom-control custom-radio custom-control-inline">
                            <input required="" type="radio" class="custom-control-input" name="time_in_option" value="Afternoon">
                            <span class="custom-control-label">Time Out Aftenoon</span>
                          </label>

                        </div>
                      </div>

                
                      <div style="padding-top: 12px;" class="form-group">
                        <label class="form-label">Time Out</label>
                      <div class="bootstrap-timepicker">
                        <input required="true" type="text" class="form-control timepicker"  name="time_in">
                      </div>
                      </div>
                                                     
                    </div>               
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add_time_out" class="btn success p-x-md">Add Time Out</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>