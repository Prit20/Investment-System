<?php


include('include/dbcon.php');

if(isset($_POST['buy'])) {
    $scriptName = $_POST['scriptName'];
    $sector = $_POST['sector'];
    $entrydate = $_POST['entryDate'];
    $quantity = $_POST['quantity'];
    $entryPrice = $_POST['entryPrice'];
    $amount = $_POST['amount'];
    $brokerage = $_POST['brokerage'];
    $totalbrokerage = $_POST['totalBrokerage'];
    $totalamount = $_POST['totalAmount'];

    // Insert into database
    // $sql = "INSERT INTO bought_items (scriptname,quantity, entryprice,brokerage) VALUES (?, ?, ?, ?)";
    // $params = array($scriptName,$quantity, $entryPrice,$brokerage);
    // $stmt = sqlsrv_query($con, $sql, $params);
    $sql = "INSERT INTO bought_items (name, sector,entrydate,quantity, entryprice, amount,brokerage,totalbrokerage,totalamount) VALUES ('$scriptName','$sector','$entrydate','$quantity', '$entryPrice', '$amount','$brokerage','$totalbrokerage','$totalamount')";
    // $params = array($scriptName, $sector,$entrydate,$quantity, $entryPrice, $amount,$brokerage,$totalbrokerage,$totalamount);
    $run = sqlsrv_query($con, $sql);

    if($run) {
        echo "Bought item saved successfully";
        header('location:buysell.php');
    } else {
        echo "Error: Unable to save bought item";
    }
} else {
    echo "Error: Invalid request";
}
?>
