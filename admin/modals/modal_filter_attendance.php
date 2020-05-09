<?php 

if(isset($_POST['apply'])){
$fromDate = $_POST['overtime_year'].'-'.$_POST['overtime_month'].'-'.$_POST['overtime_day'];


echo "<script>window.location.href='attendance.php?filter=$fromDate'</script>";

}

?>


<div id="modal-filter-attendance" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Attendance Date Filter</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div style="padding-left: 0px;"" class="row">
                        <div class="form-group" style="padding-right: 15px;">
                        <label class="form-label">Filter</label>
                          <select style="padding-right: 50px;"  required="" name="overtime_month" class="form-control custom-select">
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
 

                    </div>   
                                 
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="apply" class="btn success p-x-md">Apply</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>