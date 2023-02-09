<?php
$view_id = $_GET['view_id'];
$sql = "SELECT * FROM banner WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $rs['banner_title'] ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mx-auto mb-2">
                    <img src="../images/banner/<?= $rs['banner_image'] ?>" class="card-img-top img-fluid" alt="<?= $rs['banner_title'] ?>">
                </div>
                <div class="col-md-12">
                    <h5 class="text-center"><?= $rs['banner_title'] ?></h5>
                    <div class="text-center"><a href="<?= $rs['banner_link'] ?>" target="_blank"><i class="fas fa-link"></i> <?= $rs['banner_link'] ?></a></div>
                </div>
                <div class="col-md-12">
                    <div class="text-center"><i class="fas fa-chart-bar"></i> <?= number_format($rs['banner_num']) ?></div>
                </div>
                <div class="col-md-12">
                    <div class="text-center"><i class="fas fa-mouse"></i> <?= number_format($rs['banner_count']) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>