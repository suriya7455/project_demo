<?php
if (isset($_GET['delete_id'])) {
    $id_del_ads = $_GET['delete_id']; // รับค่า id และ select ads
    $sql_del_ads = " SELECT * FROM ads WHERE id = $id_del_ads ";
    $result_del_ads = mysqli_query($conn, $sql_del_ads);
    $rs_delete_users = mysqli_fetch_assoc($result_del_ads);
    $fileupload = $rs_delete_users['ads_image']; // ไฟล์รูปภาพ
    if ($fileupload != "") {
        // ไฟล์รูปภาพ ไม่เท่ากับค่าว่าง ทำการลบตาม path
        unlink("../images/ads/$fileupload");
    }
    // ลบไอดี ads
    $sql_dl = " DELETE FROM ads WHERE id = $id_del_ads ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=ads&file=ads_list");
        exit;
    }
}
