<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
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
    <title>Boukensha Guild | Template</title>

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
                        <h2>ลงทะเบียน</h2>
                        <p>ลงทะเบียน Boukensha Guild</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Signup Section Begin -->
    <section class="signup spad">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <?php
                    if (isset($_POST['submit'])) {

                        $member_email = mysqli_real_escape_string($conn, $_POST['u_email']);
                        $member_username = mysqli_real_escape_string($conn, $_POST['u_name']);
                        $member_password = md5(mysqli_real_escape_string($conn, $_POST['u_password']));

                        $sql_member1 = " SELECT * FROM member WHERE member_username = '$member_username' ";
                        $result_member1 = mysqli_query($conn, $sql_member1);
                        $num_member1 = mysqli_num_rows($result_member1);
                        if ($num_member1 > 0) {
                            $msg = "<div class=\"alert alert-danger text-center\">ชื่อผู้ใช้นี้ถูกใช้แล้ว</div>";
                        }

                        $sql_member2 = " SELECT * FROM member WHERE member_email = '$member_email' ";
                        $result_member2 = mysqli_query($conn, $sql_member2);
                        $num_member2 = mysqli_num_rows($result_member2);
                        if ($num_member2 > 0) {
                            $msg = "<div class=\"alert alert-danger text-center\">อีเมลนี้ถูกใช้แล้ว</div>";
                        }

                        if ($num_member1 == 0 && $num_member2 == 0) {
                            $sql_regis = " INSERT INTO member SET 
                                                                id = NULL,
                                                                member_email = '$member_email',
                                                                member_username = '$member_username',
                                                                member_password = '$member_password',
                                                                member_status = 1,
                                                                member_created = CURRENT_TIMESTAMP,
                                                                member_updated = CURRENT_TIMESTAMP ";
                            $result_regis = mysqli_query($conn, $sql_regis);
                            if ($result_regis) {
                                $_POST['u_email'] = "";
                                $_POST['u_name'] = "";
                                $_POST['u_password'] = "";
                                $msg = "<div class=\"alert alert-success text-center\">ลงทะเบียนสำเร็จ กรุณาเข้าสู่ระบบ</div>";
                            } else {
                                $msg = "<div class=\"alert alert-danger text-center\">ไม่สามารถลงทะเบียนได้</div>";
                            }
                        }
                    }
                    ?>
                    <div class="login__form">
                        <h3>ลงทะเบียน</h3>
                        <?php
                        if (!empty($msg)) {
                            echo $msg;
                        }
                        ?>
                        <form action="" method="POST">
                            <div class="input__item">
                                <input type="text" name="u_email" value="<?= $_POST['u_email'] ?>" placeholder="อีเมล" required>
                                <span class="icon_mail"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" name="u_name" value="<?= $_POST['u_name'] ?>" placeholder="ชื่อผู้ใช้" required>
                                <span class="icon_profile"></span>
                            </div>
                            <div class="input__item">
                                <input type="text" name="u_password" value="<?= $_POST['u_password'] ?>" placeholder="รหัสผ่าน" required>
                                <span class="icon_lock"></span>
                            </div>
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                            <button type="submit" id="btn_submit" name="submit" class="site-btn" disabled>ลงทะเบียน</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="login__register">
                        <h3>มีบัญชีอยู่แล้ว?</h3>
                        <a href="login.php" class="primary-btn">เข้าสู่ระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Signup Section End -->

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