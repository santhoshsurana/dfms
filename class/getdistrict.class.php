<?php session_start();
	require_once("db.class.php");
	$city=$_GET['city'];
	$sql = "SELECT  dist.id,state.id FROM geo_locations city INNER JOIN geo_locations dist ON dist.id=city.parent_id AND dist.location_type='DISTRICT' INNER JOIN geo_locations state ON state.id=dist.parent_id AND state.location_type='STATE' WHERE city.id='$city'";
	$result = $conn->db($sql);
	$data=mysqli_fetch_array($result);
	echo $data[0].'-'.$data[1];
	
?>