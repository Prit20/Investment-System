<?php
include('include/dbcon.php');

if(isset($_POST['scriptName'])) {
    $scriptName = $_POST['scriptName'];
    
    // Query to get sector based on script name
    $sql = "SELECT sector FROM scriptname WHERE name = ?";
    $params = array($scriptName);
    $stmt = sqlsrv_query($con, $sql, $params);
    
    if($stmt) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        echo $row['sector'];
    } else {
        echo "Error fetching sector";
    }
} else {
    echo "Invalid request";
}
?>
