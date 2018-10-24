<?php 
require_once( "db.class.php"); 
if(isset($_GET[ 'p'])){
$page=$_GET[ 'p'];
}else{
	$page=0;
}
$page_back=$page-15; 
if($page_back<0){
	$page_back=0;
	$page_back_limit=0;
	}else{
	$page_back_limit=1;
	}
$page_next=$page+15;
$sql="SELECT * FROM `employees`  LIMIT ".$page_back. ", ".$page_back_limit;
$conn=new dbConnect; 	$result=$conn->db($sql);
$back_page_count=mysqli_num_rows($result);
$sql="SELECT * FROM `employees`  LIMIT " .$page_next. ", 1";
$conn=new dbConnect; 	$result=$conn->db($sql);
$next_page_count=mysqli_num_rows($result); ?>    

<?php $sql="SELECT * FROM `employees`  LIMIT " .$page. ", 15";
	 $conn=new dbConnect; 	$result=$conn->db($sql);
	 $page_count=mysqli_num_rows($result);
	 if($page_count!=0){ ?>
		<!-- start of view employee tab  -->
      <div class="row-fluid">  <h3>employees List</h3></div>
              <table class='table table-hover table-bordered' id="employeesTable">
              <thead>
              	<tr>
                    <th>ID</th>
                    <th>employeename</th>
                    <th>Role</th>
                    <th>change password</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
<?php
	$i=1;
	while($data=mysqli_fetch_array($result))
	{
		if($data['employee_role']==0 || $data['employee_role']==1){
			$employee_role="Adminnistrator";
		}
		else {
			$employee_role="employee";
		}
		?>
   <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $data['employeename']; ?></td>
        <td><?php echo $employee_role; ?></td>
        <td><button class='btn' onClick='editemployee(<?php echo $data['employee_id']; ?>)'><i class='icon-edit'></i></button></td>
        <td><?php if($data['employeename']!='root'){?><button class='btn' onClick='deleteemployee(<?php echo $data['employee_id']; ?>)'><i class='icon-remove'></i></button><?php }?></td>
    </tr>
<?php
		$i++;
	}
	?>
</tbody>
</table>
<!-- end of employee tab  -->
<?php } ?>
          <script>   
$(data).ready( function () {
    $('#employeesTable').DataTable();
} );


     </script> 