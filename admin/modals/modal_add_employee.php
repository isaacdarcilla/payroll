<?php

if (!isset($_SESSION['official_username']) && !isset($_SESSION['official_password']) && !isset($_SESSION['official_id'])) {
  header("location:index.php?utm_campaign=expired");
}



if (isset($_POST['add_new'])) {

  $numbers = '';
  for ($i = 0; $i < 10; $i++) {
    $numbers .= $i;
  }

  $employee_id = substr(str_shuffle($numbers), 0, 9);
  $position_id = $_POST['desired_position'];
  $schedule_id = $_POST['desired_schedule'];

  $photo = $_FILES['img_name']['name'];
  $target = "../image/" . basename($photo);
  move_uploaded_file($_FILES['img_name']['tmp_name'], $target);

  $first = ucwords($_POST['first']);
  $middle = ucwords($_POST['middle']);
  $last = ucwords($_POST['last']);

  $fullname = $first . ' ' . $middle . ' ' . $last;
  $address = ucwords($_POST['address']);
  $email = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];
  $birthdate = $_POST['birth_year'] . '-' . $_POST['birth_month'] . '-' . $_POST['birth_day'];
  $sex = $_POST['sex'];
  $position = $_POST['desired_position'];
  $civil_status = $_POST['civil_status'];
  $citizenship = ucwords($_POST['citizenship']);
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $religion = ucwords($_POST['religion']);
  $spouse = ucwords($_POST['spouse_fullname']);
  $spouse_occupation = ucwords($_POST['spouse_occupation']);
  $father = ucwords($_POST['father_fullname']);
  $father_occupation = ucwords($_POST['father_occupation']);
  $mother = ucwords($_POST['mother_fullname']);
  $mother_occupation = ucwords($_POST['mother_occupation']);
  $parent_address = ucwords($_POST['parent_address']);
  $emergency_name = ucwords($_POST['emergency_name']);
  $emergency_contact = $_POST['emergency_contact'];
  $date = date("Y-m-d");

  $insert = "INSERT INTO `employees` (`employee_id`, `position_id`, `schedule_id`, `created_on`, `photo`, `fullname`, `address`, `email`, `phonenumber`, `birthdate`, `sex`, `position`, `civil_status`, `citizenship`, `height`, `weight`, `religion`, `spouse`, `spouse_occupation`, `father`, `father_occupation`, `mother`, `mother_occupation`, `parent_address`, `emergency_name`, `emergency_contact`) VALUES ('$employee_id', '$position_id', '$schedule_id', '$date', '$photo', '$fullname', '$address', '$email', '$phonenumber', '$birthdate', '$sex', '$position', '$civil_status', '$citizenship', '$height', '$weight', '$religion', '$spouse', '$spouse_occupation', '$father', '$father_occupation', '$mother', '$mother_occupation', '$parent_address', '$emergency_name', '$emergency_contact');";

  $query = mysqli_query($connection, $insert) or die("Could not insert: $insert");

  echo "<script>window.location.href='profile.php'</script>";
}

?>
<script type="text/javascript">
  function limitKeypress(event, value, maxLength) {
    if (value != undefined && value.toString().length >= maxLength) {
      event.preventDefault();
    }
  }
</script>


