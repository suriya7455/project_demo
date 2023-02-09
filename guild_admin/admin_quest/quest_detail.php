<?php $view_id = $_GET['view_id'];
$sql = "SELECT * FROM quest WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="col-md-12">
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">รายละเอียดภารกิจ</h3>
        </div>
        <div class="card-body">
            <!-- single-blog start -->
            <article class="blog-post-wrapper">
                <div class="post-information">
                    <h4><?= $rs['quest_name'] ?></h4>
                    <div class="entry-meta mb-1">
                        <span class="text-muted mr-2"><i class="bi bi-person"></i> <a href="#" class="text-muted"><?= $rs['quest_assignor'] ?></a></span>
                        <span class="text-muted mr-2"><i class="bi bi-clock"></i> <?= DateThaiFull($rs['quest_created']) ?></span>
                    </div>
                    <hr>
                    <div class="entry-content">
                        <div class="form-horizontal">
                            <div class="form-group row">
                                <h5 class="text-center">รายละเอียดภารกิจ</h5>
                                <?= nl2br($rs['quest_description']) ?>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-4 col-form-label">เงื่อนไขการส่งมอบภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= nl2br($rs['quest_condition']) ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobilenumber" class="col-sm-4 col-form-label">รางวัลภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_reward'] ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">จำนวนนักผจญภัยสำหรับภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_human'] ?>
                                </div>
                            </div>
                            <?php if ($rs['quest_human'] == "นักผจญภัย มากกว่า 1 คน") { ?>
                                <div class="form-group row">
                                    <label for="regdate" class="col-sm-4 col-form-label">รายละเอียดนักผจญภัยสำหรับภารกิจ</label>
                                    <div class="col-sm-8 pt-2">
                                        <?= $rs['quest_human_more'] ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">ระยะเวลาสำหรับภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_duration'] ?>
                                </div>
                            </div>
                            <?php if ($rs['quest_duration'] == "จำกัดระยะเวลา") { ?>
                                <div class="form-group row">
                                    <label for="regdate" class="col-sm-4 col-form-label">รายละเอียดระยะเวลาสำหรับภารกิจ</label>
                                    <div class="col-sm-8 pt-2">
                                        <?= $rs['quest_duration_day'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">สถานที่สำหรับทำภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_location'] ?>
                                </div>
                            </div>
                            <?php if ($rs['quest_location_map'] != "") { ?>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">Google Map</label>
                                    <div class="col-sm-8 pt-2">
                                        <?php
                                        $map = $rs['quest_location_map'];
                                        $array_date = explode(')', $map);
                                        $msg1 = $array_date[0];
                                        $msg2 = $array_date[1];

                                        $key = str_replace("(", "", $msg1);
                                        $latlong = str_replace(" ", "", $key);
                                        ?>
                                        <iframe width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy" src="https://maps.google.com/maps?q=<?= $latlong ?>&hl=th;z=14&amp;output=embed"></iframe>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($rs['quest_location_address'] != "") { ?>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-4 col-form-label">สถานที่สำหรับทำภารกิจ</label>
                                    <div class="col-sm-8 pt-2">
                                        <?= nl2br($rs['quest_location_address']) ?>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">ประเภทภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_catagory'] ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">รายละเอียดประเภทภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?php
                                    $sql_categories = "SELECT * FROM categories WHERE id = " . $rs['quest_category_id'];
                                    $result_categories = mysqli_query($conn, $sql_categories);
                                    $rs_categories = mysqli_fetch_assoc($result_categories);
                                    ?>
                                    <?= $rs_categories['categories_name'] ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">ชื่อผู้มอบหมายภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= $rs['quest_assignor'] ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">ช่องทางติดต่อผู้มอบหมายภารกิจ</label>
                                <div class="col-sm-8 pt-2">
                                    <?= nl2br($rs['quest_assignor_address']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            <!-- single-blog end -->
        </div>
        <div class="card-footer text-muted">
            &nbsp;
        </div>
    </div>
</div>