<?php
if (isset($_GET['delete_id'])) {
    $id_del_pages = $_GET['delete_id']; // รับค่า id และ select pages
    // ลบไอดี pages
    $sql_dl = " DELETE FROM pages WHERE id = $id_del_pages ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=About&file=pages_list");
        exit;
    }
}
