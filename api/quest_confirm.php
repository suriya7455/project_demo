<?php
require '../config/connect.php';
header('Content-Type: text/html; charset=utf-8');
if (isset($_REQUEST['id']) && isset($_REQUEST['p'])) {
    $q_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
    $q_pass = mysqli_real_escape_string($conn, $_REQUEST['p']);
    $sql_p = " SELECT * FROM quest_activity_detail WHERE quest_id = '$q_id' AND guest_password = '$q_pass' ";
    $result_p = mysqli_query($conn, $sql_p);
    $num_row_p = mysqli_num_rows($result_p);
    if ($num_row_p > 0) {
        $sql_update = " UPDATE quest SET quest_status = '3' WHERE id = $q_id ";
        mysqli_query($conn, $sql_update);
        $value = array(
            "message" => "ส่งมอบภารกิจสำเร็จ"
        );
        $json  = json_encode($value);
        echo $json;
    } else {
        $value = array(
            "message" => "รหัสยืนยันไม่ถูกต้อง"
        );
        $json  = json_encode($value);
        echo $json;
    }
} else {
    $value = array(
        "message" => "Access Denied"
    );
    $json  = json_encode($value);
    echo $json;
}
