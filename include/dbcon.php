<?php 
// offic ip 
// $serverName = "192.168.13.155";   
// home ip 
$serverName = "192.168.0.137";
// mobile ip 
// $serverName = "192.168.127.115";
// meet mobile 
// $serverName = "192.168.88.115";


$connectionInfo = array("Database"=>"Investment","UID"=>"sa","PWD"=>"12345","CharacterSet" => "UTF-8");
$con = sqlsrv_connect($serverName,$connectionInfo);

if($con) {
		// echo "connection established.<br />";
		
}else{
	echo "connection could not be established.<br />";
	die(print_r(sqlsrv_errors(), true));
	
}
?>