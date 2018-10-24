<?php 
class dbConnect {
    

    public function db($sql){
        $DB_HOST='localhost';
        $DB_NAME='daily_finance';
        $DB_USERNAME='root';
        $DB_PASSWORD='root';
        $conn = mysqli_connect($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME) or trigger_error(mysqli_error(),E_USER_ERROR);
        $result=mysqli_query($conn, $sql);
        return $result;
    }
    
}
?>