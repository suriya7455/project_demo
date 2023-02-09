<?php
require 'config/connect.php';
$sql_banner_slider = " SELECT * FROM banner WHERE banner_status = 'เปิด' ORDER BY rand() LIMIT 0,5 ";
$result_banner_slider = mysqli_query($conn, $sql_banner_slider);
while ($rs_banner_slider = mysqli_fetch_assoc($result_banner_slider)) {
    $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                    WHERE id = " . $rs_banner_slider['id'];
    mysqli_query($conn, $sql_view);
?>
    <div class="hero__items set-bg" data-setbg="images/banner/<?= $rs_banner_slider['banner_image'] ?>">
        <div class="row">
            <div class="col-lg-6">
                <div class="hero__text">
                    <h2>&nbsp;</h2>
                    <p>&nbsp;</p>
                    <a href="banner.php"><span>ดูเพิ่มเติม</span> <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>