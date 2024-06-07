<?php
include('include/dbcon.php');

if(isset($_GET['scriptName'])) {
    $scriptName = $_GET['scriptName'];
    // $sector = $_POST['sector'];
    // $entrydate = $_POST['entrydate'];
    // $quantity = $_POST['quantity'];
    // $entryPrice = $_POST['entryprice'];
    // $amount = $_POST['amount'];
    // $brokerage = $_POST['brokerage'];
    // $totalbrokerage = $_POST['totalbrokerage'];
    // $totalamount = $_POST['totalamount'];


    // Fetch all data related to the entered script name
    $sql = "SELECT * FROM bought_items WHERE name = ?";
    $params = array($scriptName);
    $stmt = sqlsrv_query($con, $sql, $params);

    if($stmt) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['sector'] . "</td>";
            echo "<td>" . $row['entrydate'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['entryprice'] . "</td>";
            echo "<td>" . $row['amount'] . "</td>";
            echo "<td>" . $row['brokerage'] . "</td>";
            echo "<td>" . $row['totalbrokerage'] . "</td>";
            echo "<td>" . $row['totalamount'] . "</td>";
            // Display other relevant columns here
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No data found for entered script name</td></tr>";
    }
} else {
    echo "<tr><td colspan='3'>Invalid request</td></tr>";
}
?>
