<?php
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
    <title>Boukensha Guild | Details</title>

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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" integrity="sha512-Oy+sz5W86PK0ZIkawrG0iv7XwWhYecM3exvUtMKNJMekGFJtVAhibhRPTpmyTj8+lJCkmWfnpxKgT2OopquBHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- dataTables -->
    <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="guild_admin/plugins/summernote/summernote-bs4.min.css">

    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4f8d37d54959edcc"></script>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <?php require './layout/top-menu.php'; ?>
    <!-- Header End -->

    <!-- Blog Details Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <!-- single-blog start -->
                <?php
                $view_id = $_GET['id'];

                if (!empty($_GET['id'])) {
                    $sql_count = " UPDATE blog SET 
                                    blog_view = blog_view + 1
                                    WHERE id = '$view_id' ";
                    mysqli_query($conn, $sql_count);
                }
                $sql = "SELECT * FROM blog WHERE id = '$view_id'";
                $result = mysqli_query($conn, $sql);
                $num_blog = mysqli_num_rows($result);
                if ($num_blog > 0) {
                    $rs = mysqli_fetch_assoc($result);
                    $id_ref_blog = $rs['id'];
                    $id_author = $rs['author_id'];
                    $id_blog_type = $rs['blog_type_id'];
                ?>
                    <?php
                    $sql_img = " SELECT * FROM images_blog WHERE ref_blog = '$id_ref_blog' ";
                    $result_img = mysqli_query($conn, $sql_img);
                    $rs_img = mysqli_fetch_assoc($result_img);
                    ?>
                    <div class="blog__details__item__text">
                        <h4 class="text-center"><?= $rs['blog_title'] ?></h4>
                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox_ak9f text-center"></div>
                    </div>
                    <article class="blog-post-wrapper">
                        <div class="col-lg-12">
                            <div class="blog__details__pic">
                                <?php if ($rs_img['imagesupload'] != "") { ?>
                                    <img src="images/blog/<?= $rs_img['imagesupload'] ?>" class="mx-auto d-block" alt="">
                                <?php } else { ?>
                                    <i class="far fa-image fa-7x"></i>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="post-information">
                            <div class="entry-meta mb-1">
                                <span class="text-light"><i class="bi bi-bar-chart"></i> <?= number_format($rs['blog_view']) ?></span>
                                <?php $sql_author = "SELECT * FROM author WHERE id = $id_author ";
                                $result_author = mysqli_query($conn, $sql_author);
                                $rs_author = mysqli_fetch_assoc($result_author);
                                ?>
                                <span class="text-light mr-2"><i class="bi bi-person"></i> <a href="#" class="text-light"><?= $rs_author['author_name'] ?></a></span>
                                <span class="text-light mr-2"><i class="bi bi-clock"></i> <?= DateThaiFull($rs['blog_created']) ?></span>
                                <span class="text-light mr-2">
                                    <i class="bi bi-folder"></i>
                                    <?php $sql_blog_type = " SELECT * FROM blog_type WHERE id = $id_blog_type ";
                                    $result_blog_type = mysqli_query($conn, $sql_blog_type);
                                    $rs_blog_type = mysqli_fetch_assoc($result_blog_type);
                                    ?>
                                    <a class="text-light badge badge-success" style="font-size: 1rem;" href="blog-type.php?type_id=<?= $rs_blog_type['id'] ?>"><?= $rs_blog_type['blog_type_name'] ?></a>
                                </span>
                                <span class="text-light mr-2">
                                    <i class="bi bi-tags"></i>
                                    <?php
                                    $sql_tagsdetails = " SELECT td.id,td.blog_id,td.tags_id,ts.tags_name,ts.tags_date FROM tags_detail td INNER JOIN tags ts
                            ON td.tags_id = ts.id
                            WHERE td.blog_id = " . $rs['id'];
                                    $result_tagsdetails = mysqli_query($conn, $sql_tagsdetails);
                                    while ($rs_tagsdetails = mysqli_fetch_assoc($result_tagsdetails)) {
                                    ?>
                                        <a class="text-light badge badge-primary" href="blog-tag.php?tag_id=<?= $rs_tagsdetails['tags_id'] ?>" style="font-size: 1rem;"><?= $rs_tagsdetails['tags_name'] ?></a>
                                    <?php } ?>
                                </span>
                            </div>
                            <hr class="bg-white">
                            <div class="blog__details__text">
                                <?= $rs['blog_content'] ?>
                            </div>
                        </div>
                    </article>
                <?php } else { ?>
                    <div class="alert alert-danger text-center">ไม่พบบทความนี้ในระบบ</div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->

    <!-- Footer Section Begin -->
    <?php require './layout/footer-menu.php'; ?>
    <!-- Footer Section End -->

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

    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/app.js"></script>
    <script>
        $('font').css('color', 'white');
        $('p').css('color', 'white');
        $('p span').css('color', 'white');
        $('h1,h2,h3,h4,h5').css('color', 'white');
    </script>
</body>

</html>