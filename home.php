<?php
session_start();

if (!isset($_SESSION['employeename']))
{
    header('Location: index.php');
}

require_once ("class/db.class.php");

if (isset($_GET['fromDate']) && isset($_GET['toDate']))
{
    $from_date = $_GET['fromDate'];
    $to_date = $_GET['toDate'];
}
else
{
    $from_date = date('m/d/Y');
    $to_date = date('m/d/Y');
}

$temp = explode('/', $from_date);
$from_date_time = $temp[2] . $temp[0] . $temp[1] . '000000';
$temp = explode('/', $to_date);
$to_date_time = $temp[2] . $temp[0] . $temp[1] . '235959';
?>
<!-- start of Home tab -->
<div class='row-fluid'>
    <h5 class="span6">Hello, 
        <?php echo $_SESSION['employeename']; ?>!</h5>
    <h5 class="span6 pull-left" align='right'><?php
echo date('D d M Y'); ?></h5>
    <label for="from_date" class="pull-left" style="margin:5px">From</label>
    <input name="from_date" id="from_date" class="date-picker pull-left" type="text" value="<?php
echo $from_date; ?>" />
    <label for="to_date" class="pull-left" style="margin:5px">To</label>
    <input name="to_date" id="to_date" class="date-picker pull-left" type="text" value="<?php
echo $to_date; ?>" />
    <button onClick="ViewResults('home.php?');" style="margin:0px 5px;" class="btn btn-inverse">Results</button>
</div>

<div class='row-fluid'>
    <div class="span9">
        <div class='row-fluid'> 
            <div class="span4">
                <div class="board-widgets blue small-widget">
            <a href="#"><span class="widget-stat"><?php
                    $sql = "SELECT COUNT(*) FROM `customers` WHERE `customer_since` BETWEEN " . $from_date_time . " AND " . $to_date_time;
                    $conn=new dbConnect;
                    $result = $conn->db($sql);
                    $data = mysqli_fetch_array($result);

                    if ($data[0] == "")
                    {
                        echo "0";
                    }
                    else
                    {
                        echo $data[0];
                    } ?></span>
                        <span class="widget-icon"></span>
                        <span class="widget-label">Customers</span></a>
        </div>
    </div>
    <div class="span4">
        <div class="board-widgets green small-widget">
            <a href="#"><span class="widget-stat"><?php
$sql = "SELECT COUNT(*) FROM `loans` WHERE  `loan_date` BETWEEN " . $from_date_time . " AND " . $to_date_time;
$conn=new dbConnect;
$result = $conn->db($sql);
$data = mysqli_fetch_array($result);

if ($data[0] == "")
{
    echo "0";
}
else
{
    echo $data[0];
} ?></span>
                            <span class="widget-icon"></span>
                            <span class="widget-label">Loans</span></a>
        </div>
    </div>
    <div class="span4">
        <div class="board-widgets yellow small-widget">
            <a href="#"><span class="widget-stat">&#8377;<?php
$sql = "SELECT SUM(txn_amount) FROM `transactions` WHERE txn_date BETWEEN " . $from_date_time . " AND " . $to_date_time;
$conn=new dbConnect;
$result = $conn->db($sql);
$data = mysqli_fetch_array($result);
$collection = $data[0];

if ($data[0] == "")
{
    echo "0";
}
else
{
    echo $collection;
} ?></span>
                        <span class="widget-icon"></span>
                        <span class="widget-label">Collection Amount</span></a>
        </div>
    </div>
</div>
<div class="row-fluid">
 <div class="span4">
      <div class="board-widgets red small-widget">
            <a href="#"><span class="widget-stat">&#8377;<?php
$sql = "SELECT SUM(loan_amount) FROM `loans` WHERE loan_date BETWEEN " . $from_date_time . " AND " . $to_date_time;
$conn=new dbConnect;
$result = $conn->db($sql);
$data = mysqli_fetch_array($result);
$total_loan = $data[0];

if ($data[0] == "")
{
    echo "0";
}
else
{
    echo $total_loan;
} ?></span>
                        <span class="widget-icon"></span>
                        <span class="widget-label">Total Loan Amount</span></a>   
        </div>
    </div> 
        <div class="span4">
        <div class="board-widgets pale-blue small-widget">
            <a href="#"><span class="widget-stat">&#8377;<?php
$Balance = $total_loan - $collection;

if ($Balance == "")
{
    echo "0";
}
else
{
    echo $Balance;
} ?></span>
                        <span class="widget-icon"></span>
                        <span class="widget-label">Balance Loan Amount</span></a>
        </div>
    </div>
    <div class="span4">
        <div class="board-widgets gray small-widget">
            <a href="#"><span class="widget-stat" id="time"></span>
                        <span class="widget-icon"></span>
                        <span class="widget-label">Time</span></a>
        </div>
    </div>
</div> 
</div>
 <div class="span3">
    

   </div> 
</div>

<!-- end of Home tab -->
<script>
    $('.date-picker').datepicker();
</script>