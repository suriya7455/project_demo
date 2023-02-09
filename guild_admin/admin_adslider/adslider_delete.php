<?php
if (isset($_GET['delete_id'])) {
    $id_del_adslider = $_GET['delete_id']; // รับค่า id และ select adslider
    $sql_del_adslider = " SELECT * FROM adslider WHERE id = $id_del_adslider ";
    $result_del_adslider = mysqli_query($conn, $sql_del_adslider);
    $rs_delete_users = mysqli_fetch_assoc($result_del_adslider);
    $fileupload = $rs_delete_users['image_name']; // ไฟล์รูปภาพ
    if ($fileupload != "") {
        // ไฟล์รูปภาพ ไม่เท่ากับค่าว่าง ทำการลบตาม path
        unlink("../images/adslider/$fileupload");
    }
    // ลบไอดี adslider
    $sql_dl = " DELETE FROM adslider WHERE id = $id_del_adslider ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=adslider&file=adslider_list");
        exit;
    }
}
