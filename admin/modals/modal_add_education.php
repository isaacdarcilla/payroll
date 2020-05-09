<?php 

 if(!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])){
    header("location:index.php?utm_campaign=expired");
 }


 $queryPosition = "SELECT * FROM `position`;";
 $queryResult = mysqli_query($connection, $queryPosition);

 $numbers = '';
    for($i = 0; $i < 10; $i++){
      $numbers .= $i;
    }

$empd = $_GET['id'];

$empid = $emp['empid'];
$employee_id = $emp['employee_id'];

$id = substr(str_shuffle($numbers), 0, 9);

 if(isset($_POST['add_educ'])){
  $edu = $_POST['educational'];
  $year  = $_POST['year'];
  $deg = ucwords($_POST['degree']);


  $insert = "INSERT INTO `education` (`employee_id`, `attained`, `year_graduated`, `eid`, `degree_received`) VALUES ('$empid', '$edu', '$year', '$employee_id', '$deg');";

 $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

echo "<script>window.location.href='view.php?id=$empd'</script>";
 }

?>


<div id="modal-add-education" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Educational Attainment</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Attained</label>
                             <select  required="" name="educational" class="form-control custom-select">
                              <option class="text-muted" value="">Select educational attainment</option>
                              <option value="Elementary">Elementary</option>
                              <option value="High School">High School</option>
                              <option value="College">College</option>

                            </select>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Year Graduated</label>
<select required="" name="year" class="form-control custom-select">
                              <option class="text-muted" value="">Select year graduated</option>
                              <?php 
                              $start_year = 1930;
                              $current_year = date("Y", time())+1;

                              $diff_bt_year = $current_year - $start_year;

                              while($start_year != $current_year){
                                $current_year--;
                              ?>
                                <option value="<?php echo $current_year ?>"><?php echo $current_year ?></option>
                              <?php } ?>
                            </select>
                      </div> 
                                            <div class="form-group">
                        <label class="form-label">Degree/Honors Received</label>
                        <input name="degree" type="text" class="form-control" required placeholder="Enter degree/honors received...">
                      </div>    
                    </div>               
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add_educ" class="btn success p-x-md">Add Education</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

<script type="text/javascript">
function printPage2(){
    var divElements = document.getElementById('printDataHolder2').innerHTML;
    var oldPage = document.body.innerHTML;
    document.body.innerHTML="<link rel='stylesheet' href='css/common.css' type='text/css' /><body class='bodytext'><div class='padding'><b style='font-size: 16px;'><p class=''></p></b></div>"+divElements+"</body>";
    window.print();
    document.body.innerHTML = oldPage;
    }
</script>   

<div id="modal-view-barcode" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Barcode</h5>
      </div>
      <form action="" method="post" > 
      <div class="modal-body p-lg"  id="printDataHolder2">         
        <center><img src="<?php echo $emp['path'] ?>">  </center> 
        <center><p ><strong><?php echo $emp['employee_id'] ?></strong></p></center>     
        <br>
        <center><h6 class="small">Generated on <?php echo date('F m, Y', strtotime($emp['generated_on'])) ?></h6></center>      
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="button" class="btn dark-white p-x-md" onclick="printPage2()">Print</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>
