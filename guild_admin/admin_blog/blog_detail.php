<?php $view_id = $_GET['view_id'];
$sql = "SELECT * FROM blog WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
$id_ref_blog = $rs['id'];
$id_author = $rs['author_id'];
$id_blog_type = $rs['blog_type_id'];
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดบทความ</h3>
        </div>
        <div class="card-body">
            <!-- single-blog start -->
            <?php
            $sql_img = " SELECT * FROM images_blog WHERE ref_blog = '$id_ref_blog' ";
            $result_img = mysqli_query($conn, $sql_img);
            $rs_img = mysqli_fetch_assoc($result_img);
            ?>
            <article class="blog-post-wrapper">
                <div class="post-thumbnail">
                    <?php if ($rs_img['imagesupload'] != "") { ?>
                        <img src="../images/blog/<?= $rs_img['imagesupload'] ?>" class="img-fluid" alt="">
                    <?php } else { ?>
                        <i class="far fa-image fa-7x"></i>
                    <?php } ?>
                </div>
                <div class="post-information">
                    <h2><?= $rs['blog_title'] ?></h2>
                    <div class="entry-meta mb-1">
                        <?php $sql_author = "SELECT * FROM author WHERE id = $id_author ";
                        $result_author = mysqli_query($conn, $sql_author);
                        $rs_author = mysqli_fetch_assoc($result_author);
                        ?>
                        <span class="text-muted mr-2"><i class="bi bi-person"></i> <a href="#" class="text-muted"><?= $rs_author['author_name'] ?></a></span>
                        <span class="text-muted mr-2"><i class="bi bi-clock"></i> <?= DateThaiFull($rs['blog_created']) ?></span>
                        <span class="text-muted mr-2">
                            <i class="bi bi-folder"></i>
                            <?php $sql_blog_type = " SELECT * FROM blog_type WHERE id = $id_blog_type ";
                            $result_blog_type = mysqli_query($conn, $sql_blog_type);
                            $rs_blog_type = mysqli_fetch_assoc($result_blog_type);
                            ?>
                            <a class="text-muted" href="#"><?= $rs_blog_type['blog_type_name'] ?></a>
                        </span>
                        <span class="text-muted mr-2">
                            <i class="bi bi-tags"></i>
                            <?php
                            $sql_tagsdetails = " SELECT td.id,td.blog_id,td.tags_id,ts.tags_name,ts.tags_date FROM tags_detail td INNER JOIN tags ts
                            ON td.tags_id = ts.id
                            WHERE td.blog_id = " . $rs['id'];
                            $result_tagsdetails = mysqli_query($conn, $sql_tagsdetails);
                            while ($rs_tagsdetails = mysqli_fetch_assoc($result_tagsdetails)) {
                            ?>
                                <a class="text-muted" href="#"><?= $rs_tagsdetails['tags_name'] ?></a>,
                            <?php } ?>
                        </span>
                    </div>
                    <hr>
                    <div class="entry-content">
                        <?= $rs['blog_content'] ?>
                    </div>
                </div>
            </article>
            <!-- single-blog end -->
        </div>
        <div class="card-footer text-muted">
            <i class="bi bi-bar-chart"></i> <?= number_format($rs['blog_view']) ?>
        </div>
    </div>
</div>