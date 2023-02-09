<?php
if (isset($_GET['delete_id'])) {
    $id_del_hall_right = $_GET['delete_id']; // รับค่า id และ select hall_right
    // ลบไอดี hall_right
    $sql_dl = " DELETE FROM hall_right WHERE id = $id_del_hall_right ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=hall_right&file=hall_right_list");
        exit;
    }
}
