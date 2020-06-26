<?php
require 'header.php';
if(!isset($_SESSION['ROLE'])){
    header("location:login.php");
}
if($_SESSION['ROLE']!=1){
	header('location:add_employee.php?id='.$_SESSION['USER_ID']);
	die();
}
if(isset($_GET['id']) && $_GET['type']=='delete' && $_GET['type'] == 'delete'){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $chkid = "delete from leave_type where id = '$id'";
    mysqli_query($conn,$chkid);
    
}

$sql = "select * from leave_type order by id desc";
$res = mysqli_query($conn,$sql);
?>
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title">Leave Type Master</h1>
                  <h1 class="card-title" ><a href="add_leave_type.php" class="add_leave">ADD LEAVE TYPE</a></h1>
                  <div class="table-responsive pt-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th width="5%">
                            Sn
                          </th>
                          <th width="5%">
                            ID
                          </th>
                          <th width="60%">
                            LEAVE TYPE
                          </th>
                          <th width="30%">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                          $i = 1;
                          while($row = mysqli_fetch_assoc($res)) { ?>
                      
                        <tr> 
                          <td><?php echo $i ?> </td>
                          <td><?php echo $row['id'] ?> </td>
                          <td><?php echo $row['leave_type'] ?> </td>
                          <td>
                           <a href="./add_leave_type.php?id=<?php echo $row['id']?>" class="btn btn-inverse-prima btn-fw btn-sm">Edit</a><a href="leave_type.php?id=<?php echo $row['id']?>&type=delete" class="btn btn-inverse-dark btn-fw btn-sm">Delete</a>
                            
                        </td>
                        </tr>
                        <?php $i++; } ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     
<?php
include 'footer.php';
?>