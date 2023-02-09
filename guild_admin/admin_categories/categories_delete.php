<?php
if (isset($_GET['delete_id'])) {
    $id_del_categories = $_GET['delete_id']; // รับค่า id และ select categories
    // ลบไอดี categories
    $sql_dl = " DELETE FROM categories WHERE id = $id_del_categories ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=categories&file=categories_list");
        exit;
    }
}
