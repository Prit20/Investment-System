<?php
include('include/dbcon.php');

if(isset($_POST['buy_share'])){
    $share_name=$_POST['share_name'];
    $share_sector=$_POST['share_sector'];
    $buy_date=$_POST['buy_date'];
    $share_quantity=$_POST['share_quantity'];
    $Entry_price=$_POST['Entry_price'];
    $amount=$_POST['amount'];
    $brokerage=$_POST['brokerage'];
    $total_brokerage=$_POST['total_brokerage'];
    $total_amt=$_POST['total_amt'];

    // Debugging: Print out received POST data
    print_r($_POST);

    // Check if share_name exists in scriptname table
    $sql="SELECT id FROM scriptname WHERE name='$share_name'";
    $query=sqlsrv_query($con,$sql);
    if ($query) {
        if (sqlsrv_has_rows($query)) {
            $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
            $iid = $row['id'];
        } else {
            echo "No rows found for share name: $share_name";
            exit(); // Exit script if share name is not found
        }
    } else {
        echo "Error executing SQL query: $sql";
        exit(); // Exit script on SQL query error
    }
// Insert data into bought_items table
$sql2 = "INSERT INTO bought_items (iid, name, sector, entrydate, quantity, entryprice, amount, brokerage, totalbrokerage, totalamount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($iid, $share_name, $share_sector, $buy_date, $share_quantity, $Entry_price, $amount, $brokerage, $total_brokerage, $total_amt);
$query2 = sqlsrv_query($con, $sql2, $params);
if ($query2 !==false) {
    // Redirect to buysell.php after successful insertion
    header('location:buysell.php');
    // exit(); // Exit script after redirection
} else {
    // Print SQL error if insertion fails
    echo "Error executing SQL query: $sql2";
   
    }
    exit(); // Exit script on SQL query error
}



if(isset($_POST['script'])){
    $script_name = $_POST['script'];

    $sql = "SELECT sector FROM scriptname WHERE name = ?";
    
    $params = array($script_name);
    
    $query = sqlsrv_query($con, $sql, $params);

    

    if($query === false) {
        echo json_encode(array("error" => sqlsrv_errors()));
    } else {
        $row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

        if ($row !== false && isset($row['sector'])) {
            echo json_encode(array($row['sector']));
        } else {
            echo json_encode(array("error" => "No sector found for the provided script"));
        }
    }
}
?>