<?php $view_id = $_GET['view_id'];
$sql = "SELECT * FROM tags WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดป้ายกำกับ</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><strong>ป้ายกำกับ <?= $rs['tags_name'] ?></strong></li>
                <li class="list-group-item"><strong><i class="far fa-calendar-alt"></i> <?= DateNormal($rs['tags_date']) ?></strong></li>
            </ul>
        </div>
    </div>
</div>