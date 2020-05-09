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

$id = substr(str_shuffle($numbers), 0, 9);

 if(isset($_POST['add'])){
  $position = $_POST['position-title'];
  $rate = $_POST['rate'];

  $model->AddPosition($position, $rate, $id);

echo "<script>window.location.href='position.php'</script>";
 }

?>


<div id="modal-add-position" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
      	<h5 class="modal-title">New Position</h5>
      </div>
      <form action="" method="post"> 
      <div class="modal-body p-lg">         
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="form-label">Position Title</label>
                        <input type="text" required="true" class="form-control" name="position-title" placeholder="Position...">
                      </div>
                      <div class="form-group">
                        <label class="form-label">Rate Per Hour</label>
                        <input type="number" required="true" class="form-control" name="rate" placeholder="Rate...">
                      </div>     
                    </div>               
      </div>
      <div class="modal-footer">
        <div  style="padding-right: 12px;" >
        <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">Close</button>
        <button type="submit" name="add" class="btn success p-x-md">Add Position</button>
        </div>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div>
</div>

