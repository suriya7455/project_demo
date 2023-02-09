<?php
ob_start();
session_start();
if ($_SESSION['user_admin'] != "" && $_SESSION['status_login'] === true) {

    include('../../config/connect.php');
    include('../../config/function.php');

    $requestData = $_REQUEST;

    $columns = array(
        0 => 'id',
        1 => 'blog_type_name',
        2 => 'blog_type_date'
    );

    $sql = " SELECT id, blog_type_name, blog_type_date ";
    $sql .= " FROM  blog_type ";
    $query = mysqli_query($conn, $sql);
    $totalData = mysqli_num_rows($query);
    $totalFiltered = $totalData;

    $sql = " SELECT id, blog_type_name, blog_type_date ";
    $sql .= " FROM blog_type WHERE 1=1 ";
    if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
        $sql .= " AND ( id LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR blog_type_name LIKE '%" . $requestData['search']['value'] . "%' ";
        $sql .= " OR blog_type_date LIKE '%" . $requestData['search']['value'] . "%') ";
    }
    $query = mysqli_query($conn, $sql);
    $totalFiltered = mysqli_num_rows($query);
    $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . "   " . $requestData['order'][0]['dir'] . "  LIMIT " . $requestData['start'] . " ," . $requestData['length'] . "   ";
    $query = mysqli_query($conn, $sql);

    $data = array();
    while ($row = mysqli_fetch_array($query)) {  // preparing an array
        $id_blog_type = $row['id'];
        $blog_type_names = $row["blog_type_name"];
        $nestedData = array();
        $nestedData[] = $row["id"];
        $nestedData[] = $row["blog_type_name"];
        $nestedData[] = DateNormal($row["blog_type_date"]);
        $nestedData[] = "
        <a href=\"index.php?mn=blog_type&file=blog_type_detail&view_id=$id_blog_type\" class=\"btn btn-info mb-1\"><i class=\"fas fa-binoculars\"></i></a>
        <a href=\"index.php?mn=blog_type&file=blog_type_edit&edit_id=$id_blog_type\" class=\"btn btn-warning mb-1\"><i class=\"fas fa-edit\"></i></a>
        <button class=\"btn btn-danger mb-1\" onclick=\"cdelte('$blog_type_names','index.php?mn=blog_type&file=blog_type_delete&delete_id=$id_blog_type')\"><i class=\"fas fa-trash-alt\"></i></button>
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
