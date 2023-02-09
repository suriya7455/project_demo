<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'member_email',
        2 => 'member_username',
        3 => 'member_status',
        4 => 'member_created',
    );

    $sql = " SELECT id, member_email, member_username, member_status, member_created ";
    $sql .= " FROM  member ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, member_email, member_username, member_status, member_created ";
    $sql .= " FROM member WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR member_email LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR member_username LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR member_status LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR member_created LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_member = $row['id'];
        $member_names = $row["member_username"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["member_email"];
        $nestedData[] = $row["member_username"];
        $nestedData[] = $row["member_status"];
        $nestedData[] = DateNormal($row["member_created"]);
        $nestedData[] = "
        <a href=\"index.php?mn=member&file=member_detail&view_id=$id_member\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=member&file=member_edit&edit_id=$id_member\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$member_names','index.php?mn=member&file=member_delete&delete_id=$id_member')\"><i class=\"fas fa-trash-alt\"></i></button>
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
