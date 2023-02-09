<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'quest_name',
        2 => 'quest_status',
        3 => 'quest_created'
    );

    $sql = " SELECT id,quest_name,quest_status,quest_created ";
    $sql .= " FROM quest ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id,quest_name,quest_status,quest_created ";
    $sql .= " FROM quest WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR quest_name LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR quest_status LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR quest_created LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id = $row['id'];
        $quest_status = $row["quest_status"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = questname($row["quest_name"]);
        $nestedData[] = $row["quest_status"];
        $nestedData[] = DateNormal($row["quest_created"]);
        $nestedData[] = "
        <a href=\"index.php?mn=quest&file=quest_detail&view_id=$id\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=quest&file=quest_edit&edit_id=$id\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$quest_status','index.php?mn=quest&file=quest_delete&delete_id=$id')\"><i class=\"fas fa-trash-alt\"></i></button>
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
