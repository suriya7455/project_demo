<?php
session_start();
require '../config/connect.php';
require '../config/function.php';
require '../config/stat.php';
require '../config/pages_class.php';
?>
<?php
$id_type = $_SESSION['$type_id'];
$strSQL = " SELECT * FROM  blog WHERE blog_type_id = '$id_type' ";
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
<div class="row">
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
<div class="blog-pagination text-right">
    <?php
    $pages = new Paginator;
    $pages->items_total = $Num_Rows;
    $pages->mid_range = 3;
    $pages->current_page = $Page;
    $pages->default_ipp = $Per_Page;
    $pages->url_next = $_SERVER["PHP_SELF"] . "?Page="; // url

    $pages->paginate();
    if ($Num_Rows > 4) {
        echo $pages->display_pages();
    }
    ?>
</div>