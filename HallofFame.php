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
    <title>Boukensha Guild | Pages</title>

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
    <section class="product spad bg-hall px-5 px-5 pb-3" style="margin-bottom:0;padding-bottom:0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3 class="text-center">Hall of Fame</h3>
                            <span class="text-center">บันทึกแห่งเกียรติยศ</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="text-center text-light font-weight-bold h4">Origin Quest</h4>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-light text-nowrap" id="customers">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Genesis Quest</th>
                                                <th class="text-center">Quest Name</th>
                                                <th class="text-center">Quest Assignor </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_quest1 = " SELECT * FROM hall_left ORDER BY id ASC ";
                                            $result_quest1 = mysqli_query($conn, $sql_quest1);
                                            $num_quest1 = mysqli_num_rows($result_quest1);
                                            if ($num_quest1 > 0) {
                                                $no = 1;
                                                while ($rs_quest1 = mysqli_fetch_assoc($result_quest1)) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?= $rs_quest1['hall_genesis_quest'] ?></td>
                                                        <td><a href="<?= $rs_quest1['hall_quest_Link'] ?>"><?= $rs_quest1['hall_quest_name'] ?></a></td>
                                                        <td class="text-center"><?= $rs_quest1['hall_quest_assignor'] ?></td>
                                                    </tr>
                                                <?php $no++;
                                                } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h4 class="text-center text-light font-weight-bold h4">Boukensha Hall of Fame</h4>
                                <div class="table-responsive">
                                    <table class="table table-borderless text-light text-nowrap" id="customers">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Genesis Quest</th>
                                                <th class="text-center">Quest Name</th>
                                                <th class="text-center">Quest Assignor </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql_quest2 = " SELECT * FROM hall_right ORDER BY id ASC ";
                                            $result_quest2 = mysqli_query($conn, $sql_quest2);
                                            $num_quest2 = mysqli_num_rows($result_quest2);
                                            if ($num_quest2 > 0) {
                                                $no = 1;
                                                while ($rs_quest2 = mysqli_fetch_assoc($result_quest2)) {
                                            ?>
                                                    <tr>
                                                        <td class="text-center"><?= $rs_quest2['hall_genesis_quest'] ?></td>
                                                        <td><a href="<?= $rs_quest2['hall_quest_Link'] ?>"><?= $rs_quest2['hall_quest_name'] ?></a></td>
                                                        <td class="text-center"><?= $rs_quest2['hall_quest_assignor'] ?></td>
                                                    </tr>
                                                <?php $no++;
                                                }
                                            } else { ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">ยังไม่มี Hall of Fame</td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script>
        $('font').css('color', 'white');
        $('pages__details__text p,h1,h2,h3,h4,h5').css('color', 'white');
        $('p,h1,h2,h3,h4,h5').css('color', 'white');
    </script>
</body>

</html>