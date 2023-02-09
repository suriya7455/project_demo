<?php
if (isset($_GET['delete_id'])) {
    $id_del_author = $_GET['delete_id']; // รับค่า id และ select author
    // ลบไอดี author
    $sql_dl = " DELETE FROM author WHERE id = $id_del_author ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=author&file=author_list");
        exit;
    }
}
