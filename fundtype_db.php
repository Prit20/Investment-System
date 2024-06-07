<?php
include('include/dbcon.php');
session_start();
// Check if user is logged in
if(!isset($_SESSION['userid'])) {
    // Redirect to login page or handle the case where user is not logged in
    header("location: login.php"); // Assuming login.php is your login page
    exit();
}
$user = $_SESSION['userid'];
$curDate= date("Y-m-d h:i:s");

if(isset($_POST['save'])){
    $fundname = $_POST['fundname'];

    $sql="INSERT INTO fundtype (fundname,createdBy,createdAt) VALUES ('$fundname','$user','$curDate')";
    $run= sqlsrv_query($con,$sql);
    if($run){
       ?>
        <script>
        alert('Added Successfully');
        window.location = "fundtype.php";
        </script>
        <?php
    }else{
        echo"error".sqlsrv_errors();
    }
}


if(isset($_POST['id'])){
    $id = $_POST['id'];
    $fundname = $_POST['fundname'];

    $sql1 = " UPDATE fundtype SET fundname = '$fundname' WHERE id = '$id'";
    $run1 = sqlsrv_query($con,$sql1);

    if($run1){
        echo "Updated Successfully";
    }else{
        echo "Error ".selsrv_errors();
    }
}

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql2 = " DELETE FROM fundtype WHERE id = '$id'";
    $query2 = sqlsrv_query($con, $sql2);

    if($query2){
        echo"Done";
    }else{
        echo"error".selsrv_errors();
    }
}
?>