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
    $name = $_POST['name'];
    $fundtype = $_POST['fundtype'];
    $sector = $_POST['sector'];
    $subsector = $_POST['subsector'];

    $sql="INSERT INTO scriptname (name,fundtype,sector,subsector,createdBy,createdAt) VALUES ('$name','$fundtype','$sector','$subsector','$user','$curDate')";
    $run= sqlsrv_query($con,$sql);
    if($run){
       ?>
        <script>
        alert('Added Successfully');
        window.location = "script_name.php";
        </script>
        <?php
    }else{
        echo"error".sqlsrv_errors();
    }
}


// for edit 

if(isset($_POST['iiid'])){
    $id = $_POST['iiid'];
    $name = $_POST['name'];
    $fundtype = $_POST['fundtype'];
    $sector = $_POST['sector'];
    $subsector = $_POST['subsector'];


    $sql1 = " UPDATE scriptname SET name = '$name', fundtype='$fundtype', sector = '$sector', subsector= '$subsector', updatedBy = '$user', updatedAt = '$curDate' WHERE id = '$id'";

    $run1 = sqlsrv_query($con,$sql1);

    if($run1){
        ?> 
    <script>
        // alert('Updated Successfully');
        window.location = "script_name.php";
    </script>
    <?php

    }else{
        echo"error".sqlsrv_errors();

    }
}


// delete btn 
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sql2 = " DELETE FROM scriptname WHERE id = '$id'";
    $query2 = sqlsrv_query($con,$sql2);

    if($query2){
        echo"done";
    }else{
        echo"error".sqlsrv_errors();
    }
}
?>