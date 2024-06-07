<?php
include('include/dbcon.php');


if(isset($_POST['id'])){
$sql ="SELECT * FROM bought_items where id = '".$_POST['id']."'";
$run= sqlsrv_query($con,$sql);
$row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
?>
<div class="mb-3">
    <input type="hidden" name="id" class="form-control" value=" <?php echo $row['id']?>">
    <label class="form-label w-100 mb-2">Script Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['name'] ?>'">
</div>

<div class="mb-3">
    <label class="form-label">Sector</label>
    <input type="text" name="sector" class="form-control" value="<?php echo $row['sector']?>">
</div>
<div class="mb-3">
    <label class="form-label">Entry Date</label>
    <input type="date" name="entrydate" class="form-control" value="<?php echo $row['entrydate']->format('Y-m-d')?>">

</div>

<div class="mb-3">
    <label class="form-label">Quantity</label>
    <input type="float" name="quantity" class="form-control qnty" value="<?php echo $row['quantity']?>">

</div>
<div class="mb-3">
    <label class="form-label">Entry Price </label>
    <input type="float" name="entryprice" class="form-control price" value="<?php echo $row['entryprice']?>" readonly>

</div>
<div class="mb-3">
    <label class="form-label">Amount </label>
    <input type="float" name="amount" class="form-control amt" value="<?php echo $row['amount']?>" readonly>

</div>
<div class="mb-3">
    <label class="form-label">Brokerage  </label>
    <input type="float" name="brokerage" class="form-control brkrg" value="<?php echo $row['brokerage']?>">

</div>
<div class="mb-3">
    <label class="form-label">Total Brokerage </label>
    <input type="float" name="totalbrokerage" class="form-control final_brkg" value="<?php echo $row['totalbrokerage']?> " readonly>

</div>
<div class="mb-3">
    <label class="form-label">Total Amount</label>
    <input type="float" name="totalamount" class="form-control final_amt" value="<?php echo $row['totalamount']?>" readonly>

</div>

<?php
}
?>
<script>
        $(document).on('input', '.qnty, .price, .brkrg', function() {
        var q = $('.qnty').val();
        var p = $('.price').val();
        var brk = $('.brkrg').val();

        var total = q * p;
        $('.amt').val(total.toFixed(2));
        var total_brkg = total * (brk / 100);
            $('.final_brkg').val(total_brkg.toFixed(2));
            var total_amt = total + total_brkg;
            $('.final_amt').val(total_amt.toFixed(2));
    });

</script>
