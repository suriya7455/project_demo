<?php
if (isset($_GET['delete_id'])) {

    $id_del_blog = $_GET['delete_id']; // รับค่า id และ select blog

    $sql_del_blog = " SELECT * FROM blog WHERE id = $id_del_blog ";
    $result_del_blog = mysqli_query($conn, $sql_del_blog);
    $rs_del_blog = mysqli_fetch_assoc($result_del_blog);
    $id_blogs = $rs_del_blog['id'];

    $sql_del_img = " SELECT * FROM images_blog WHERE id = $id_blogs ";
    $result_del_img = mysqli_query($conn, $sql_del_img);
    $num_del_img = mysqli_num_rows($result_del_img);
    if ($num_del_img > 0) {
        $rs_del_img = mysqli_fetch_assoc($result_del_img);
        $fileupload = $rs_del_img['imagesupload']; // ไฟล์รูปภาพ
        if ($fileupload != "") {
            // ไฟล์รูปภาพ ไม่เท่ากับค่าว่าง ทำการลบตาม path
            unlink("../images/blog/$fileupload");
        }
    }

    // ลบ images 
    $sql_dl_im = " DELETE FROM images_blog WHERE ref_blog = $id_del_blog ";
    $result_dl_im = mysqli_query($conn, $sql_dl_im);

    // ลบ tags
    $sql_dl_tg = " DELETE FROM tags_detail WHERE blog_id = $id_del_blog ";
    $result_dl_tg = mysqli_query($conn, $sql_tg);

    // ลบไอดี blog
    $sql_dl = " DELETE FROM blog WHERE id = $id_del_blog ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=blog&file=blog_list");
        exit;
    }
}
