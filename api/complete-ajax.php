<?php
require '../config/connect.php';
require '../config/function.php';
header('Content-Type: text/html; charset=utf-8');
$requestData = $_REQUEST;

$columns = array(
    0 => 'quest.id',
    1 => 'quest.quest_name',
    2 => 'quest.quest_category_id',
    3 => 'quest.quest_location',
    4 => 'quest.quest_created',
    5 => 'quest.quest_assignor',
    6 => 'quest.quest_reward',
    7 => 'quest.quest_status',
    8 => 'quest.quest_category_note',
    9 => 'quest.quest_location_address',
    10 => 'categories.categories_name',
);

$sql = " SELECT quest.id,quest.quest_name,quest.quest_category_id,quest.quest_location,quest.quest_created,quest.quest_assignor,quest.quest_reward,quest.quest_status,quest.quest_category_note,quest.quest_location_address,categories.categories_name  ";
$sql .= " FROM quest LEFT JOIN categories ON quest.quest_category_id = categories.id ";
$query = mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;

$sql = " SELECT quest.id,quest.quest_name,quest.quest_category_id,quest.quest_location,quest.quest_created,quest.quest_assignor,quest.quest_reward,quest.quest_status,quest.quest_category_note,quest.quest_location_address,categories.categories_name ";
$sql .= " FROM quest LEFT JOIN categories ON quest.quest_category_id = categories.id WHERE 1=1 AND quest.quest_status = 3 ";
if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
    $sql .= " AND ( quest.id LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_name LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_category_id LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_location LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_created LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_assignor LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_reward LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_category_note LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_location_address LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR categories.categories_name LIKE '%" . $requestData['search']['value'] . "%' ";
    $sql .= " OR quest.quest_status LIKE '%" . $requestData['search']['value'] . "%') ";
}
$query = mysqli_query($conn, $sql);
$totalFiltered = mysqli_num_rows($query);
if (!empty($columns[$requestData['order'][0]['column']])){
     $sql .= "ORDER BY quest.quest_created DESC";
}else{
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   "; 

}

$query = mysqli_query($conn, $sql);

$data = array();
while ($row = mysqli_fetch_array($query)) {  // preparing an array

    if ($row["categories_name"] != "") {
        $category_name = $row["categories_name"];
    } else {
        $category_name = "อื่นๆ " . $row['quest_category_note'];
    }

    if ($row['quest_location_address'] != "") {
        $location = $row['quest_location_address'];
    } else {
        $location =  $row['quest_location'];
    }
    $id_quest = $row['id'];
    $quest_name = $row["quest_name"];
    $link_quest = "<a class=\"text-dark\" href=\"quest-detail.php?id=$id_quest\">$quest_name</a>";

    $nestedData = array();
    $nestedData[] = $link_quest;
    $nestedData[] = $category_name;
    $nestedData[] = $location;
    $nestedData[] = DateTh($row["quest_created"]);
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
