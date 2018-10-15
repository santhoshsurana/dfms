<?php session_start();
session_unset('employeename');
session_destroy();
header("location: index.php");
exit();
?>