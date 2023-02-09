<?php
if (isset($_GET['delete_id'])) {
    $id_del_banner = $_GET['delete_id']; // รับค่า id และ select banner
    $sql_del_banner = " SELECT * FROM banner WHERE id = $id_del_banner ";
    $result_del_banner = mysqli_query($conn, $sql_del_banner);
    $rs_delete_users = mysqli_fetch_assoc($result_del_banner);
    $fileupload = $rs_delete_users['banner_image']; // ไฟล์รูปภาพ
    if ($fileupload != "") {
        // ไฟล์รูปภาพ ไม่เท่ากับค่าว่าง ทำการลบตาม path
        unlink("../images/banner/$fileupload");
    }
    // ลบไอดี banner
    $sql_dl = " DELETE FROM banner WHERE id = $id_del_banner ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=banner&file=banner_list");
        exit;
    }
}
