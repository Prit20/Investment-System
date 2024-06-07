<?php
include('include/dbcon.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- style link -->
    <link rel="stylesheet" href="style.css">

    <!-- js link  -->
    <script src="script.js"></script>

    <!-- bootstrep cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- bootstrep icon cdn link  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- dashboard cnd  -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>


    <!-- datatables  -->
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">



</head>

<body>
<body id="body-pd">
        <header class="header" id="header">
            <div class="header_toggle"> <i class='bi bi-list' id="header-toggle"></i> </div>
            <!-- <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div> -->
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div> <a class="nav_logo"> <i class='bi bi-bank nav_logo-icon'></i> <span
                            class="nav_logo-name">Investment</span> </a>
                    <div class="nav_list">
                       
                        <a href="dashboard.php" id="dashboard" class="nav_link">
                            <i class='bi bi-grid nav_icon'></i>
                            <span span class="nav_name">Dashboard </span>
                        </a>
                        <a href="buysell.php" id="buysell" class="nav_link">
                            <i class='bi bi-bag nav_icon'></i>
                            <span span class="nav_name">Buy/Sell
                        <a href="fundtype.php" id="fundtype" class="nav_link">
                            <i class='bi bi-cash nav_icon'></i>
                            <span class="nav_name">Fund Type </span>
                        </a>
                        <a href="script_name.php" id="scriptname" class="nav_link">
                            <i class='bi bi-file-text nav_icon'></i>
                            <span class="nav_name">Script Name</span>
                        </a>
                        
                        
                    </div>
                </div> 
            
<div >           
                <a href="logout.php" class="nav_link"> <i class='bi bi-box-arrow-left nav_icon'></i> <span
                        class="nav_name">SignOut</span> </a> </div>
     
            </nav>
        </div>
        <!--Container Main start-->