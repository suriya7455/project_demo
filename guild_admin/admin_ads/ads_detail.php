<?php
$view_id = $_GET['view_id'];
$sql = "SELECT * FROM ads WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $rs['ads_title'] ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-10">
                    <h5 class="text-center"><?= $rs['ads_title'] ?></h5>
                    <div class="text-center"><a href="<?= $rs['ads_link'] ?>" target="_blank"><?= $rs['ads_link'] ?></a></div>
                    <p><?= nl2br($rs['ads_detail']) ?></p>
                </div>
                <div class="col-md-2">
                    <img src="../images/ads/<?= $rs['ads_image'] ?>" class="card-img-top img-fluid" alt="<?= $rs['ads_title'] ?>">
                </div>
            </div>
        </div>
    </div>
</div>