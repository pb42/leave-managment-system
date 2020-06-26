<?php
include 'header.php';
$department = " ";
$id ="";
if(!isset($_SESSION['ROLE'])){
    header("location:login.php");
}
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);
$res = mysqli_query($conn,"select * from department where id = '$id'");
$row = mysqli_fetch_assoc($res);
$department = $row['department'];
}
if(isset($_POST['dpt'])){
    $dept = mysqli_real_escape_string($conn,$_POST['dpt']);
    if($id > 0) {
        $sql = "update department set  department = '$dept' where id = '$id'";
       
        
    } else {
        $sql = "insert into department(department) values ('$dept')";
    }
    mysqli_query($conn,$sql);
    header("location:dash.php");
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
                      <label for="exampleInputUsername1">Department Name</label>
                      <input type="text" class="form-control"  name="dpt" placeholder="Department Name" value="<?php echo $department ?>" required>
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