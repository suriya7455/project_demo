<?php
if (isset($_GET['delete_id'])) {
    $id_del_blog_type = $_GET['delete_id']; // รับค่า id และ select blog_type
    // ลบไอดี blog_type
    $sql_dl = " DELETE FROM blog_type WHERE id = $id_del_blog_type ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=blog_type&file=blog_type_list");
        exit;
    }
}
