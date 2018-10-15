<?php 
$DB_HOST = "Localhost";
$DB_NAME = "daily_finance";
$DB_employeeNAME = "root";
$DB_PASSWORD = "root";
$CON = mysqli_connect($DB_HOST, $DB_employeeNAME, $DB_PASSWORD, $DB_NAME) or trigger_error(mysqli_error(),E_employee_ERROR);
?>