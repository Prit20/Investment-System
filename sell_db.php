<?php
include('include/dbcon.php');

if(isset( $_POST['sell'])){
    $sell_id= $_POST['iid'];
$scriptName = $_POST['scriptName'];
$sector = $_POST['sector'];
$entryDate = $_POST['entryDate'];
$quantity = $_POST['quantity'];
$entryPrice = $_POST['entryPrice'];
$amount = $_POST['amount'];
$brokerage = $_POST['brokerage'];
$totalbrokerage = $_POST['totalBrokerage'];
$totalamount = $_POST['totalAmount'];

$sql = "INSERT INTO sell (sell_id, name, sector, selldate, sellquantity, sellprice, amount, brokerage, totalbrokerage, totalamount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($sell_id, $scriptName, $sector, $entryDate, $quantity, $entryPrice, $amount, $brokerage, $totalbrokerage, $totalamount);
$query = sqlsrv_query($con, $sql, $params);
if ($query) {
    // Redirect to buysell.php after successful insertion
    header('location:buysell.php');
    exit(); // Exit script after redirection
} else {
    // Print SQL error if insertion fails
    echo "Error executing SQL query: $sql";
    if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error['SQLSTATE']."<br />";
            echo "code: ".$error['code']."<br />";
            echo "message: ".$error['message']."<br />";
        }
    }
    exit(); // Exit script on SQL query error
}
}

?>