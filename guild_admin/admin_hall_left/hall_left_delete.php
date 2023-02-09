<?php
if (isset($_GET['delete_id'])) {
    $id_del_hall_left = $_GET['delete_id']; // รับค่า id และ select hall_left
    // ลบไอดี hall_left
    $sql_dl = " DELETE FROM hall_left WHERE id = $id_del_hall_left ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=hall_left&file=hall_left_list");
        exit;
    }
}
