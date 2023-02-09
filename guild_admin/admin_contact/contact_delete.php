<?php
if (isset($_GET['delete_id'])) {
    $id_del_contact = $_GET['delete_id']; // รับค่า id และ select contact
    // ลบไอดี contact
    $sql_dl = " DELETE FROM contact WHERE id = $id_del_contact ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=contact&file=contact_list");
        exit;
    }
}
