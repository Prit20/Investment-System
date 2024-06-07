<?php
// Include your database connection file
include('include/dbcon.php');

// Check if the script parameter is set
if(isset($_POST['script'])) {
    // Sanitize the input script name
    $script = $_POST['script'];

    // Prepare and execute the SQL query to fetch previous data based on the script name
    $sql = "SELECT * FROM bought_items WHERE name = ?";
    $params = array($script);
    $stmt = sqlsrv_query($con, $sql, $params);

    // Check if the query executed successfully
    if ($stmt === false) {
        // If the query failed, return an error message
        die( print_r( sqlsrv_errors(), true));
    }

    $data = array();

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $data[] = array(
            'script_name' => $row['name'],
            'sector' => $row['sector'],
            'entry_date' => $row['entrydate']->format('Y-m-d'), 
            'quantity' => $row['quantity'],
            'entry_price' => $row['entryprice'],
            'total_invest' => $row['amount'],
            'brokerage' => $row['brokerage'],
            'total_amount' => $row['totalamount']
        );
    }

    echo json_encode($data);
} else {
    echo "Error: Script parameter is not set";
}
?>