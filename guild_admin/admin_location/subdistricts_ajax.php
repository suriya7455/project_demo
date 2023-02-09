<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'code',
        2 => 'name_in_thai',
        3 => 'name_in_english',
        4 => 'latitude',
        5 => 'longitude',
        6 => 'zip_code',
    );

    $sql = " SELECT id, code, name_in_thai, name_in_english,latitude,longitude,zip_code ";
    $sql .= " FROM  subdistricts ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, code, name_in_thai, name_in_english,latitude,longitude,zip_code ";
    $sql .= " FROM subdistricts WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR code LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR name_in_thai LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR name_in_english LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR latitude LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR longitude LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR zip_code LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["code"];
        $nestedData[] = $row["name_in_thai"];
        $nestedData[] = $row["name_in_english"];
        $nestedData[] = $row["latitude"];
        $nestedData[] = $row["longitude"];
        $nestedData[] = $row["zip_code"];
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
