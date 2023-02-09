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
    <title>Boukensha Guild | Last Completed Quest</title>

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

    <!-- Custom styles for this page -->
    <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bg-newlast-quest {
            background: url('images/bg_anime/bg_newlast_quest.jpg') no-repeat top center;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php require 'layout/top-menu.php'; ?>
    <!-- Header End -->

    <!-- Guild Board Begin-->
    <section class="product spad bg-newlast-quest" style="margin-bottom:0;padding-bottom:0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-10">
                    <div class="anime__details__text col-9 mx-auto">
                        <div class="anime__details__title">
                            <h2 class="text-center text-dark font-weight-bold">Last Completed Quest</h2>
                        </div>
                        <h4 class="text-center text-dark font-weight-bold">
                            Boukensha Guild Board</h4>
                        <div class="col-md-12 mt-5 text-center">
                            <p class="text-dark text-center">Create New Quest</p>
                            <a href="quest-add.php" class="btn btn-lg btn-success">มอบหมายภารกิจ</a>
                        </div>
                        <div class="container mt-5">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <form action="" method="get">
                                        <h4 class="text-dark mb-2">ค้นหาภารกิจ</h4>
                                        <div class="input-group input-group-lg mb-3">
                                            <input type="search" class="form-control" id="search" placeholder="Search" aria-label="Search" aria-describedby="button-addon2" required>
                                            <div class="input-group-append">
                                                <button class="btn bg-light" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="text-muted">Keyword, Hastag :</div>
                                    </form>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <form action="" method="get">
                                        <h4 class="text-dark mb-2">ค้นหาจากหมวดหมู่</h4>
                                        <div class="input-group input-group-lg mb-3">
                                            <select class="form-control" name="categories_id" id="categories_id" required>
                                                <option value="" disabled selected>Search</option>
                                                <?php
                                                $sql_c1 = " SELECT categories_status FROM categories GROUP BY categories_status ";
                                                $result_c1 = mysqli_query($conn, $sql_c1);
                                                while ($rs_c1 = mysqli_fetch_assoc($result_c1)) {
                                                    $sta_c = $rs_c1['categories_status'];
                                                ?>
                                                    <optgroup label="<?= $rs_c1['categories_status'] ?>">
                                                        <?php
                                                        $sql_c2 = " SELECT * FROM categories WHERE categories_status = '$sta_c'  ORDER BY CONVERT(categories_name USING tis620) ASC";
                                                        $result_c2 = mysqli_query($conn, $sql_c2);
                                                        while ($rs_c2 = mysqli_fetch_assoc($result_c2)) {
                                                        ?>
                                                            <option value="<?= $rs_c2['categories_name'] ?>"><?= $rs_c2['categories_name'] ?></option>
                                                        <?php } ?>
                                                    </optgroup>
                                                <?php } ?>
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn bg-light" type="button" id="button-addon2"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="text-muted mb-2">Categories1: <a id="q_offline" class="text-secondary" href="javascript:;">Offline</a> <a id="q_online" class="text-secondary" href="javascript:;">Online</a></div>
                                        <div class="text-muted mb-2" id="cc_1">Categories2:
                                            <?php
                                            $sql_cate1 = " SELECT * FROM categories WHERE categories_status = 2 ";
                                            $result_cate1 = mysqli_query($conn, $sql_cate1);
                                            while ($rs_cate1 = mysqli_fetch_assoc($result_cate1)) {
                                            ?>
                                                <a class="text-secondary" href="#categories" data-select="<?= $rs_cate1['categories_name'] ?>"><?= $rs_cate1['categories_name'] ?></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="text-muted mb-2 d-none" id="cc_2">Categories2:
                                            <?php
                                            $sql_cate2 = " SELECT * FROM categories WHERE categories_status = 1 ";
                                            $result_cate2 = mysqli_query($conn, $sql_cate2);
                                            while ($rs_cate2 = mysqli_fetch_assoc($result_cate2)) {
                                            ?>
                                                <a class="text-secondary" href="#categories" data-select="<?= $rs_cate2['categories_name'] ?>"><?= $rs_cate2['categories_name'] ?></a>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <style>
                                    .dataTables_length {
                                        display: none;
                                    }

                                    .dataTables_filter {
                                        display: none;
                                    }

                                    table.dataTable td.dataTables_empty {
                                        text-align: center;
                                    }

                                    .dataTables_paginate {
                                        float: right;
                                    }


                                    /* Page no button */
                                    .page-item.disabled .page-link {
                                        color: black;
                                        pointer-events: none;
                                        cursor: auto;
                                        background-color: transparent;
                                        border-color: transparent;
                                    }

                                    .dataTables_paginate .page-link {
                                        position: relative;
                                        display: block;
                                        padding: 0.5rem 0.75rem;
                                        margin-left: -1px;
                                        line-height: 1.25;
                                        color: black;
                                        background-color: transparent;
                                        border: 0px;
                                    }

                                    .page-item.active .page-link {
                                        z-index: 3;
                                        color: black;
                                        background-color: transparent;
                                        border-color: transparent;
                                        border: 0px;
                                    }

                                    .dataTables_info {
                                        display: none;
                                    }
                                </style>
                                <div class="table-responsive mb-3">
                                    <table class="table table-borderless text-dark" id="complete-quest-grid">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th class="text-center">ชื่อเควส</th>
                                                <th class="text-center">ประเภทเควส (งาน)</th>
                                                <th class="text-center">ตำแหน่งภารกิจ</th>
                                                <th class="text-center">วันที่มอบหมาย</th>
                                                <th class="text-center">ผู้ว่าจ้าง</th>
                                                <th class="text-center">รางวัลภารกิจ</th>
                                                <th class="text-center">สถานะ</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4 text-center"><i class="fas fa-door-closed text-primary"></i>&nbsp; <a href="new-quest.php" class="text-danger font-weight-bold">ภารกิจที่ยังไม่แล้วเสร็จ</a></div>
                            <div class="col-md-4 text-center"><i class="fas fa-scroll text-primary"></i>&nbsp; <a href="guild-board.php" class="text-danger font-weight-bold">กลับไปที่ Guild Board</a></div>
                            <div class="col-md-4 text-center"><i class="fas fa-dungeon text-primary"></i>&nbsp; <a href="index.php" class="text-danger font-weight-bold">กลับไปที่ Guild (หน้าหลัก)</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <?php
                    $sql_banner_slider = " SELECT * FROM banner WHERE banner_status = 'เปิด' ORDER BY rand() LIMIT 0,5 ";
                    $result_banner_slider = mysqli_query($conn, $sql_banner_slider);
                    $num_i = 0;
                    while ($rs_banner_slider = mysqli_fetch_assoc($result_banner_slider)) {
                        $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                    WHERE id = " . $rs_banner_slider['id'];
                        mysqli_query($conn, $sql_view);
                        $_SESSION['sess_ran_id'][$num_i] = $rs_banner_slider['id'];
                        $num_i++;
                    }
                    ?>
                    <div class="overflow-auto" style="height:105rem; width:100%" id="ads-random-15">
                        <?php
                        $b_id1 = $_SESSION['sess_ran_id'][0];
                        $b_id2 = $_SESSION['sess_ran_id'][1];
                        $b_id3 = $_SESSION['sess_ran_id'][2];
                        $b_id4 = $_SESSION['sess_ran_id'][3];
                        $b_id5 = $_SESSION['sess_ran_id'][4];
                        $sql_banner1 = " SELECT * FROM banner WHERE banner_status = 'เปิด' AND id <> '$b_id1' AND id <> '$b_id2' AND id <> '$b_id3' AND id <> '$b_id4' AND id <> '$b_id5' ORDER BY RAND () LIMIT 15 ";
                        $result_banner1 = mysqli_query($conn, $sql_banner1);
                        while ($rs_banner1 = mysqli_fetch_assoc($result_banner1)) {
                            $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                                    WHERE id = " . $rs_banner1['id'];
                            mysqli_query($conn, $sql_view);
                        ?>
                            <div class="col-md-12">
                                <a href="ads-link.php?b_id=<?= $rs_banner1['id'] ?>" target="_blank"><img src="images/banner/<?= $rs_banner1['banner_image'] ?>" class="rounded mt-1 mb-1" alt="<?= $rs_banner1['banner_title'] ?>"></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Guild Board End-->
    <?php
    require 'layout/footer-menu.php';
    ?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/player.js"></script>
    <!-- <script src="js/jquery.nice-select.min.js"></script> -->
    <script src="js/mixitup.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main2.js"></script>

    <!-- Datatable -->
    <script src="guild_admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="guild_admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="guild_admin/plugins/datatables/data.th.js"></script>

    <!-- Summernote -->
    <script src="guild_admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- include summernote-th-TH -->
    <script src="guild_admin/plugins/summernote/lang/summernote-th-TH.min.js"></script>

    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/app.js"></script>


</body>

</html>