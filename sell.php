<?php
 include('include/dbcon.php');
 include('include/header.php');
?>

<style>
.container-card {
    margin: auto;
    /* margin-top: 70px; */
    width: 90%;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.form-row {
    margin-bottom: 20px;
}

.form-row label {
    font-weight: bold;
}

.form-row input {
    border: 1px solid #ccc;
}
</style>

<?php
$id = $_GET['id'];
    $sql1 = "SELECT * FROM bought_items where id ='$id'";
    $run1= sqlsrv_query($con, $sql1);
    while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
    ?>

<div class="containermain" style="margin-top: 70px;">
    <div class="row ">
        <div class="col">

        </div>
        <div class="col-auto" style=" margin-right:70px; font-weight:bold; font-size:24px;">
            <?php
    $sql2 = "SELECT sum(quantity) as quantity FROM bought_items WHERE id = '".$row1['id']."'";
    $run2 = sqlsrv_query($con,$sql2);
    if($run2){
        $row2 = sqlsrv_fetch_array($run2, SQLSRV_FETCH_ASSOC);
        $totalquntity = $row2['quantity'];
        // Retrieve total quantity of sold items
        $sql_sold = "SELECT sum(sellquantity) as sold_quantity FROM sell WHERE sell_id = '".$row1['id']."'";
        $run_sold = sqlsrv_query($con, $sql_sold);
        $row_sold = sqlsrv_fetch_array($run_sold, SQLSRV_FETCH_ASSOC);
        $sold_quantity = $row_sold['sold_quantity'];
        
        // Calculate available quantity
        $available_quantity = $totalquntity - $sold_quantity;
    ?>
            <p>Total Quantity:<?php echo $totalquntity ?> </p>
            <p>Available Quantity:<?php echo $available_quantity ?> </p>
            <?php
    }else{
       echo "not found"; 
    }
    ?>
        </div>
    </div>

    <div class="container-card">
        <form action="sell_db.php" method="post">
            <div class="row form-row">
                <div class="col">
                    <input type="hidden" class="form-control"  name="iid"
                        value="<?php echo $row1['id'] ?>">
                    <label for="scriptName">Script Name:</label>
                    <input type="text" class="form-control" id="scriptName" name="scriptName"
                        value="<?php echo $row1['name'] ?>" readonly>
                </div>
                <div class="col">
                    <label for="sector">Sector:</label>
                    <input type="text" class="form-control" id="sector" name="sector"
                        value="<?php echo $row1['sector'] ?>" readonly>
                </div>
                <div class="col">
                    <label for="entryDate">Entry Date:</label>
                    <input type="date" class="form-control" id="entryDate" name="entryDate"
                        value="<?php echo $row1['entrydate']->format('Y-m-d') ?>">
                </div>
                <div class="col">
                    <label for="quantity">Quantity:</label>
                    <input type="number" class="form-control" max="<?php echo $available_quantity ?>" min="1" id="quantity" name="quantity"
                        value=" <?php echo $row1['quantity'] ?>" oninput="calculateAmount()"> 
                </div>
            </div>
            <div class="row form-row">
                <div class="col">
                    <label for="entryPrice">Entry Price:</label>
                    <input type="text" class="form-control" id="entryPrice" name="entryPrice"
                        value="<?php echo $row1['entryprice'] ?>" oninput="calculateAmount()">
                </div>
                <div class="col">
                    <label for="amount">Amount:</label>
                    <input type="text" class="form-control" id="amount" name="amount"
                        value="<?php echo $row1['amount'] ?>" oninput="calculateTotalAmount()" readonly>
                </div>
                <div class="col">
                    <label for="brokerage">Brokerage (%):</label>
                    <input type="number" class="form-control" id="brokerage" name="brokerage"
                        value="<?php echo $row1['brokerage'] ?>" oninput="calculateTotalBrokerage()">
                </div>
                <div class="col">
                    <label for="totalBrokerage">Total Brokerage:</label>
                    <input type="text" class="form-control" id="totalBrokerage" name="totalBrokerage"
                        value="<?php echo $row1['totalbrokerage'] ?>" oninput="calculateTotalAmount()" readonly>
                </div>
                <div class="col">
                    <label for="totalAmount">Total Amount:</label>
                    <input type="text" class="form-control" id="totalAmount" name="totalAmount"
                        value="<?php echo $row1['totalamount'] ?>" readonly>
                </div>

            </div>

            <div class="btn" style="margin: auto; width: 100%; margin-bottom:-26px;">

                <button type="submit" class="btn btn-danger" id="sell" name="sell"> sell </button>
            </div>
        </form>
    </div>
</div>

<!-- // chat  -->
<div class="container" style="margin-top: -170px;">
    <!-- <h3>Previously Sold Items for this Script Name:</h3> -->
    <table class="table">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Script Name</th>
                <th>Entry Date</th>
                <th>Quantity</th>
                <th>Entry Price</th>
                <th>Amount</th>
                <th>Total Brokerage</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $incr = 1;
    // Retrieve previously sold items for the same script name
    $sql_previous = "SELECT * FROM sell WHERE sell_id = '".$row1['id']."'";
    $run_previous = sqlsrv_query($con, $sql_previous);

    // Check if the query executed successfully
    if ($run_previous) {
        while ($row_previous = sqlsrv_fetch_array($run_previous, SQLSRV_FETCH_ASSOC)) {
            // Display previously sold items in table rows
            ?>
            <tr>
                <td><?php echo $incr++; ?></td>
                <td><?php echo $row_previous['name']; ?></td>
                <td><?php echo $row_previous['selldate']->format('Y-m-d'); ?></td>
                <td><?php echo $row_previous['sellquantity']; ?></td>
                <td><?php echo $row_previous['sellprice']; ?></td>
                <td><?php echo $row_previous['amount']; ?></td>
                <td><?php echo $row_previous['totalbrokerage']; ?></td>
                <td><?php echo $row_previous['totalamount']; ?></td>
            </tr>
            <?php
        }
    } else {
        // Handle the case where the query fails
        echo "Error fetching previously sold items.";
    }

?>

        </tbody>
    </table>
</div>
<?php
    }
