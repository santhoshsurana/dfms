<?php session_start();
require_once ("db.class.php");

$employeename = $_SESSION['employeename'];
$employee_role = $_SESSION['employee_role'];
$search = $_GET['searchkey'];

if (isset($_GET['p']))
{
	$page = $_GET['p'];
}
else
{
	$page = 0;
}

$page_back = $page - 15;

if ($page_back < 0)
{
	$page_back = 0;
	$page_back_limit = 0;
}
else
{
	$page_back_limit = 1;
}

$page_next = $page + 15;
$sql = "SELECT * FROM `customers` WHERE `customer_mobile` LIKE '%$search%' OR `customer_altmobile` LIKE '%$search%' OR`cin` LIKE '%$search%' OR `customer_first_name` LIKE '%$search%' OR  `customer_last_name` LIKE '%$search%'  ORDER BY customer_since DESC LIMIT " . $page_back . ", " . $page_back_limit;
$result = mysqli_query($CON, $sql);
$back_page_count = mysqli_num_rows($result);
$sql = "SELECT * FROM `customers` WHERE `customer_mobile` LIKE '%$search%' OR `customer_altmobile` LIKE '%$search%' OR`cin` LIKE '%$search%' OR `customer_first_name` LIKE '%$search%' OR  `customer_last_name` LIKE '%$search%'  ORDER BY customer_since DESC LIMIT " . $page_next . ", 1";
$result = mysqli_query($CON, $sql);
$next_page_count = mysqli_num_rows($result); ?>
     
<button onClick="display('class/search.class.php?p=<?php
echo $page_back; ?>&searchkey=<?php
echo $search; ?>);" style="margin:0px 5px;" <?php

if ($back_page_count == 0)
{
	echo 'disabled';
} ?> class="btn pull-left"><i class="icon-circle-arrow-left"></i>back</button>
<button onClick="display('class/search.class.php?p=<?php
echo $page_next; ?>&searchkey=<?php
echo $search; ?>);" style="margin:0px 5px;" <?php

if ($next_page_count == 0)
{
	echo 'disabled';
} ?> class="btn">next<i class="icon-circle-arrow-right"></i></button>

<?php
$sql = "SELECT * FROM `customers` WHERE `customer_mobile` LIKE '%$search%' OR `customer_altmobile` LIKE '%$search%' OR`cin` LIKE '%$search%' OR `customer_first_name` LIKE '%$search%' OR  `customer_last_name` LIKE '%$search%'  ORDER BY customer_since DESC LIMIT " . $page . ", 15";
$result = mysqli_query($CON, $sql);
$page_count = mysqli_num_rows($result);

if ($page_count != 0)
{
?>
 <h3>customers List</h3>
<!-- start of View customer tab  -->
              <table class='table table-hover table-bordered'>
              <thead>
                  <tr>
                    <th>customer ID</th>
                    <th>customer Name</th>
                    <th>Age</th>
                    <th>Gender</th>
					<th>Occupation</th>
                    <th>mobile number</th>
                    <th>alternate mobile number</th>
					<th>Aadhar Number</th>
                    <th>Address</th>
                    <th>customer since</th>
                    <th>New Account</th>
                    <th>Edit</th>
                    <?php
	if ($employee_role == 0)
	{
?>
         <th>Delete</th>
<?php } ?>
               </tr>
                </thead>
                <tbody>
<?php
		while ($data = mysqli_fetch_array($result))
		{
			if ($data['customer_gender'] == 1)
			{
				$data['customer_gender'] = "male";
			}
			elseif ($data['customer_gender'] == 0)
			{
				$data['customer_gender'] = "female";
			}

			$data['customer_since'] = date("d-m-Y h:i:a", strtotime($data['customer_since']));
?>
       <tr>
         <td><?php
			echo $data['cin'];
?></td>    
         <td><?php
			echo $data['customer_first_name'];
?> <?php
			echo $data['customer_last_name'];
?></td>
         <td><?php
			echo $data['customer_age'];
?></td>
         <td><?php
			echo $data['customer_gender'];
?></td>
         <td><?php
			echo $data['customer_occupation'];
?></td>
		<td><?php
			echo $data['customer_mobile'];
?></td>
         <td><?php
			echo $data['customer_altmobile'];
?></td>
         <td><?php
			echo $data['customer_aadhar'];
?></td>
		<td><?php
			echo $data['customer_address'] . ', kakinada, east godavari, andhra pradesh, 533001';
?></td>
		<td><?php
			echo $data['customer_since'];
?></td>
         <td><button class='btn' onClick='showAccount(<?php
			echo $data['cin'];
?>)'><i class='icon-list-alt'></i></button></td>
         <td><button class='btn' onClick='editCustomer(<?php
			echo $data['cin'];
?>)'><i class='icon-edit'></i></button></td>
         <?php	if ($employee_role == 0){?>
        <td><button class='btn' onClick='deleteCustomer(<?php
				echo $data['cin'];
?>)'><i class='icon-remove'></i></button></td>
         <?php	}?>
       </tr>
 <?php		}?>
</tbody>
</table>
<!-- end of View customer tab  -->
<?php
	}
	else
	{
		echo "<h3 align='center'>No Records Found!</h3>";
	}

?>