<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';

if (isset($_GET['verify'])) {
    $keyswords = '44tXsyL54I0D80zJZ9CIAab2WV1qov1E';
    $code_verify = $_GET['verify'];
    $codes_v = decodedy($code_verify, $keyswords);
    $sql_verify_pass = "SELECT * FROM member WHERE member_email = '$codes_v' ";
    $result_verify_pass = mysqli_query($conn, $sql_verify_pass);
    $num_verify_pass = mysqli_num_rows($result_verify_pass);
    if ($num_verify_pass == 0) {
        header('Location:index.php');
        exit;
    }
}
if (isset($_POST['recure_key'])) {
    $code_verify = $_POST['recure_key'];
    $u_pass = $_POST['u_pass'];
    $new_pass = md5($u_pass);
    $u_pass_confirm = md5($_POST['u_pass_confirm']);
    $codes_v = decodedy($code_verify, $keyswords);
    if ($new_pass == $u_pass_confirm) {
        $sql_new_p = " UPDATE member SET 
    member_password = '$new_pass'
    WHERE member_email = '$codes_v' ";
        $result_new_p = mysqli_query($conn, $sql_new_p);
        if ($result_new_p) {
            header("refresh:3;url=login.php?action=renew");
            $msg = "<div class=\"alert alert-success\">กู้คืนรหัสผ่านสำเร็จกรุณาเข้าสู่ระบบด้วยรหัสใหม่</div>";
        }
    } else {
        $msg = "<div class=\"alert alert-danger\">กรุณากรอกรหัสผ่าน และยืนยันรหัสผ่านให้ตรงกัน</div>";
    }
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
    <title>Boukensha Guild | forget password</title>

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
                        <h2>ลืมรหัสผ่าน</h2>
                        <p>ยินดีต้อนรับสู่ Boukensha Guild</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Login Section Begin -->
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <?php if (isset($msg)) {
                            echo $msg;
                        }
                        ?>
                        <h3>กู้คืนรหัสผ่าน</h3>
                        <form action="" method="POST">
                            <div id="message"></div>
                            <div class="input__item">
                                <input type="password" name="u_pass" id="password" placeholder="รหัสผ่านใหม่">
                                <span class="icon_lock"></span>
                            </div>
                            <div class="input__item">
                                <input type="password" name="u_pass_confirm" id="confirm_password" placeholder="ยืนยันรหัสผ่าน">
                                <span class="icon_lock"></span>
                            </div>
                            <input type="hidden" name="recure_key" value="<?= $_GET['verify'] ?>">
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                            <button type="submit" name="submit" id="btn_submit" class="site-btn" disabled>รีเซ็ทรหัสผ่าน</button>
                        </form>
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

        $('#password, #confirm_password').on('keyup', function() {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('รหัสผ่านตรงกัน').addClass('alert alert-success mb-1');
                $('#message').removeClass('alert-danger');
                document.getElementById('btn_submit').disabled = false;
            } else {
                $('#message').html('รหัสผ่านไม่ตรงกัน').addClass('alert alert-danger mb-1');
                $('#message').removeClass('alert-success');
            }
        });
    </script>

</body>

</html>