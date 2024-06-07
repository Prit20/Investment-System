<?php
include('include/dbcon.php');
include('include/header.php');
?>

<style>
.table-bordered th,
.table-bordered td {
    text-align: center;
    /* Center-align all text */
}
</style>
<div class="buysell" >
    <div class="containerfund" style="margin-top: 80px;">
        <div class="row ">
            <div class="col">

            </div>
            <div class="col-auto">
                <!-- style="margin-right: 130px;" -->
                <a href="buy1.php" class="btn btn-primary mb-2 ">Buy</a>
            </div>
        </div>

    </div>
    <table class="table table-striped" id="buysellTable">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Script Name</th>
                <th>Sector</th>
                <th>Entry Date </th>
                <th>Quantity </th>
                <th>Entry Price </th>
                <th>Amount</th>
                <th>Brokerage</th>
                <th>Total Brokerage</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
$incr = 1;
$sql1= "SELECT * FROM bought_items";
$run1= sqlsrv_query($con,$sql1);
    
    while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
        ?>
            <tr>
                <td><?php echo $incr++; ?></td>
                <td><?php echo $row1['name']?></td>
                <td><?php echo $row1['sector']?></td>
                <td><?php echo $row1['entrydate']->format('d-M-Y');?></td>
                <td><?php echo $row1['quantity']?></td>
                <td><?php echo number_format($row1['entryprice'], 2)?></td>
                <td><?php echo number_format($row1['amount'], 2)?></td>
                <td><?php echo $row1['brokerage']?></td>
                <td><?php echo  number_format($row1['totalbrokerage'], 2)?></td>
                <td><?php echo  number_format($row1['totalamount'], 2)?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm editbtn"
                        id=" <?php echo $row1['id']?>">Edit </button>
                    <a href="sell.php?id=<?php echo $row1['id'] ?> " type="button" class="btn btn-danger btn-sm ml-2 sellbtn">Sell</a>
                </td>

            </tr>
        </tbody>
        <?php
            }
            ?>
    </table>
</div>
</div>

<?php
include('include/footer.php');
?>
 <!--Edit Modal -->
 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="UpdateForm" enctype="multipart/form-data">

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="update" class="btn btn-primary" id="update">Save changes</button>
                </div>
            </div>
        </div>
    </div>

<script>
    $('#buysell').addClass('active');
    $(document).on('click', '.editbtn', function() {
    var id = $(this).attr('id');
    $.ajax({
        url: 'buysell_edit.php',
        type: 'POST',
        data: {id: id},
        success: function(data) {
            $('#UpdateForm').html(data);
            $('#editModal').modal('show');
        }
    });

});

$(document).on('click', '#update', function() {// Get form data including files

    $.ajax({
        url: 'buysell_db.php',
        type: 'POST',
        data: $("#UpdateForm").serialize(),
        success: function(data) {
            // alert(data);
            console.log(data);
            location.reload();
        }
    });
});
</script>