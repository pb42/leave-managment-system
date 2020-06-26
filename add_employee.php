<?php
include 'header.php';
$department = " ";
$id ="";
$name = "";
$email = "";
$mobile = "";
$password = "";
$dept_id = "";
$address = "";
$birthday = "";
if(!isset($_SESSION['ROLE'])){
    header("location:login.php");
}
if(isset($_GET['id'])){
$id = mysqli_real_escape_string($conn,$_GET['id']);
if($_SESSION['ROLE'] == 2 && $_SESSION['USER_ID'] != $id){
    die("Access Denied");
}
$res = mysqli_query($conn,"select * from employee where id = '$id'");
$row = mysqli_fetch_assoc($res);
$name = $row['name'];
$email = $row['email'];
$mobile = $row['mobile'];
$dept_id = $row['dept_id'];
$address = $row['address'];
$birthday = $row['birthday'];
}
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    $dept_id = mysqli_real_escape_string($conn,$_POST['dept_id']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $birthday = mysqli_real_escape_string($conn,$_POST['birthday']);
 
    
    if($id > 0) {
        $sql = "update employee set  name = '$name', email = '$email', mobile = '$mobile', password = '$password',  dept_id = '$dept_id', address = '$address', birthday = '$birthday' where id = '$id'";
       
        
    } else {
        $sql = "insert into employee(name,email,mobile,password,dept_id,address,birthday,role) values ('$name','$email','$mobile','$password','$dept_id','$address','$birthday','2')";
    }
    mysqli_query($conn,$sql);
    header("location:employee.php");
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
                      <label for="Name">Name </label>
                      <input type="text" class="form-control"  name="name" placeholder="Enter Employee name" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control"  name="email" placeholder="Enter Employee Email" value="<?php echo $email ?>" required>
                    </div>
                      <div class="form-group">
                      <label for="Mobile">Mobile </label>
                      <input type="text" class="form-control"  name="mobile" placeholder="Enter Employee Mobile" value="<?php echo $mobile ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control"  name="password" placeholder="Enter Employee Password"  required>
                    </div>
                    <div class="form-group">
                      <label for="dept_id">Department</label>
                      <select name="department_id" class="form-control" placeholder="" required>
                          <option value="" >Select Department</option>
                          <?php
                            $res = mysqli_query($conn,"select * from department order by department desc");
                            while($row = mysqli_fetch_assoc($res)) {
                                echo "<option selected='selected' value=".$row['id'].">".$row['department']."</option>";
                            }
                          
                          ?>
                          
                          
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="address">Address </label>
                      <input type="text" class="form-control"  name="address" placeholder="Enter Employee Address" value="<?php echo $address ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="birthday">Birthday</label>
                      <input type="date" class="form-control"  name="birthday" placeholder="Enter Employee Birthdate" value="<?php echo $birthday ?>" required>
                    </div>
                    <?php if($_SESSION['ROLE'] == 1) {  ?>
                    <button type="submit" name="submit" class="btn btn-primary mr-2">Submit</button>
                    <?php } ?>
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