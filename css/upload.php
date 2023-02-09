<?php
if ($_FILES['file']['name']) {
    if (!$_FILES['file']['error']) {
        $name = md5(rand(100, 200));
        $ext = explode('.', $_FILES['file']['name']);
        $filename = $name . '.' . $ext[1];
        $destination = 'images/upload/' . $filename; //change this directory
        $location = $_FILES["file"]["tmp_name"];
        move_uploaded_file($location, $destination);
        // echo 'http://localhost/Project_fastwork/project_anime/images/upload/' . $filename; //change this URL
        // echo 'https://boukensha.kumawork.com/images/upload/' . $filename; //change this URL
        echo 'https://www.boukenshaguildboard-th.com/images/upload/' . $filename; //change this URL
    } else {
        echo  $message = 'Ooops!  Your upload triggered the following error:  ' . $_FILES['file']['error'];
    }
}
