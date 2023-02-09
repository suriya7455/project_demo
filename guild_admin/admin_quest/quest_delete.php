<?php
if (isset($_GET['delete_id'])) {

    $id_del_quest = $_GET['delete_id'];

    $sql_dl = " DELETE FROM quest WHERE id = $id_del_quest ";
    $result_dl = mysqli_query($conn, $sql_dl);

    if ($result_dl) {
        header("Location: index.php?mn=quest&file=quest_list");
        exit;
    }
}
