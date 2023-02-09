<?php
session_start();
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
require 'config/pages_class.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boukensha Guild | Blog</title>
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

    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <?php
                $sql_b_tag = " SELECT * FROM tags WHERE id = " . $_GET['tag_id'];
                $result_b_tag = mysqli_query($conn, $sql_b_tag);
                $rs_b_tag = mysqli_fetch_assoc($result_b_tag);
                ?>
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Boukensha Blog</h2>
                        <p><?= $rs_b_tag['tags_name'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Normal Breadcrumb End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div id="blog-pages">
                <div class="row">
                    <!-- Start Left Blog -->
                    <?php
                    $tag_id = $_GET['tag_id'];
                    $_SESSION['tag_id'] = $tag_id;
                    $strSQL = " SELECT blog.id,blog.blog_title,blog.blog_view,blog.blog_created,blog.blog_content FROM blog INNER JOIN tags_detail
                    ON blog.id = tags_detail.blog_id
               WHERE tags_detail.tags_id = '$tag_id' ";
                    $objQuery = mysqli_query($conn, $strSQL) or die("Error Query [" . $strSQL . "]");
                    $Num_Rows = mysqli_num_rows($objQuery);

                    $Per_Page = 6; // Per Page

                    $Page = $_GET["Page"];
                    if (!$_GET["Page"]) {
                        $Page = 1;
                    }

                    $Prev_Page = $Page - 1;
                    $Next_Page = $Page + 1;

                    $Page_Start = (($Per_Page * $Page) - $Per_Page);
                    if ($Num_Rows <= $Per_Page) {
                        $Num_Pages = 1;
                    } else if (($Num_Rows % $Per_Page) == 0) {
                        $Num_Pages = ($Num_Rows / $Per_Page);
                    } else {
                        $Num_Pages = ($Num_Rows / $Per_Page) + 1;
                        $Num_Pages = (int) $Num_Pages;
                    }

                    $strSQL .= " ORDER BY blog_created DESC LIMIT $Page_Start , $Per_Page";
                    $objQuery = mysqli_query($conn, $strSQL);
                    ?>
                    <?php while ($rs_blog = mysqli_fetch_assoc($objQuery)) { ?>
                        <div class="col-md-4 col-sm-4 col-xs-12 mb-3 text-light">
                            <div class="single-blog">
                                <div class="single-blog-img">
                                    <?php
                                    $sql_imblog = " SELECT * FROM images_blog WHERE ref_blog = " . $rs_blog['id'];
                                    $result_imblog = mysqli_query($conn, $sql_imblog);
                                    $rs_imblog = mysqli_fetch_assoc($result_imblog);
                                    ?>
                                    <a href="blog-details.php?id=<?= $rs_blog['id'] ?>">
                                        <img src="images/blog/<?= $rs_imblog['imagesupload'] ?>" alt="<?= $rs_blog['blog_title'] ?>" style="aspect-ratio: 3 / 2;">
                                    </a>
                                </div>
                                <div class="blog-meta">
                                    <span class="comments-type">
                                        <i class="bi bi-bar-chart"></i>
                                        <?= number_format($rs_blog['blog_view']) ?> เข้าชม
                                    </span>
                                    <span class="date-type">
                                        <i class="bi bi-clock"></i> <?= DateThaiFull($rs_blog['blog_created']) ?></span>
                                </div>
                                <div class="blog-text">
                                    <h4>
                                        <a class="text-danger" href="blog-details.php?id=<?= $rs_blog['id'] ?>"><?= $rs_blog['blog_title'] ?></a>
                                    </h4>
                                    <p class="text-light"><?= iconv_substr(strip_tags($rs_blog['blog_content']), 0, 200, 'UTF-8') ?></p>
                                </div>
                                <span>
                                    <a class="text-light" href="blog-details.php?id=<?= $rs_blog['id'] ?>" class="ready-btn">อ่านต่อ</a>
                                </span>
                            </div>
                            <!-- Start single blog -->
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-12 text-right">
                    <div class="blog-pagination">
                        <?php
                        $pages = new Paginator;
                        $pages->items_total = $Num_Rows;
                        $pages->mid_range = 3;
                        $pages->current_page = $Page;
                        $pages->default_ipp = $Per_Page;
                        $pages->url_next = $_SERVER["PHP_SELF"] . "?Page="; // url

                        $pages->paginate();
                        if ($Num_Rows > 0) {
                            echo $pages->display_pages();
                        }
                        ?>
                    </div>
                </div>
                <!-- End Left Blog-->
            </div>
        </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Footer Section Begin -->
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
        /* Page Chaged */
        function pages_change(page_name) {
            if (page_name) {
                var page_change = "#blog-pages";
                $(page_change).html();
                $.get("pages/blog_tags_ajax.php", {
                    Page: page_name
                }, function(data) {
                    $(page_change).html(data);
                });
            }
            $(function() {
                $('html,body').animate({
                        scrollTop: $("#blog-pages").offset().top - 120
                    },
                    'slow');
            });
        }
    </script>
</body>

</html>