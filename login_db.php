<?php
include('include/dbcon.php');
session_start();
if(isset($_POST['login'])){

    $userid = $_POST['userid'];
    $password =  $_POST['password'];

    $sql= " SELECT * FROM user_data  WHERE userid='$userid' and password = '$password'";
    $query=sqlsrv_query($con, $sql, array(), array("Scrollable"=> 'static'));
    $count= sqlsrv_num_rows($query);
    if($count > 0){
        
        $_SESSION['userid'] = $userid; 
        // After successful login
$_SESSION['new_user_login'] = true; // Set flag indicating a new user has logged in

        header("location:dashboard.php");
        exit;
    }else{
        echo "error1";
        print_r(sqlsrv_errors());
    }
}else{
    echo "error2";
        print_r(sqlsrv_errors());
}
?>