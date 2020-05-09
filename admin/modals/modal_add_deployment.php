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

 if(isset($_POST['add_deploy'])){
  $edu = $_POST['project'];
  $year  = $_POST['year'];
  $deg = ucwords($_POST['location']);


  $insert = "UPDATE `employees` SET `project_name` = '$edu', `site_location` = '$deg' WHERE (`employee_id` = '$empd');";

 $query = mysqli_query($connection, $insert) or die(mysqli_error().$insert);

echo "<script>window.location.href='view.php?id=$empd'</script>";
 }

?>


<div id="modal-add-deployment" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">Employee Deployment</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div class="form-group">
     <label class="form-label">Project Name</label>
                        <input name="project" type="text" class="form-control" required placeholder="Enter project name...">
                      </div>
                     
                                            <div class="form-group">
                        <label class="form-label">Site Location</label>
                        <input name="location" type="text" class="form-control" required placeholder="Enter site location...">
                      </div>    
                    </div>               
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add_deploy" class="btn success p-x-md">Add Deployment</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

<div id="modal-view-bacode" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Barcode</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
        <center><img src="<?php echo $emp['path'] ?>">  </center> 
        <center><p ><strong><?php echo $emp['employee_id'] ?></strong></p></center>     
        <br>
        <center><h6 class="small">Generate on <?php echo date('F m, Y', strtotime($emp['generated_on'])) ?></h6></center>      
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="button" class="btn dark-white p-x-md">Print</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>
