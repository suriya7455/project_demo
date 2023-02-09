<?php $view_id = $_GET['view_id'];
$sql = "SELECT * FROM blog_type WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดประเภทบทความ</h3>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush text-left">
                <li class="list-group-item"><strong>ประเภทบทความ <?= $rs['blog_type_name'] ?></strong></li>
                <li class="list-group-item"><strong><i class="far fa-calendar-alt"></i> <?= DateNormal($rs['blog_type_date']) ?></strong></li>
            </ul>
        </div>
    </div>
</div>