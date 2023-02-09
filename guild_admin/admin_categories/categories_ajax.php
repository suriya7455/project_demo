<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'categories_status',
        2 => 'categories_name',
        3 => 'categories_create'
    );

    $sql = " SELECT id, categories_status, categories_name, categories_create ";
    $sql .= " FROM  categories ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, categories_status, categories_name, categories_create ";
    $sql .= " FROM categories WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR categories_status LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR categories_name LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR categories_create LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_categories = $row['id'];
        $categories_names = $row["categories_name"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["categories_status"];
        $nestedData[] = $row["categories_name"];
        $nestedData[] = DateNormal($row["categories_create"]);
        $nestedData[] = "
        <a href=\"index.php?mn=categories&file=categories_detail&view_id=$id_categories\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=categories&file=categories_edit&edit_id=$id_categories\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$categories_names','index.php?mn=categories&file=categories_delete&delete_id=$id_categories')\"><i class=\"fas fa-trash-alt\"></i></button>
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
