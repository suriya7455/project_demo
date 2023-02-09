<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Include required PHPMailer files
require 'phpmail/includes/PHPMailer.php';
require 'phpmail/includes/SMTP.php';
require 'phpmail/includes/Exception.php';

?>
<?php
if (isset($_POST['submit'])) {
    // key secure generator
    $keyswords = '44tXsyL54I0D80zJZ9CIAab2WV1qov1E';
    $u_email = mysqli_real_escape_string($conn, $_POST['recov_email']);
    $sql_mail = " SELECT * FROM member WHERE member_email = '$u_email' ";
    $result_mail = mysqli_query($conn, $sql_mail);
    $rs_mail = mysqli_fetch_assoc($result_mail);
    $get_mails = $rs_mail['member_email'];
    $num_mail = mysqli_num_rows($result_mail);

    // Portmail 
    $sql_setting_mail = " SELECT * FROM setting ";
    $result_setting_mail = mysqli_query($conn, $sql_setting_mail);
    $rs_setting_mail = mysqli_fetch_assoc($result_setting_mail);


    $my_host = $rs_setting_mail['email_host_name'];
    $my_username_email = $rs_setting_mail['email_username'];
    $my_pass = $rs_setting_mail['email_password'];
    $my_port = $rs_setting_mail['email_port_name'];

    $my_from = 'info@boukenshaguildboard-th.com';

    //$hosting_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/Project_fastwork/project_anime";
    $hosting_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

    if ($num_mail > 0) {
        $mail_hash = encodedy($u_email, $keyswords);
        $subj = "กู้คืนรหัสผ่าน boukenshaguildboard-th.com เพื่อเข้าสูระบบ";
        $message = "กู้คืนรหัสผ่านเพื่อเข่าสู่ระบบ Boukensha Guild <br>
        คุณเพิ่งกู้คืนรหัสผ่านกับเรา <br>
        กรุณา <a href=\"$hosting_link/recover-password.php?verify=$mail_hash\">คลิกที่นี่</a> เพื่อยืนยันอีเมลของคุณ ขอบคุณ! <br>
        หากคุณไม่ได้ทำการเปลี่ยนแปลงนี้ บุคคลอื่นสามารถเข้าถึงบัญชีของคุณได้ <br>
        ติดต่อฝ่ายสนับสนุนที่ info@boukenshaguildboard-th.com";
        //Create instance of PHPMailer
        $mail = new PHPMailer(true);
        //Set mailer to use smtp
        $mail->CharSet = "utf-8";
        $mail->SMTPDebug = 0;
        $mail->isSMTP();

        //Define smtp host
        $mail->Host = $my_host;
        //Enable smtp authentication
        $mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
        $mail->SMTPSecure = "tls";
        //Port to connect smtp
        $mail->Port = $my_port;

        // authen smtp
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );

        //Set gmail username
        $mail->Username = $my_username_email;
        //Set gmail password
        $mail->Password = $my_pass;
        //Email subject
        $mail->Subject = $subj;
        //Set sender email
        $mail->From = $my_from;
        $mail->FromName = "boukenshaguildboard-th.com";
        //Enable HTML
        $mail->isHTML(true);
        //Attachment
        //Email body
        $mail->Body = $message;
        //Add recipient
        $names = $get_mails;
        $mail->addAddress($u_email, $u_email);
        //Finally send email
        if ($mail->send()) {
            $msg = "<div class=\"alert alert-success text-center\"><i class=\"far fa-check-circle\"></i> กรุณากดยืนยันเปลี่ยนรหัสผ่านที่อีเมลของคุณ</div>";
        } else {
            $msg = "<div class=\"alert alert-warning text-center\"><i class=\"fas fa-hourglass-half\"></i> ระบบล้มเหลวไม่สามารถส่งอีเมลได้</div>";
        }
    } else {
        $msg = "<div class=\"alert alert-warning text-center\"><i class=\"fas fa-hourglass-half\"></i> ไม่พบอีเมลที่ต้องการเปลี่ยนรหัสผ่าน</div>";
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
                        <h3>กรุณากรอกอีเมลผู้ใช้</h3>
                        <form action="" method="POST">
                            <div class="input__item">
                                <input type="text" name="recov_email" id="recov_email" placeholder="อีเมลผู้ใช้เพื่อใช้กู้คืนรหัสผ่าน">
                                <span class="icon_mail"></span>
                            </div>
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
    </script>

</body>

</html>