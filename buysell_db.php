<?php

include('include/dbcon.php');


if(isset($_POST['id'])){
    $id =$_POST['id'];

    $name=$_POST['name'];
    $sector=$_POST['sector'];
    $entrydate=$_POST['entrydate'];
    $quantity=$_POST['quantity'];
    $entryprice=$_POST['entryprice'];
    $amount=$_POST['amount'];
    $brokerage=$_POST['brokerage'];
    $totalbrokerage=$_POST['totalbrokerage'];
    $totalamount=$_POST['totalamount'];
    

    $sql1 = "UPDATE bought_items SET name = ?, sector = ?, entrydate = ?, quantity = ?, entryprice = ?, amount = ?, brokerage = ?, totalbrokerage = ?, totalamount = ? WHERE id = ?";
$params = array($name, $sector, $entrydate, $quantity, $entryprice, $amount, $brokerage, $totalbrokerage, $totalamount, $id);
$run1 = sqlsrv_query($con, $sql1, $params);

if ($run1) {
    echo('Update Successful');
} else {
    echo('Update Failed');
    // Uncomment the following line to print detailed error information
    // print_r(sqlsrv_errors());
}

}

?>