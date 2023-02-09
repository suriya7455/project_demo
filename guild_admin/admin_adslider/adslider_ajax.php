<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'adslider_title',
    );

    $sql = " SELECT id, adslider_title, adslider_image, adslider_status";
    $sql .= " FROM adslider ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, adslider_title, adslider_image, adslider_status";
    $sql .= " FROM adslider WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR adslider_title LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_adslider = $row['id'];
        $adslider_title = $row["adslider_title"];
        $images_c = $row["adslider_image"];
        // $images_cate = "<a href=''><img src='../images/adslider/$images_c' width='50px' height='50px' class='rounded' alt='$adslider_title'></a>";
        $images_cate = "<a href=\"javascript:;\" class=\"mailbox-attachment-name\" data-fancybox=\"single\" data-src=\"../images/adslider/$images_c\" data-caption=\"รูปภาพแบนเนอร์\"><i class=\"fas fa-image\"></i> รูปภาพ</a>";
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $images_cate;
        $nestedData[] = $row["adslider_title"];
        $nestedData[] = $row["adslider_status"];
        $nestedData[] = "
        <a href=\"index.php?mn=adslider&file=adslider_detail&view_id=$id_adslider\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=adslider&file=adslider_edit&edit_id=$id_adslider\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$adslider_title','index.php?mn=adslider&file=adslider_delete&delete_id=$id_adslider')\"><i class=\"fas fa-trash-alt\"></i></button>
 ";
        $data[] = $nestedData;
    }

    $json_data = array(
        "draw" => intval($requestData['draw']),
        "recordsTotal" => intval($totalData),  // total number of records
        "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
        "data"            => $data   // total data array
    );

    echo json_encode($json_data);  // send data as json format
}
