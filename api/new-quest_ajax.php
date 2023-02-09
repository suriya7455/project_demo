<?php
require '../config/connect.php';
require '../config/function.php';
header('Content-Type: text/html; charset=utf-8');
$requestData = $_REQUEST;

$columns = array(
    0 => 'id',
    1 => 'quest_name',
    2 => 'quest_category_id',
    3 => 'quest_location',
    4 => 'quest_created',
    5 => 'quest_assignor',
    6 => 'quest_reward',
    7 => 'quest_status'
);

$sql = " SELECT id,quest_name,quest_category_id,quest_location,quest_created,quest_assignor,quest_reward,quest_status ";
$sql .= " FROM quest ";
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = " SELECT id,quest_name,quest_category_id,quest_location,quest_created,quest_assignor,quest_reward,quest_status ";
$sql .= " FROM quest WHERE 1=1 ";
if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_name LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_category_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_location LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_created LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_assignor LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_reward LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest_status LIKE '%" . $requestData['search']['value'] . "%') ";
}
$query = mysqli_query($conn, $sql);
$totalFiltered = mysqli_num_rows($query);
$sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
$query = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array
    $nestedData = array();
    $nestedData[] = $row["id"];
    $nestedData[] = $row["quest_name"];
    $nestedData[] = $row["quest_category_id"];
    $nestedData[] = $row["quest_location"];
    $nestedData[] = $row["quest_created"];
    $nestedData[] = $row["quest_assignor"];
    $nestedData[] = $row["quest_reward"];
    $nestedData[] = quest_sta($row["quest_status"]);
    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($requestData['draw']),
    "recordsTotal" => intval($totalData),  // total number of records
    "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format
