<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'contact_fullname',
        2 => 'contact_email',
        3 => 'contact_subject',
        4 => 'contact_created'
    );

    $sql = " SELECT id, contact_fullname, contact_email, contact_subject, contact_created ";
    $sql .= " FROM  contact ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, contact_fullname, contact_email, contact_subject, contact_created ";
    $sql .= " FROM contact WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR contact_fullname LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR contact_email LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR contact_subject LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR contact_created LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_contact = $row['id'];
        $contact_subject_contact = $row["contact_subject"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["contact_subject"];
        $nestedData[] = $row["contact_email"];
        $nestedData[] = str_time_diff($row["contact_created"]);
        $nestedData[] = "
        <a href=\"index.php?mn=contact&file=contact_detail&view_id=$id_contact\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$contact_subject_contact','index.php?mn=contact&file=contact_delete&delete_id=$id_contact')\"><i class=\"fas fa-trash-alt\"></i></button>
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
