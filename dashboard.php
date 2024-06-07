<?php
include('include/header.php');
// include('include/session.php');
?>
<div class="div" style="margin-top:15vh;">

    <div class="row">
        <div class="col">
<p style="font-size: 35px; font-weight:bold;">Report</p>
        </div>
        <div class="col-auto mb-3 position-relative">
            <div class="form-group">
                <h4 for="" style="margin-right:18px;">Script Name </h4>

                <input type="text" style="border:1px solid black;" class="form-control" id="searchInput"
                    name="share_name" autocomplete="off">
                <div id="searchResults" class="dropdown-menu position-absolute" style="width: 100%;"
                    aria-labelledby="searchInput"></div>
            </div>
        </div>

    </div>
    <table class="table table-striped" id="scriptTable1">
        <thead>
            <tr>
                <th style="color:green;">Sr.No</th>
                <th style="color:green;">Script </th>
                <th style="color:green;">Entry Date </th>
                <th style="color:green;">Entry Price</th>
                <th style="color:green;">Buy Quantity</th>
                <th style="color:red;">Sell Date</th>
                <th style="color:red;">Sell Price</th>
                <th style="color:red;">Sell Quantity</th>
                <th style="color:blue;">Profit/Loss</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php
include('include/footer.php');
?>
<script>
    $('#dashboard').addClass('active');
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
        $('#searchInput').val(selectedScript);
        $('#searchResults').html('');
        $('#searchResults').hide();
        $('#searchInput').trigger('change');
        $.ajax({
            url: 'profit_loss.php',
            method: 'post',
            data: {
                script: selectedScript
            },
            success: function(response) {
                var data = JSON.parse(response);
                $('#scriptTable1 tbody').empty();
                $('#scriptTable1').show();

                if (data.length > 0) {
                    var currentSoldId = null;

                    $.each(data, function(index, item) {
                        var buy_price = item.entry_price;
                        var buy_qunty = item.buy_quantity;
                        var script_name = item.script_name;
                        var entry_date = item.entry_date;
                        var sell_id= item.sell_id;

                        if (sell_id !== currentSoldId || index === 0) {
                            $('#scriptTable1 tbody').append('<tr>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + script_name + '</td>' +
                                '<td>' + entry_date + '</td>' +
                                '<td>' + buy_price + '</td>' +
                                '<td>' + buy_qunty + '</td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '<td></td>' +
                                '</tr>');
                        }

                        var sell_price = item.sell_price;
                        var sell_qunty = item.sell_quantity;
                        var sell_prc = (sell_price * sell_qunty) - (buy_price *
                            sell_qunty);

                        $('#scriptTable1 tbody').append('<tr>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td></td>' +
                            '<td>' + item.sellAt + '</td>' +
                            '<td>' + sell_price + '</td>' +
                            '<td>' + sell_qunty + '</td>' +
                            '<td>' + sell_prc + '</td>' +
                            '</tr>');

                        currentSoldId = sell_id;
                    });
                } else {
                    $('#scriptTable1 tbody').append(
                        '<tr><td colspan="9">No data found</td></tr>');
                }
            }
        });
    });
});
</script>