<?php 

 if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])){
    header("location:index.php?utm_campaign=expired");
 }


$getSched = "SELECT * FROM `schedules`;";
$res = mysqli_query($connection, $getSched);


  $timezone = 'Asia/Manila';
  date_default_timezone_set($timezone);



 $numbers = '';
    for($i = 0; $i < 7; $i++){
      $numbers .= $i;
    }

$id = substr(str_shuffle($numbers), 0, 9);



 if(isset($_POST['add_sched'])){
  $time_in_morning = $_POST['time_in_morning'];
  $time_out_morning = $_POST['time_out_morning'];
  $time_in_afternoon = $_POST['time_in_afternoon'];
  $time_out_afternoon = $_POST['time_out_afternoon'];

  $tim = date('H:i:s', strtotime($time_in_morning));
  $tom = date('H:i:s', strtotime($time_out_morning));
  $tia = date('H:i:s', strtotime($time_in_afternoon));
  $toa = date('H:i:s', strtotime($time_out_afternoon));

 

  $model->AddSchedule($id, $tim, $tom, $tia, $toa);
echo "<script>window.location.href='schedule.php'</script>";

 }




?>


<div id="modal-add-schedule" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">New Schedule</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="row">
                       <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Morning Schedule</label>
                             <select  required="true" name="time_in_morning" class="form-control custom-select">
                              <option class="text-muted" value="">Select Time In</option>
                              <option value="07:00">07:00 AM</option>
                              <option value="07:30">07:30 AM</option>
                              <option value="08:00">08:00 AM</option>


                            </select>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">&nbsp</label>
                             <select  required="true" name="time_out_morning" class="form-control custom-select">
                              <option class="text-muted" value="">Select Time Out</option>
                              <option value="11:00">11:00 AM</option>
                              <option value="11:30">11:30 AM</option>
                              <option value="12:00">12:00 PM</option>

                            </select>
                      </div>     
                    </div>
                      <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">Afternoon Schedule</label>
                             <select  required="true" name="time_in_afternoon" class="form-control custom-select">
                              <option class="text-muted" value="">Select Time In</option>
                              <option value="01:00">01:00 PM</option>


                            </select>
                      </div>
                    </div>
                     <div class="col-md-6">
                      <div class="form-group">
                        <label class="form-label">&nbsp</label>
                             <select  required="true" name="time_out_afternoon" class="form-control custom-select">
                              <option class="text-muted" value="">Select Time Out</option>
                              <option value="05:00">05:00 PM</option>

                            </select>
                      </div>     
                    </div>
                    </div>               
      </div>
      <div class="modal-footer">
        <div  >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add_sched" class="btn success p-x-md">Add Schedule</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

