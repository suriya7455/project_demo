<?php
if (isset($_POST['submit'])) {
    $quest_name = $_POST['quest_name'];
    $quest_description = mysqli_real_escape_string($conn, $_POST['quest_description']);
    $quest_condition = $_POST['quest_condition'];
    $quest_reward = $_POST['quest_reward'];
    $quest_human = $_POST['quest_human'];
    $quest_human_more = $_POST['quest_human_more'];
    $quest_duration = $_POST['quest_duration'];
    $quest_duration_day = $_POST['quest_duration_day'];
    $quest_location = $_POST['quest_location'];
    $quest_location_map = $_POST['quest_location_map'];
    $quest_location_address = $_POST['quest_location_address'];
    $quest_catagory = $_POST['quest_catagory'];
    if ($_POST['quest_category_id'] != "") {
        $quest_category_id = $_POST['quest_category_id'];
    }
    if ($_POST['quest_category_id2'] != "") {
        $quest_category_id = $_POST['quest_category_id2'];
    }
    $quest_category_note = $_POST['quest_category_note'];
    $quest_assignor = $_POST['quest_assignor'];
    $quest_assignor_address = $_POST['quest_assignor_address'];
    $quest_ip = get_client_ip();

    $sql = " INSERT INTO quest SET
                                id = NULL,
                                quest_name = '$quest_name',
                                quest_description = '$quest_description',
                                quest_condition = '$quest_condition',
                                quest_reward = '$quest_reward',
                                quest_human = '$quest_human',
                                quest_human_more = '$quest_human_more',
                                quest_duration = '$quest_duration',
                                quest_duration_day = '$quest_duration_day',
                                quest_location = '$quest_location',
                                quest_location_map = '$quest_location_map',
                                quest_location_address = '$quest_location_address',
                                quest_catagory = '$quest_catagory',
                                quest_category_id = '$quest_category_id',
                                quest_category_note = '$quest_category_note',
                                quest_assignor = '$quest_assignor',
                                quest_assignor_address = '$quest_assignor_address',
                                quest_status = 1,
                                quest_ip = '$quest_ip',
                                quest_created = CURRENT_TIMESTAMP,
                                quest_updated = CURRENT_TIMESTAMP
                                ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=quest&file=quest_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">เพิ่มภารกิจ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="quest_name">ชื่อภารกิจ</label>
                    <input type="text" class="form-control" name="quest_name" id="quest_name" placeholder="ชื่อภารกิจ">
                </div>
                <div class="form-group">
                    <label for="summernote">รายละเอียดภารกิจ</label>
                    <textarea class="form-control" id="summernote" name="quest_description"></textarea>
                </div>
                <div class="form-group">
                    <label for="summernote1">เงื่อนไขการส่งมาอบภารกิจ</label>
                    <textarea class="form-control" id="summernote1" name="quest_condition"></textarea>
                </div>
                <div class="form-group">
                    <label for="quest_reward">รางวัลภารกิจ</label>
                    <input type="text" class="form-control" name="quest_reward" id="quest_reward">
                </div>
                <div class="form-group">
                    <label for="quest_human">จำนวนนักผจญภัยสำหรับภารกิจ</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_human" id="quest_adventure_type_1" value="1" checked> นักผจญภัย 1 คน
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_human" id="quest_adventure_type_2" value="2"> นักผจญภัย มากกว่า 1 คน
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none" id="advmore-1">
                    <label for="quest_adventure_num">นักผจญภัย มากกว่า 1 คน</label>
                    <input type="text" class="form-control" name="quest_human_more" id="quest_adventure_num">
                </div>


                <div class="form-group">
                    <label for="quest_duration">ระยะเวลาสำหรับภารกิจ</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_duration" id="quest_adventure_duration_1" value="1" checked> ไม่จำกัดระยะเวลา
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_duration" id="quest_adventure_duration_2" value="2"> จำกัดระยะเวลา
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none" id="qavd-1">
                    <label for="quest_adventure_duration_day">ระยะเวลาสำหรับภารกิจ</label>
                    <input type="text" class="form-control" name="quest_duration_day" id="quest_adventure_duration_day">
                </div>

                <div class="form-group">
                    <label for="quest_location">สถานที่สำหรับทำภารกิจ</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_location" id="quest_location_online" value="1" checked> ออนไลน์ (Work From Home)
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_location" id="quest_location_offline" value="2"> ออฟไลน์
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group d-none" id="location-off">
                    <label for="quest_adventure_location">สถานที่ตำแหน่งที่ตั้ง</label>
                    <textarea name="quest_location_address" id="quest_adventure_location" rows="3" class="form-control"></textarea>
                </div>

                <!-- map -->
                <div class="form-group" id="location-on">
                    <label for="quest_local_online">สถานที่ตั้ง Google Map</label>
                    <input type="search" name="quest_location_map" id="quest_local_online" class="form-control ">
                </div>

                <div id="show-map"></div>
                <!-- map end -->

                <div class="form-group">
                    <label for="quest_title">ประเภทภารกิจ</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_catagory" id="quest_type_online" value="1" checked> ออนไลน์ (Work From Home)
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="quest_catagory" id="quest_type_offline" value="2"> ออฟไลน์
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="catagory-online">
                    <label for="quest_title">ประเภทภารกิจออนไลน์</label>
                    <div class="row">
                        <?php $sql_cate = " SELECT * FROM categories WHERE categories_status = 'Online'";
                        $result_cate = mysqli_query($conn, $sql_cate);
                        $no = 0;
                        while ($rs_cat = mysqli_fetch_assoc($result_cate)) {
                        ?>
                            <div class="custom-control custom-radio col-md-3">
                                <input class="custom-control-input" type="radio" id="customRadio<?= $no ?>" name="quest_category_id" value="<?= $rs_cat['id'] ?>">
                                <label for="customRadio<?= $no ?>" class="custom-control-label"><?= $rs_cat['categories_name'] ?></label>
                            </div>
                        <?php
                            $no++;
                        } ?>
                        <div class="custom-control custom-radio col-md-3">
                            <input class="custom-control-input" type="radio" id="customRadio_other" name="quest_category_id" value="0">
                            <label for="customRadio_other" class="custom-control-label">อื่นๆ</label>
                            <input type="text" class="form-control" name="quest_category_note" id="off_other">
                        </div>
                    </div>
                </div>
                <div class="form-group d-none" id="catagory-offline">
                    <label for="quest_title">ประเภทภารกิจออฟไลน์</label>
                    <div class="row">
                        <?php $sql_cate = " SELECT * FROM categories WHERE categories_status = 'Offline'";
                        $result_cate = mysqli_query($conn, $sql_cate);
                        $no = 0;
                        while ($rs_cat = mysqli_fetch_assoc($result_cate)) {
                        ?>
                            <div class="custom-control custom-radio col-md-3">
                                <input class="custom-control-input" type="radio" id="customRadio2<?= $no ?>" name="quest_category_id2" value="<?= $rs_cat['id'] ?>">
                                <label for="customRadio2<?= $no ?>" class="custom-control-label"><?= $rs_cat['categories_name'] ?></label>
                            </div>
                        <?php
                            $no++;
                        } ?>
                        <div class="custom-control custom-radio col-md-3">
                            <input class="custom-control-input" type="radio" id="customRadio_other2" name="quest_category_id2" value="0">
                            <label for="customRadio_other2" class="custom-control-label">อื่นๆ</label>
                            <input type="text" class="form-control" name="quest_category_note2" id="off_other2">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="quest_assignor">ชื่อผู้มอบหมายภารกิจ</label>
                    <input type="text" class="form-control" name="quest_assignor" id="quest_assignor">
                </div>

                <div class="form-group">
                    <label for="summernote2">ช่องทางติดต่อผู้มอบหมายภารกิจ</label>
                    <textarea class="form-control" name="quest_assignor_address" id="summernote2" rows="3"></textarea>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>