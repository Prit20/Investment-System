<?php
include('include/dbcon.php');

if(isset($_POST['id'])){

    $sql = "SELECT * FROM fundtype WHERE id=  '".$_POST['id']."'";
    $run= sqlsrv_query($con,$sql);
    $row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
?>
    <div class="mb-3">
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <label class="form-label">Fund Name</label>
    <input type="text" name="fundname" class="form-control" value="<?php echo $row['fundname']?>">

</div>
<?php
}
?>