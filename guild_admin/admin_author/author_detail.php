<?php $view_id = $_GET['view_id'];
$sql = "SELECT * FROM author WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดผู้แต่ง</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item">
                    <strong>ผู้แต่ง <?= $rs['author_name'] ?></strong>
                </li>
            </ul>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item">
                    <i class="bi bi-alarm"></i> เมื่อ <?= $rs['author_create'] ?>
                </li>
            </ul>
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item">
                    <i class="bi bi-alarm"></i> อัปเดตล่าสุด <?= $rs['author_updated'] ?>
                </li>
            </ul>
        </div>
    </div>
</div>