<div id="modal-add-employee" class="modal" data-backdrop="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New Employee Personal Data</h5>
      </div>
      <div class="modal-body p-lg">
        <div class="col-md-12">
          <form class="" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">First Name</label>
                  <input name="first" type="text" class="form-control" required placeholder="Enter first name...">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Middle Name</label>
                  <input name="middle" type="text" class="form-control" required placeholder="Enter middle name...">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Last Name</label>
                  <input name="last" type="text" class="form-control" required placeholder="Enter last name...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Address</label>
                  <input name="address" type="text" class="form-control" required placeholder="Enter address...">
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Email Address</label>
                  <input name="email" type="email" class="form-control" required placeholder="Enter email address...">
                </div>
              </div>
              <div class="col-sm-6 col-md-6">
                <div class="form-group">
                  <label class="form-label">Phone Number</label>
                  <input name="phonenumber" type="number" maxlength="11" min="0" onkeypress="limitKeypress(event,this.value,11)" class="form-control" required placeholder="Enter phone number...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Desired Position</label>
                  <select required="" name="desired_position" class="form-control custom-select">
                    <option class="text-muted">Select Position</option>
                    <?php
                    $pos = "SELECT * FROM `position`;";
                    $res = mysqli_query($connection, $pos);
                    while ($row = mysqli_fetch_assoc($res)) {

                      ?>

                      <option value="<?php echo $row['id']  ?>"><?php echo $row['description']  ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Desired Schedule</label>
                  <select required="" name="desired_schedule" class="form-control custom-select">
                    <option class="text-muted">Select Schedule</option>
                    <?php
                    $pos = "SELECT * FROM `schedules`;";
                    $res = mysqli_query($connection, $pos);
                    while ($row = mysqli_fetch_assoc($res)) {

                      ?>

                      <option value="<?php echo $row['id']  ?>"><?php echo $row['time_in_morning']  ?>-<?php echo $row['time_out_morning']  ?>/<?php echo $row['time_in_afternoon']  ?>-<?php echo $row['time_out_afternoon']  ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-label">Upload Image</div>
                  <div class="custom-file">
                    <input type="file" required class="custom-file-input" name="img_name">
                    <label class="custom-file-label">Choose image file</label>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Birthday</label>
                  <select required="" name="birth_month" class="form-control custom-select">
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
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label class="form-label">&nbsp</label>
                  <select required="" name="birth_day" class="form-control custom-select">
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
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label class="form-label">&nbsp</label>
                  <select required="" name="birth_year" class="form-control custom-select">
                    <option class="text-muted" value="">Year</option>
                    <?php
                    $start_year = 1930;
                    $current_year = date("Y", time()) + 1;

                    $diff_bt_year = $current_year - $start_year;

                    while ($start_year != $current_year) {
                      $current_year--;
                      ?>
                      <option value="<?php echo $current_year ?>"><?php echo $current_year ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Civil Status</label>
                  <select required="" name="civil_status" class="form-control custom-select">
                    <option class="text-muted" value="">Select Civil Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>

                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Sex</label>
                  <select required="" name="sex" class="form-control custom-select">
                    <option class="text-muted" value="">Select Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>


                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Citizenship</label>
                  <input name="citizenship" type="text" class="form-control" required placeholder="Enter citizenship...">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-label">Height</label>
                  <input name="height" type="number" class="form-control" required placeholder="Enter height e.g. 175">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Weight</label>
                  <input name="weight" type="number" class="form-control" required placeholder="Enter weight e.g. 60">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Religion</label>
                  <input name="religion" type="text" class="form-control" required placeholder="Enter religion...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Spouse</label>
                  <input name="spouse_fullname" type="text" class="form-control" required placeholder="Enter spouse full name...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Occupation</label>
                  <input name="spouse_occupation" type="text" class="form-control" required placeholder="Enter spouse occupation...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Father's Name</label>
                  <input name="father_fullname" type="text" class="form-control" required placeholder="Enter father's full name...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Occupation</label>
                  <input name="father_occupation" type="text" class="form-control" required placeholder="Enter father occupation...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Mother's Name</label>
                  <input name="mother_fullname" type="text" class="form-control" required placeholder="Enter mother's full name...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Occupation</label>
                  <input name="mother_occupation" type="text" class="form-control" required placeholder="Enter mother occupation...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Parent's Address</label>
                  <input name="parent_address" type="text" class="form-control" required placeholder="Enter parent address...">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-label">Person to be contacted in case of emergency</label>
                  <input name="emergency_name" type="text" class="form-control" required placeholder="Enter name details...">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-label">His/her contact details</label>
                  <input name="emergency_contact" type="number" maxlength="11" min="0" onkeypress="limitKeypress(event,this.value,11)" class="form-control" required placeholder="Enter contact details...">
                </div>
              </div>
            </div>


        </div>
      </div>
      <div class="modal-footer">
        <div style="padding-right: 12px;">
          <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
          <button type="submit" name="add_new" class="btn danger p-x-md">Save</button></div>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div>
</div>