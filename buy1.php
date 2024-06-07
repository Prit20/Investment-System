<?php
include('include/header.php');
include('include/dbcon.php');
?>
<style>
    .form-group label{
        font-weight: bold;
    }
</style>
<div class="container16" style="margin-top:12vh; width:98%; margin-left:auto; margin-right:auto;">
    <div class="row">
        <div class="card">
            <div class="card-body ">
                <form action="buy_db.php" method="post">
                    <div class="row">
                    <div class="col-md mb-3 position-relative">
                            <div class="form-group">
                            <label for="entryDate">Sector Name:</label>

                            <input type="text" class="form-control" id="searchInput" name="share_name" placeholder="Search Script" autocomplete="off">
                            <div id="searchResults" class="dropdown-menu position-absolute" style="width: 100%;" aria-labelledby="searchInput"></div>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                            <label for="entryDate">Sector:</label>

                                <input type="text" class="form-control" id="sector_name" name="share_sector" placeholder="Sector" readonly >
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="entryDate">Entry Date:</label>

                                <input type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>"
                                    name="buy_date" placeholder="Entry Date" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>

                                <input type="text" class="form-control qnty" name="share_quantity"
                                    placeholder="Quantity" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="entryPrice">Entry Price:</label>

                                <input type="text" step="0.01" class="form-control price" name="Entry_price"
                                    placeholder="Entry Price" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="amount">Amount:</label>

                                <input type="text" step="0.01" class="form-control amt" name="amount"
                                    placeholder="Amount" readonly>
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="brokerage">Brokerage (%):</label>

                                <input type="text" step="0.01" class="form-control brkrg" name="brokerage"
                                    placeholder="Brokerage" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md mb-3">
                            <div class="form-group">
                                <label for="totalBrokerage">Total Brokerage:</label>

                                <input type="text" step="0.01" class="form-control final_brkg" name="total_brokerage"
                                    placeholder="Total Brokerage" readonly>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <label for="totalAmount">Total Amount:</label>

                                <input type="text" step="0.01" class="form-control final_amt" name="total_amt"
                                    placeholder="Total Amount" readonly>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-group">
                                <input type="hidden" step="0.01" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn btn-success" name="buy_share"
                                style="width:15%; margin-left:auto; margin-right:auto;">Buy</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="previous_buy_data" style="margin-top:5vh; display: none;" >

        <table class="table table-border" id="scriptTable1">
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Script Name</th>
                    <th>Sector</th>
                    <th>Entry Date</th>
                    <th>Quantity</th>
                    <th>Entry Price</th>
                    <th>Amount</th>
                    <th>Brokrage</th>
                    <th>Total Amount</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>

    </div>
</div>


<?php
include('include/footer.php');
?>



<script>
// new DataTable('#scriptTable1', {
//     // dom: 'Bfrtip',
//     // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
// });
$(document).ready(function() {
    $('#searchInput').keyup(function() {
        var searchText = $(this).val();
        if (searchText != '') {
            $.ajax({
                url: 'fetch_script_names.php',
                method: 'post',
                data: {
                    query: searchText
                },
                success: function(response) {
                    $('#searchResults').html(response);
                    $('#searchResults').show();
                }
            });
        } else {
            $('#searchResults').html('');
            $('#searchResults').hide();
        }
    });

    $(document).on('click', 'a.dropdown-item', function() {
        var selectedScript = $(this).text();
        $('#searchInput').val($(this).text());
        $('#searchResults').html('');
        $('#searchResults').hide();
        $('#searchInput').trigger('change');



        $.ajax({
            url: 'fetch_previous_data.php',
            method: 'post',
            data: {
                script: selectedScript
            },
            success: function(response) {
                // Parse the response and populate the table with previous data
                var data = JSON.parse(response);
                $('#scriptTable1 tbody').empty(); // Clear existing rows

                if (data.length > 0) {
                    $.each(data, function(Srno, item) {
                        $('#scriptTable1 tbody').append('<tr>' +
                            '<td>' + (Srno + 1) + '</td>' +
                            '<td>' + item.script_name + '</td>' +
                            '<td>' + item.sector + '</td>' +
                            '<td>' + item.entry_date + '</td>' +
                            '<td>' + item.quantity + '</td>' +
                            '<td>' + item.entry_price + '</td>' +
                            '<td>' + item.total_invest + '</td>' +
                            '<td>' + item.brokerage + '</td>' +
                            '<td>' + item.total_amount + '</td>' +
                            '</tr>');
                    });
                } else {
                    $('#scriptTable1 tbody').append(
                        '<tr><td colspan="9">No data found</td></tr>');
                }
            }
        });
    });
    $(document).on('change', '#searchInput', function() {
    var script = $(this).val();
    if (script.trim() !== '') {
        $('.previous_buy_data').show(); // Show the table heading
    } else {
        $('.previous_buy_data').hide(); // Hide the table heading if input field is empty
    }
    $.ajax({
            url:'buy_db.php',
            type:'POST',
            dataType:'json',
            data:{script:script},
            success:function(data){
                console.log(data);
                $('#sector_name').val(data[0]);
            }
        });
    })

    $(document).on('input', '.qnty, .price', function() {
        var q = $('.qnty').val();
        var p = $('.price').val();

        var total = q * p;
        $('.amt').val(total.toFixed(2));
    });

    $(document).on('input', '.brkrg', function() {
        var amount = parseFloat($('.amt').val());
        var brk = parseFloat($('.brkrg').val());

        if (!isNaN(amount) && !isNaN(brk)) {
            var total_brkg = amount * (brk / 100);
            $('.final_brkg').val(total_brkg.toFixed(2));
            var total_amt = amount + total_brkg;
            $('.final_amt').val(total_amt.toFixed(2));
        } else {
            $('.final_brkg').val('');
        }
    });




});
</script>