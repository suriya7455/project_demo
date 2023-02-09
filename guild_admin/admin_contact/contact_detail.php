<?php
if (isset($_GET['view_id'])) {
    $id_view = $_GET['view_id'];
    $sql_view = " SELECT * FROM contact WHERE id = $id_view ";
    $result_view = mysqli_query($conn, $sql_view);
    $rs_view = mysqli_fetch_assoc($result_view);
}
?>
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">รายละเอียดการติดต่อ</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <div class="mailbox-read-info">
            <h5><?= $rs_view['contact_subject'] ?></h5>
            <h6>จาก: <?= $rs_view['contact_email'] ?>
                <span class="mailbox-read-time float-right"><?= DateThaiFull($rs_view['contact_created']) ?></span>
            </h6>
        </div>
        <!-- /.mailbox-controls -->
        <div class="mailbox-read-message">
            <p>
                <?= nl2br($rs_view['contact_message']) ?>
            </p>
        </div>
        <!-- /.mailbox-read-message -->
    </div>
</div>