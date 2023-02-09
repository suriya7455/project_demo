<?php
// include composer autoload
require_once 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (isset($_POST['submit'])) {
    $adslider_title = $_POST['adslider_title'];
    if ($_POST['adslider_detail'] == '<p><br></p>') {
        $adslider_detail = '';
    } else {
        $adslider_detail = $_POST['adslider_detail'];
    }
    $adslider_link = $_POST['adslider_link'];
    $adslider_status = $_POST['adslider_status'];

    $sql = " INSERT INTO adslider SET
                                id = NULL,
                                adslider_title = '$adslider_title',
                                adslider_detail = '$adslider_detail',
                                adslider_link = '$adslider_link',
                                adslider_image = '',
                                adslider_num = 0,
                                adslider_count = 0,
                                adslider_status = '$adslider_status' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=adslider&file=adslider_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    // อัพโหลดรูปภาพ
    if ($_FILES['fileUpload']['name'] != '') {
        $sql_max = 'SELECT MAX(id) AS max_id FROM adslider';
        $result_max = mysqli_query($conn, $sql_max);
        $r_max = mysqli_fetch_assoc($result_max);
        $id_max01 = $r_max['max_id'];

        $fileUpload = $_FILES['fileUpload']['tmp_name'];
        $fileUpload_name = $_FILES['fileUpload']['name'];
        $fileUpload_size = $_FILES['fileUpload']['size'];
        $fileUpload_type = $_FILES['fileUpload']['type'];

        $ext = strtolower(end(explode('.', $fileUpload_name)));
        if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif' or $ext == 'webp') {
            $id_max_adslider = $id_max01;
            $day_file_adslider = date('ymd');
            $time_file_adslider = date('His');
            $filename = 'adslider-' . $id_max_adslider . '-' . $day_file_adslider . $time_file_adslider . '.' . $ext;
            if ($ext == 'jpg') {
                // สร้างไฟล์ thumbnail จากไฟล์ต้นฉบับ จำนวน 2 ขนาด
                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(1172, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/adslider/' . $filename);
            } elseif ($ext == 'jpeg') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(1172, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/adslider/' . $filename);
            } elseif ($ext == 'png') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(1172, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/adslider/' . $filename);
            } elseif ($ext == 'gif') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(1172, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/adslider/' . $filename);
            } elseif ($ext == 'webp') {
                $filename = 'adslider-' . $id_max_adslider . '-' . $day_file_adslider . $time_file_adslider . '.jpeg';
                $im = imagecreatefromwebp($fileUpload);
                imagejpeg($im, '../images/adslider/' . $filename, 100);
                imagedestroy($im);
            }

            $sql_update_im = " UPDATE adslider SET adslider_image = '$filename' WHERE id = '$id_max_adslider' ";
            $result_update_im = mysqli_query($conn, $sql_update_im);
        }
    }
    // สิ้นสุดการอัพโหลดรูปภาพ
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">เพิ่มโฆษณา</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="adslider_title">ชื่อโฆษณา</label>
                    <input type="text" class="form-control" name="adslider_title" id="adslider_title" placeholder="ชื่อโฆษณา">
                </div>
                <div class="form-group">
                    <label for="fileUpload">รูปภาพ</label>
                    <input class="file-3" id="fileUpload" type="file" name="fileUpload" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="banner_type_link">เลือกรูปแบบโฆษณา (Link เว็บไซต์ / แสดงหน้ารายละเอียดโฆษณา)</label>
                    <div>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-info">
                                <input type="radio" name="banner_type" id="banner_type_link" checked> Link เว็บไซต์
                            </label>
                            <label class="btn btn-outline-info">
                                <input type="radio" name="banner_type" id="banner_type_detail"> แสดงหน้ารายละเอียด
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="adslider_link">Link เว็บไซต์</label>
                    <input type="text" name="adslider_link" id="adslider_link" class="form-control" placeholder="https://www.google.com">
                </div>
                <div class="form-group d-none" id="adslider-detail">
                    <label for="summernote">รายละเอียด</label>
                    <textarea name="adslider_detail" id="summernote" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="adslider_status">สถานะ</label>
                    <select class="form-control select2bs4" name="adslider_status" id="adslider_status">
                        <option disabled>เลือกสถานะ</option>
                        <option value="1">เปิด</option>
                        <option value="2">ปิด</option>
                    </select>
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