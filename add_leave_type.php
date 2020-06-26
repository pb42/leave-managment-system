<?php
include 'header.php';
$department = " ";
$id ="";
$leave_type="";
if(!isset($_SESSION['ROLE'])){
    header("location:login.php");
}
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);
$res = mysqli_query($conn,"select * from leave_type where id = '$id'");
$row = mysqli_fetch_assoc($res);
$leave_type = $row['leave_type'];
}
if(isset($_POST['leave_type'])){
    $dept = mysqli_real_escape_string($conn,$_POST['leave_type']);
    if($id > 0) {
        $sql = "update leave_type set  leave_type = '$dept' where id = '$id'";
       
        
    } else {
        $sql = "insert into leave_type(leave_type) values ('$dept')";
    }
    mysqli_query($conn,$sql);
    header("location:leave_type.php");
    die();
}
?>
<div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Department Form</h4>
                  
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="Leave Type">Leave Type </label>
                      <input type="text" class="form-control"  name="leave_type" placeholder="Leave Type" value="<?php echo $leave_type ?>" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                   
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