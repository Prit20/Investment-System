<?php
include('include/dbcon.php');

if(isset($_POST['script'])){
    $script_name=$_POST['script'];
    $sql="SELECT b.name,b.entrydate,b.entryprice,b.quantity,s.sell_id,s.sellprice,s.sellquantity,s.selldate from bought_items as b join sell as s 
    on b.id = s.sell_id
    WHERE b.name='$script_name'";
    $query=sqlsrv_query($con,$sql);

    $data=array();
    if($query){
        // Check if there are rows returned
        if(sqlsrv_has_rows($query)){
            while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
                $data[] = array(
                    'script_name' => $row['name'],
                    'entry_date'=>$row['entrydate']->format('Y-d-m'),
                    'entry_price' => $row['entryprice'],
                    'buy_quantity' => $row['quantity'],
                    'sell_id' => $row['sell_id'],
                    'sell_price' => $row['sellprice'],
                    'sell_quantity' => $row['sellquantity'],
                    'sellAt' => $row['selldate']->format('Y-d-m'),
                );
            }
        }
    } else {
        // Handle query execution error
        die( print_r( sqlsrv_errors(), true));
    }
}

echo json_encode($data);
?>
 