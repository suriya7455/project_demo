<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boukensha Guild | about</title>

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

    <!-- dataTables -->
    <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="guild_admin/plugins/summernote/summernote-bs4.min.css">
    <!-- fancybox -->
    <link href="guild_admin/plugins/fancybox/fancybox.css" rel="stylesheet" />

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.7.2/font/bootstrap-icons.min.css">

    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    if (isset($_POST['submit'])) {
        $contact_name = $_POST['name'];
        $contact_email = $_POST['email'];
        $contact_subject = $_POST['subject'];
        $contact_message = $_POST['message'];

        $sql = " INSERT INTO contact SET
                         contact_fullname ='$contact_name',
                         contact_email ='$contact_email',
                         contact_subject ='$contact_subject',
                         contact_message ='$contact_message'
                     ";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $msg = "<div class='alert alert-success'>ส่งข้อความสำเร็จ รอการติดต่อกลับจากเจ้าหน้าที่</div>";
        } else {
            $msg = "<div class='alert alert-danger'>ส่งข้อความล้มเหลว</div>";
        }
    }
    ?>
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h2 class="text-center text-white font-weight-bold">Contract Boukensga Guild
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <section class="py-5 mb-5">
                        <div class="container mt-3 mb-3">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="section-headline text-center">
                                        <h2 class="text-light">ติดต่อเรา</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Start contact icon column -->
                                <div class="col-lg-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-phone text-light"></i>
                                            <p class="text-light">
                                                โทรศัพท์: 02-333-7888-8<br>
                                                <span>โทรศัพท์: 088-888-8888</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start contact icon column -->
                                <div class="col-lg-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-envelope text-light"></i>
                                            <p class="text-light">
                                                อีเมล: info@boukensha-guild.com<br>
                                                <span>เว็บไซต์: boukensha-guild.com</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Start contact icon column -->
                                <div class="col-lg-12">
                                    <div class="contact-icon text-center">
                                        <div class="single-icon">
                                            <i class="bi bi-geo-alt text-light"></i>
                                            <p class="text-light">
                                                ที่ตั้ง: 255 ถ. ราชวิถี แขวง ทุ่งพญาไท <br>
                                                <span>เขตราชเทวี กรุงเทพมหานคร 10400</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                               
                                <!-- End Google Map -->

                                <!-- Start  contact -->
                             <div class="co2-02">
                                <h3 class="t-contrat">ส่งข้อความด่วนถึงทีมงาน</h3>
                                <div class="col-lg-12">
                                    <?= $msg ?>
                                    <div class="form contact-form">
                                        <form action="" method="post" role="form" class="php-email-form">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="name" value="" placeholder="ชื่อ-นามสกุล" required="">
                                            </div>
                                            <div class="form-group mt-3">
                                                <input type="email" class="form-control" name="email" id="email" value="" placeholder="อีเมล" required="">
                                            </div>
                                            <div class="form-group mt-3">
                                                <input type="text" class="form-control" name="subject" id="subject" value="" placeholder="เรื่อง" required="">
                                            </div>
                                            <div class="form-group mt-3">
                                                <textarea class="form-control" name="message" rows="5" placeholder="ข้อความ" required=""></textarea>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" class="btn btn-block btn-primary" name="submit">ส่งข้อความ</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                                <!-- End Left contact -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>
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