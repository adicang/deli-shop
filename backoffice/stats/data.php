<?php
require_once('../includes/init.php');
global $database;
if (!$database) {
    die("Connection failed: " . $database->error);
}
$now = date('m');
if (isset($_GET['orders'])) {
    $sql    = "SELECT count(order_id) AS orders FROM orders WHERE MONTH(create_date)='$now' and not status='בוטלה'";
    $result = $database->query($sql);
    $data   = array();
    $row=mysqli_fetch_assoc($result);
    $data[0] = $row['orders'];
} else if (isset($_GET['yearly'])) {
    $year   = $_GET['yearly'];
    $sql    = "SELECT count(order_id) AS orders, MONTH(create_date) AS month FROM orders WHERE YEAR(create_date)='2019' AND NOT status='בוטלה' GROUP BY MONTH(create_date)";
    $result = $database->query($sql);
    $data   = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
} else {
    //query to get data from the table
    $year = 2019;
    
    $query = "SELECT MONTH(create_date) AS month, SUM(total_payment) AS sum FROM orders WHERE YEAR(create_date)='$year' AND NOT status='בוטלה' GROUP BY MONTH(create_date)";
    
    $result = $database->query($query);
    //loop through the returned data
    $data   = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    
    //now print the data
}
echo json_encode($data);
?>