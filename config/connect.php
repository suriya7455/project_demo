<?php
error_reporting(E_ALL ^ E_NOTICE); // ปิด warning php ตัวแปรที่ประกาศลอยๆ
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//Start Session
ob_start();
session_start();
// 1 For Localhost, 2 For Hosting
$variable = 1;
switch ($variable) {
    case 1:
        // Localhost
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', '');
        define('DB_NAME', 'db_project_guild');
        break;
    case 2:
        // Hosting
        define('LOCALHOST', 'localhost');
        define('DB_USERNAME', 'boukensh_guild2022');
        define('DB_PASSWORD', 'FI5wPy8Zwf');
        define('DB_NAME', 'boukensh_guild2022');
        break;
}

//boukenshaguildboard-th.com
// Database:	boukensh_guild2022
// Host:	localhost
// Username:	boukensh_guild2022
// Password:	FI5wPy8Zwf

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
mysqli_query($conn, 'set NAMES utf8');
mysqli_query($conn, 'SET character_set_results=utf8');
mysqli_query($conn, 'SET character_set_client=utf8');
mysqli_query($conn, 'SET character_set_connection=utf8');
date_default_timezone_set('Asia/Bangkok');
