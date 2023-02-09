<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) {
    header('Location:member_guild.php');
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boukensha Guild | Login</title>

    <link rel="icon" type="image/png" href="img/ico/icon.png" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
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

    <!-- Normal Breadcrumb Begin -->
    <section class="normal-breadcrumb set-bg" data-setbg="img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>เข้าสู่ระบบ</h2>
                        <p>ยินดีต้อนรับสู่ Boukensha Guild</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <?php
    if (isset($_POST['submit'])) {

        $username = mysqli_real_escape_string($conn, $_POST['username']); // Protect SQL Injection ป้องกัน sql Injection 
        $password = mysqli_real_escape_string($conn, md5($_POST['password'])); // Protect SQL Injection ป้องกัน sql Injection

        $sql = " SELECT * FROM member WHERE member_username = '$username' AND member_password = '$password' ";

        $res = mysqli_query($conn, $sql);
        $rs = mysqli_fetch_assoc($res);

        $count = mysqli_num_rows($res);

        if ($count == 1) {
            $msg = "<div class='alert alert-success'>Login Successful.</div>";
            $_SESSION['guild_member'] = $rs['member_username'];
            $_SESSION['guild_id'] = $rs['id'];  //To check whether the user is logged in or not and logout will unset it
            $_SESSION['guild_member_login'] = true; // To
            header("refresh:1;url=member_guild.php");
            $msg = "<div class='alert alert-success'><i class=\"far fa-check-circle\"></i> เข้าสู่ระบบสำเร็จ <br><i class=\"fas fa-hourglass-half\"></i> โปรดรอสักครู่</div>";
        } else {
            $msg = "<div class='alert alert-danger'><i class=\"fas fa-exclamation-circle\"></i> ชื่อผู้ใช้ หรือ รหัสผ่าน <br>ไม่ถูกต้องโปรดตรวจสอบใหม่</div>";
        }
    }

    if (isset($_GET['action']) == 'renew') {
        $msg = "<div class='alert alert-success'><i class=\"far fa-check-circle\"></i> กรุณา Login ด้วยรหัสที่เปลี่ยนใหม่ </div>";
    }
    ?>
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <?php
                        if ($msg != "") {
                            echo $msg;
                        }
                        ?>
                        <h3>เข้าสู่ระบบ</h3>
                        <form action="" method="POST">
                            <div class="input__item">
                                <input type="text" placeholder="ชื่อผู้ใช้" name="username">
                                <span class="fas fa-user"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" placeholder="รหัสผ่าน" name="password">
                                <span class="icon_lock"></span>
                            </div>
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                            <button type="submit" id="btn_submit" name="submit" class="site-btn" disabled>เข้าสู่ระบบ</button>
                        </form>
                        <a href="forget.php" class="forget_pass">ลืมรหัสผ่าน?</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>ยังไม่มีบัญชีผู้ใช้?</h3>
                        <a href="signup.php" class="primary-btn">ลงทะเบียน</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section End -->

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

    <script src="//www.google.com/recaptcha/api.js?render=6LdwtpgUAAAAAHVJ3JlKJNiTEIzyUm53NNj32QXv"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdwtpgUAAAAAHVJ3JlKJNiTEIzyUm53NNj32QXv', {
                action: 'login'
            }).then(function(token) {
                // ค่า token ที่ถูกส่งกลับมา จะถูกนำไปใช้ส่งไปตรวจสอบกับ api อีกครั้ง
                // เราเอาค่า token ไปไว้ใน input hidden ชื่อg-recaptcha-response
                document.getElementById('g-recaptcha-response').value = token;
                makeaction(); // ทำฟังก์ชั่นเพิ่มเติม ถ้ามี
            });
        });

        function makeaction() {
            document.getElementById('btn_submit').disabled = false;
        }
    </script>


</body>

</html>