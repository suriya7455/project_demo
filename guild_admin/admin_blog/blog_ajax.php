<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'bg.id',
        1 => 'bg.blog_title',
        2 => 'bt.blog_type_name',
        3 => 'bg.blog_status',
        4 => 'bg.blog_created'
    );

    $sql = " SELECT bg.id,bg.blog_title,bt.blog_type_name,bg.blog_status,bg.blog_created ";
    $sql .= " FROM blog bg INNER JOIN blog_type bt ON bg.blog_type_id = bt.id ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT bg.id,bg.blog_title,bt.blog_type_name,bg.blog_status,bg.blog_created ";
    $sql .= " FROM blog bg INNER JOIN blog_type bt ON bg.blog_type_id = bt.id WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( bg.id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR bg.blog_title LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR bt.blog_type_name LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR bg.blog_status LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR bg.blog_created LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_blog_ids = $row['id'];
        $blog_titles = $row["blog_title"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["blog_title"];
        $nestedData[] = $row["blog_type_name"];
        $nestedData[] = status_show($row["blog_status"]);
        $nestedData[] = DateNormal($row["blog_created"]);
        $nestedData[] = "
        <a href=\"index.php?mn=blog&file=blog_detail&view_id=$id_blog_ids\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=blog&file=blog_edit&edit_id=$id_blog_ids\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$blog_titles','index.php?mn=blog&file=blog_delete&delete_id=$id_blog_ids')\"><i class=\"fas fa-trash-alt\"></i></button>
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
