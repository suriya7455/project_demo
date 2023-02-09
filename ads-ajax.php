<?php
session_start();
require 'config/connect.php';
$b_id1 = $_SESSION['sess_ran_id'][0];
$b_id2 = $_SESSION['sess_ran_id'][1];
$b_id3 = $_SESSION['sess_ran_id'][2];
$b_id4 = $_SESSION['sess_ran_id'][3];
$b_id5 = $_SESSION['sess_ran_id'][4];
$sql_banner1 = " SELECT * FROM banner WHERE banner_status = 'เปิด' AND id <> '$b_id1' AND id <> '$b_id2' AND id <> '$b_id3' AND id <> '$b_id4' AND id <> '$b_id5' ORDER BY RAND () LIMIT 15 ";
$result_banner1 = mysqli_query($conn, $sql_banner1);
while ($rs_banner1 = mysqli_fetch_assoc($result_banner1)) {
    $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                                    WHERE id = " . $rs_banner1['id'];
    mysqli_query($conn, $sql_view);
?>
    <div class="col-md-12">
        <a href="ads-link.php?b_id=<?= $rs_banner1['id'] ?>" target="_blank"><img src="images/banner/<?= $rs_banner1['banner_image'] ?>" class="img-fluid rounded mt-1 mb-1" alt="<?= $rs_banner1['banner_title'] ?>"></a>
    </div>
<?php } ?>