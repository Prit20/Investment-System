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
<div class="fundtype" style="margin: 10px 30px 10px 30px;">
    <div class="containerfund" style="margin-top: 80px;">
        <div class="row ">
            <div class="col">

            </div>
            <div class="col-auto">
                <!-- style="margin-right: 130px;" -->
                <button type="button" class="btn btn-primary mb-2 " data-bs-toggle="modal"
                    data-bs-target="#addModal">+Add</button>
            </div>
        </div>

    </div>
    <table class="table table-striped" id="scriptTable">
        <thead>
            <tr>
                <th>Sr</th>
                <th>Name</th>
                <th>Fund Type</th>
                <th> Sector </th>
                <th> Sub Sector </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
$incr = 1;
$sql1= "SELECT * FROM scriptname";
$run1= sqlsrv_query($con,$sql1);
    
    while($row1 = sqlsrv_fetch_array($run1, SQLSRV_FETCH_ASSOC)){
        ?>
            <tr>
                <td><?php echo $incr++; ?></td>
                <td><?php echo $row1['name']?></td>
                <td><?php echo $row1['fundtype']?></td>
                <td><?php echo $row1['sector']?></td>
                <td><?php echo $row1['subsector']?></td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm editbtn"
                        id=" <?php echo $row1['id']?>">Edit</button>
                    <button type="button" class="btn btn-danger btn-sm ml-2 deletebtn"
                        id="<?php echo $row1['id'] ?>">Delete</button>
                </td>

            </tr>
        </tbody>
        <?php
            }
            ?>
    </table>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="script_name_db.php" method="post" id="saveForm" enctype="multipart/form-data">

                    <label class="form-label w-100 mb-2">Name
                        <input type="text" name="name" class="form-control">
                    </label>
                    <label class="form-label w-100 mb-2">Fund Type
                        <div class="mb-3">
                            <select class="form-select " name="fundtype">
                                <option value="" disabled selected hidden></option>
                                <?php
                            $sql = "SELECT * FROM fundtype";
                            $query = sqlsrv_query($con, $sql);
                            if ($query) {
                                while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                                    ?>
                                <option value="<?= $row['fundname'] ?>"><?= $row['fundname'] ?></option>
                                <?php
                                }
                            }
                            ?>
                            </select>
                        
                        </div>
                    </label>
                    <label class="form-label w-100 mb-2">Sector
                        <input type="text" name="sector" class="form-control">
                    </label>
                    <label class="form-label w-100 mb-2">Sub Sector
                        <input type="text" name="subsector" class="form-control">
                    </label>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="save" form="saveForm">Save</button>
            </div>
        </div>
    </div>
</div>
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
$('#scriptname').addClass('active');

// new DataTable('#scriptTable', {
//     // dom: 'Bfrtip',
//     // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
// });

$(document).on('click', '.editbtn', function() {
    var id = $(this).attr('id');
    $.ajax({
        url: 'script_name_edit.php',
        type: 'POST',
        data: {
            id: id
        },
        success: function(data) {
            $('#UpdateForm').html(data);
            $('#editModal').modal('show');
        }
    });

});

$(document).on('click', '#update', function() {
    // var formData = new FormData($('#UpdateForm')[0]); // Get form data including files

    $.ajax({
        url: 'script_name_db.php',
        type: 'POST',
        data: $('#UpdateForm').serialize(), 
        success: function(data) {
            // alert(data);
            location.reload();
        }
    });
});

$(document).on('click','.deletebtn', function(){
    var id = $(this).attr("id");

    $.ajax({
        url:'script_name_db.php',
        type: 'POST',
        data: {id:id},
        success:function(data){
            alert("Delete Successfully");
            location.reload();
        }
    })
})
</script>