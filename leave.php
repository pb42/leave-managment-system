<?php
require 'header.php';


if(isset($_GET['id']) && $_GET['type']=='delete' && $_GET['type'] == 'delete'){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $chkid = "delete from `leave` where id = '$id'";
    mysqli_query($conn,$chkid);
    
}
if(isset($_GET['id']) && $_GET['type']=='update' && $_GET['type'] == 'update'){
    $id = mysqli_real_escape_string($conn,$_GET['id']);
    $status = mysqli_real_escape_string($conn,$_GET['status']);
    $chkid = "update `leave` set leave_status='$status' where id = '$id'";
    mysqli_query($conn,$chkid);
    
}
 if($_SESSION['ROLE'] == 1) {
     $sql="select `leave`.*, employee.name,employee.id as eid from `leave`,employee where `leave`.employee_id=employee.id order by `leave`.id desc";
 } else{
     $eid = $_SESSION['USER_ID'];
     $sql="select `leave`.*, employee.name ,employee.id as eid from `leave`,employee where `leave`.employee_id='$eid' and `leave`.employee_id=employee.id order by `leave`.id desc";
 }


$res = mysqli_query($conn,$sql);
?>
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title">Leave Master</h1>
                  <?php if($_SESSION['ROLE'] == 2) { ?>
                  <h1 class="card-title" ><a href="add_leave.php" class="leave">ADD LEAVE</a></h1>
                    <?php } ?>
                    <div class="table-responsive pt-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th width="5%">
                            Sn
                          </th>
                          <th width="5%">
                            EMP.ID
                          </th>
                           <th width="5%">
                            EMP.NAME
                          </th>
                          <th width="10%">
                            Leave ID
                          </th>
                          <th width="10%">
                            From Date
                          </th>
                          <th width="10%">
                              To Date
                          </th>
                          <th width="">
                            Description
                          </th>
                          <th width="15%">
                           Status
                          </th>
                          <th width="">
                          </th>
                      </thead>
                      <tbody>
                      <?php 
                          $i = 1;
                          while($row = mysqli_fetch_assoc($res)) { ?>
                      
                        <tr> 
                          <td><?php echo $i ?> </td>
                          <td><?php echo $row['id'] ?> </td>
                           <td><?php echo $row['name'].' ('.$row['eid'].')'?></td>
                          <td><?php echo $row['leave_id'] ?> </td>
                          <td><?php echo $row['leave_from'] ?> </td>
                          <td><?php echo $row['leave_to'] ?> </td>
                          <td><?php echo $row['leave_description'] ?> </td>
                          <td>
                          <?php
                          if($row['leave_status'] ==1){
                              echo "Applied";
                          } if($row['leave_status'] ==2){
                              echo "Approved";
                          } if($row['leave_status'] ==3){
                              echo "Rejected";
                          }                   
                          ?><br>
                          <?php if($_SESSION['ROLE'] == 1) { ?>
                             <select class="form-control-sm" onchange="update_leave_status('<?php echo $row['id']?>',this.options[this.selectedIndex].value)">
                             <option value="">Update Status</option>
                             <option value="2">Approved</option>
                             <option value="3">Rejected</option>
                             </select>
                         <?php  } ?>
                        </td>
                          <td>
                          <?php$row['leave_status'] ==1 { ?>
                           <a href="leave.php?id=<?php echo $row['id']?>&type=delete" class="btn btn-inverse-dark btn-fw btn-sm">Delete</a>
                            <?php } ?>
                        </td> 
                        </tr>
                        <?php $i++;  ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
     <script>
		 function update_leave_status(id,select_value){
			window.location.href='leave.php?id='+id+'&type=update&status='+select_value;
		 }
		 </script>
<?php
include 'footer.php';
?>