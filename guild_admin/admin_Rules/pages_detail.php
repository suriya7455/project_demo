<?php
$id_view = $_GET['view_id'];
$sql_edit = " SELECT * FROM pages WHERE id = '$id_view' ";
$result_edit = mysqli_query($conn, $sql_edit);
$rs_edit = mysqli_fetch_assoc($result_edit);
?>
<div class="card">
    <div class="card-header h5">
        รายละเอียดหน้า
    </div>
    <div class="card-body text-light" style="background-color: rgb(11, 12, 42);">
        <?= $rs_edit['pages_content'] ?>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>