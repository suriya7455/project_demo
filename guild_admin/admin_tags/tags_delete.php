<?php
if (isset($_GET['delete_id'])) {
    $id_del_tags = $_GET['delete_id']; // รับค่า id และ select tags
    // ลบไอดี tags
    $sql_dl = " DELETE FROM tags WHERE id = $id_del_tags ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=tags&file=tags_list");
        exit;
    }
}
