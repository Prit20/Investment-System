<?php
include('include/dbcon.php');

if(isset($_POST['query'])){
    $searchText = $_POST['query'];
    $sql = "SELECT name FROM scriptname WHERE name LIKE ?";
    $params = array('%'.$searchText.'%');
    $query = sqlsrv_query($con, $sql, $params);
    
    if($query === false) {
        echo 'Error executing query: ' . sqlsrv_errors();
        exit;
    }

    if(sqlsrv_has_rows($query)){
        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
            echo '<a class="dropdown-item" href="#">'.$row['name'].'</a>';
        }
    }
    else{
        echo '<a class="dropdown-item" href="#">No data found</a>';
}
}
?>
