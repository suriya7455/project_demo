<?php
$view_id = $_GET['view_id'];
$sql = "SELECT * FROM adslider WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $rs['adslider_title'] ?></h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="text-center"><?= $rs['adslider_title'] ?></h5>
                    <div class="text-center"><a href="<?= $rs['adslider_link'] ?>" target="_blank"><?= $rs['adslider_link'] ?></a></div>
                    <p><?= nl2br($rs['adslider_detail']) ?></p>
                </div>
                <div class="col-md-12">
                    <img src="../images/adslider/<?= $rs['adslider_image'] ?>" class="card-img-top img-fluid" alt="<?= $rs['adslider_title'] ?>">
                </div>
            </div>
        </div>
    </div>
</div>