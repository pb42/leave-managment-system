<?php
include 'header.php';
if(isset($_POST['submit'])){
    $leave_id=mysqli_real_escape_string($conn,$_POST['leave_id']);
	$leave_from=mysqli_real_escape_string($conn,$_POST['leave_from']);
	$leave_to=mysqli_real_escape_string($conn,$_POST['leave_to']);
	$employee_id=$_SESSION['USER_ID'];
	$leave_description=mysqli_real_escape_string($conn,$_POST['leave_descp']);
	$sql="insert into `leave`(leave_id,leave_from,leave_to,employee_id,leave_description,leave_status) values('$leave_id','$leave_from','$leave_to','$employee_id','$leave_description',1)";
	mysqli_query($conn,$sql);
	header('location:leave.php');
	die();
}
?>
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">LEAVE TYPE</h4>
                  
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="dept_id">Leave Type</label>
                      <select name="leave_id" class="form-control" required>
                          <option value="">Select Department</option>
                          <?php
                            $res = mysqli_query($conn,"select * from department order by department desc");
                            while($row = mysqli_fetch_assoc($res)) {
                                 echo "<option  value=".$row['id'].">".$row['department']."</option>";
                            }
                          ?>

                      </select>
                    </div>
                    <div class="form-group">
                      <label for="Name">From Date</label>
                      <input type="date" class="form-control"  name="leave_from" required>
                    </div>
                    <div class="form-group">
                      <label for="email">To  Date</label>
                      <input type="date" class="form-control"  name="leave_to"   required>
                    </div>
                     <div class="form-group">
                      <label for="email">Leave Description</label>
                      <input type="text" class="form-control" name ="leave_descp">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
      </div>
    </div>
</div>
<?php
  include 'footer.php';
?>