<?php
if (isset($_GET['delete_id'])) {
    $id_del_member = $_GET['delete_id']; // รับค่า id และ select member
    // ลบไอดี member
    $sql_dl = " DELETE FROM member WHERE id = $id_del_member ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=member&file=member_list");
        exit;
    }
}
