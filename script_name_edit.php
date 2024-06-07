<?php
include('include/dbcon.php');

if(isset($_POST['id'])){

    $sql = "SELECT * FROM scriptname WHERE id=  '".$_POST['id']."'";
    $run= sqlsrv_query($con,$sql);
    $row = sqlsrv_fetch_array($run, SQLSRV_FETCH_ASSOC);
?>
<div class="mb-3">
    <input type="hidden" name="iiid" value="<?php echo $row['id']?>">
    <label class="form-label">Fund Name</label>
    <input type="text" name="name" class="form-control" value="<?php echo $row['name']?>">
</div>
<div class="mb-3">
    <select class="form-select " name="fundtype">
        <option value="" disabled selected hidden></option>
        <?php
            $sql2 = "SELECT * FROM fundtype";
            $query2 = sqlsrv_query($con, $sql2);
            if ($query2) {
                while ($row2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)) {
                    ?>
        <option value="<?= $row2['fundname'] ?>"><?= $row2['fundname'] ?></option>
        <?php
            }
        }
        ?>
    </select>

</div>
<div class="mb-3">
    <label class="form-label">Sector</label>
    <input type="text" name="sector" class="form-control" value="<?php echo $row['sector']?>">
</div>
<div class="mb-3">
    <label class="form-label">Sub Sector</label>
    <input type="text" name="subsector" class="form-control" value="<?php echo $row['subsector']?>">
</div>
<?php
}
?>