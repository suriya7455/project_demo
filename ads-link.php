<?php
require 'config/connect.php';
if (isset($_GET['b_id'])) {
    $banner_id = $_GET['b_id'];
    $sql_count = " UPDATE banner SET banner_count = banner_count+1 
    WHERE id = '$banner_id'";
    mysqli_query($conn, $sql_count);
    $sql_link = "SELECT * FROM banner WHERE id = '$banner_id' ";
    $result_link = mysqli_query($conn, $sql_link);
    $rs_link = mysqli_fetch_assoc($result_link);
    $links = $rs_link['banner_link'];
    echo "<meta http-equiv='refresh' content='0;url=$links'>";
}