?>
<script>
// script for the amount = q * EP 
function calculateAmount() {
    var quantity = document.getElementById("quantity").value;   
    var entryPrice = document.getElementById("entryPrice").value;
    var amount = quantity * entryPrice;
    document.getElementById("amount").value = amount;
    calculateTotalAmount();
}
// script for total brokerage = a * bp /100 
function calculateTotalBrokerage() {
    var brokeragePercentage = document.getElementById("brokerage").value;
    var amount = document.getElementById("amount").value;
    var totalBrokerage = (amount * brokeragePercentage) / 100;
    document.getElementById("totalBrokerage").value = totalBrokerage.toFixed(2);
    calculateTotalAmount();
}
// script for the total amount = tottal brok + amount 
function calculateTotalAmount() {
    var amount = parseFloat(document.getElementById("amount").value);
    var totalBrokerage = parseFloat(document.getElementById("totalBrokerage").value);
    var totalAmount = amount + totalBrokerage;
    document.getElementById("totalAmount").value = totalAmount.toFixed(2);
}

$(document).ready(function() {
    // Event handler for quantity change
    $(document).on('change', '#quantity', function() {
        var enteredQuantity = $(this).val(); // Get the entered quantity
        var availableQuantity = <?php echo $available_quantity; ?>; // Get the available quantity from PHP
        // Check if entered quantity is greater than available quantity
        if (enteredQuantity > availableQuantity) {
            // If yes, display an alert
            alert("Quantity must be less than or equal to available quantity.");
            // Reset the quantity input field to available quantity
            $(this).val(availableQuantity);
        }
    });

});
</script>