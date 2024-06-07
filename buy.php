<?php
include('include/dbcon.php');
include('include/header.php');
?>
<style>
    .container-card {
        margin: auto;
        margin-top: 70px;
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
    .form-row input{
        border: 1px solid #ccc;
    }
</style>

<div class="container">
    <div class="container-card">
        <form action="bought_db.php" method="post">
        <div class="row form-row">
            <div class="col">
                <label for="scriptName">Script Name:</label>
                <input type="text" class="form-control" id="scriptName" name="scriptName" onkeyup="getSector()">
            </div>
            <div class="col">
                <label for="sector">Sector:</label>
                <input type="text" class="form-control" value="" id="sector" name="sector" readonly>
            </div>
            <div class="col">
                <label for="entryDate">Entry Date:</label>
                <input type="date" class="form-control" id="entryDate" name="entryDate">
            </div>
            <div class="col">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control" id="quantity" name="quantity" oninput="calculateAmount()">
            </div>
        </div>
        <div class="row form-row">
            <div class="col">
                <label for="entryPrice">Entry Price:</label>
                <input type="text" class="form-control" id="entryPrice" name="entryPrice" oninput="calculateAmount()">
            </div>
            <div class="col">
                <label for="amount">Amount:</label>
                <input type="text" class="form-control" id="amount" name="amount" oninput="calculateTotalAmount()" readonly >
            </div>
            <div class="col">
                <label for="brokerage">Brokerage (%):</label>
                <input type="number" class="form-control" id="brokerage" name="brokerage" oninput="calculateTotalBrokerage()">
            </div>
            <div class="col">
                <label for="totalBrokerage">Total Brokerage:</label>
                <input type="text" class="form-control" id="totalBrokerage" name="totalBrokerage" oninput="calculateTotalAmount()"  readonly >
            </div>
            <div class="col">
                <label for="totalAmount">Total Amount:</label>
                <input type="text" class="form-control" id="totalAmount" name="totalAmount" readonly>
            </div>
            
        </div>
        
        <div class="btn" style="margin: auto; width: 100%; margin-bottom:-26px;"> 
       
            <button type="submit" class="btn btn-success" name="buy" > Buy </button>
        </div>
        </form>
    </div>
</div>
<!-- Bought items table container -->
<div class="table-container">
            <h4>All Items for Entered Script Name</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Script Name</th>
                        <th>Sector</th>
                        <th>Entry Date</th>
                        <th>Quantity</th>
                        <th>Entry Price</th>
                        <th>Amount </th>
                        <th>Brokerage</th>
                        <th>TOtal Brokerage</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody id="scriptNameItemsTableBody">
                    <!-- Data related to entered script name will be displayed here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>

    // script for the sutomatically field sector name 
function getSector() {
    var scriptName = document.getElementById("scriptName").value;
    $.ajax({
        url: 'get_sector.php', // Change this URL to the script_name page or wherever the sector data is fetched
        type: 'POST',
        data: {
            scriptName: scriptName
        },
        success: function(data) {
            $('#sector').val(data);
        }
    });
}

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

// // script for the save data in databases on clik buy
// function buyItem() {
//     var scriptName = document.getElementById("scriptName").value;
//     var sector = document.getElementById("sector").value;
//     var entrydate = document.getElementById("entrydate").value;
//     var quantity = document.getElementById("quantity").value;
//     var entryPrice = document.getElementById("entryPrice").value;
//     var amount = document.getElementById("amount").value;
//     var brokerage = document.getElementById("brokerage").value;
//     var totalbrokerage = document.getElementById("totalbrokerage").value;
//     var totalamount = document.getElementById("totalamount").value;

//     $.ajax({
//         url: 'bought_db.php',
//         type: 'POST',
//         data: {
//             scriptName: scriptName,
//             sector:sector,
//             entrydate:entrydate,
//             quantity: quantity,
//             entryPrice: entryPrice,
//             amount: amount,
//             brokerage: brokerage,
//             totalbrokerage: totalbrokerage,
//             totalamount: totalamount
//         },
//         success: function(response) {
//             // Refresh bought items table for entered script name
//             getScriptNameItems(scriptName);
//         }
//     });
// }

// after store it show into table  according script name 

function getScriptNameItems(scriptName) {
    $.ajax({
        url: 'get_script_name_items.php',
        type: 'GET',
        data: {
            scriptName: scriptName
        },
        success: function(data) {
            $('#scriptNameItemsTableBody').html(data);
        }
    });
}

// Initial call to populate the bought items table for entered script name
var initialScriptName = document.getElementById("scriptName").value;
getScriptNameItems(initialScriptName);


</script>
<?php
include('include/footer.php');
?>