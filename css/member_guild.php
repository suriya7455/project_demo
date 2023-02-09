<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) {
    $m_user_name = $_SESSION['guild_member'];
    $sql_id_member = "SELECT * FROM member WHERE member_username = '$m_user_name' ";
    $result_id_memeber = mysqli_query($conn, $sql_id_member);
    $rs_id_member = mysqli_fetch_assoc($result_id_memeber);
    $profiles_id = $rs_id_member['id'];
?>
    <!DOCTYPE html>
    <html lang="zxx">

    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Anime Template">
        <meta name="keywords" content="Anime, unica, creative, html">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Boukensha Guild | User Profile</title>

        <link rel="icon" type="image/png" href="img/ico/icon.png" />

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Css Styles -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
        <link rel="stylesheet" href="css/plyr.css" type="text/css">
        <link rel="stylesheet" href="css/nice-select.css" type="text/css">
        <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
        <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
        <link rel="stylesheet" href="css/style.css" type="text/css">

        <!-- fancybox -->
        <link href="guild_admin/plugins/fancybox/fancybox.css" rel="stylesheet" />

        <!-- dataTables -->
        <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <!-- summernote -->
        <link rel="stylesheet" href="guild_admin/plugins/summernote/summernote-bs4.min.css">

        <!-- font-awesome  -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Header Section Begin -->
        <?php require 'layout/top-menu.php'; ?>
        <!-- Header End -->

        <!-- Guild Quest Location Begin-->
        <section class="product spad" style="margin-bottom:0;padding-bottom:0; margin-bottom:4rem">
            <div class="container">
                <?php
                $file = 'member_' . $_GET['mn'] . '/' . $_GET['file'] . '.php';
                if (file_exists($file) && isset($_GET['mn']) && isset($_GET['file'])) {
                    // นำเข้าไฟล์จากตัวแปลที่รับด้านบน
                    require $file;
                } elseif (file_exists($file) or !$_GET['mn'] or !$_GET['file']) {
                    // หน้าเริ่มต้นเมือทำการ login เข้าสู่ระบบ
                    require 'member_quest/quest_dashboard.php';
                }
                ?>
            </div>
        </section>
        <!-- Guild Quest Location End-->

        <?php
        require 'layout/footer-menu.php';
        ?>

        <!-- Js Plugins -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/player.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Datatable -->
        <script src="guild_admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="guild_admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="guild_admin/plugins/datatables/data.th.js"></script>

        <!-- Summernote -->
        <script src="guild_admin/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- include summernote-th-TH -->
        <script src="guild_admin/plugins/summernote/lang/summernote-th-TH.min.js"></script>

        <!-- fancybox -->
        <script src="guild_admin/plugins/fancybox/fancybox.umd.js"></script>

        <!-- Sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="js/app.js"></script>
    </body>

    </html>
<?php
} else {
    header('Location:login.php');
}
?>