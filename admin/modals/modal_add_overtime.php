<?php 

 if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])){
    header("location:index.php?utm_campaign=expired");
 }


 $queryPosition = "SELECT *, overtime.id AS otid, employees.employee_id AS empid FROM overtime LEFT JOIN employees ON employees.id=overtime.employee_id ORDER BY date_overtime DESC;";
 $queryResult = mysqli_query($connection, $queryPosition);

 $numbers = '';
    for($i = 0; $i < 7; $i++){
      $numbers .= $i;
    }

$id = substr(str_shuffle($numbers), 0, 9);

 if(isset($_POST['add'])){
  $employee = $_POST['employee'];
  $date = $_POST['overtime_year'].'-'.$_POST['overtime_month'].'-'.$_POST['overtime_day'];
  $hours = $_POST['hours'] + ($_POST['minutes']/60);

  $rate = $_POST['rate'];


$insert = "INSERT INTO `overtime` (`employee_id`, `overtime_id`, `hours`, `rate_hour`, `date_overtime`) VALUES ('$employee', '$id', '$hours', '$rate', '$date');";

$query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

echo "<script>window.location.href='overtime.php'</script>";
}
?>


<div id="modal-add-overtime" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">New Overtime</h5>
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
                        <div class="form-group" style="padding-right: 15px; padding-left: 10px">
                        <label class="form-label">Date of Overtime</label>
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
                              $start_year = 2010;
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
                
                      <div class="form-group">
                        <label class="form-label">Number of Hours</label>
                        <input name="hours" type="number" class="form-control" required placeholder="Enter number of hours...">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Number of Minutes</label>
                        <input name="minutes" type="number" class="form-control" required placeholder="Enter number of minutes...">
                      </div>      
                      <div class="form-group">
                        <label class="form-label">Rate Per Hour</label>
                        <input name="rate" type="number" maxlength="4" min="0" onkeypress="limitKeypress(event,this.value,4)" class="form-control" required placeholder="Enter rate per hour...">
                      </div>                                  
                    </div>      
                                      <script type="text/javascript">
                              function limitKeypress(event, value, maxLength) {
                                  if (value != undefined && value.toString().length >= maxLength) {
                                      event.preventDefault();
                                  }
                              }                      
                    </script>          
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn success p-x-md">Add Overtime</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

