<?php
// include composer autoload
require_once 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (isset($_POST['submit'])) {
    $ads_title = $_POST['ads_title'];
    if ($_POST['ads_detail'] == '<p><br></p>') {
        $ads_detail = '';
    } else {
        $ads_detail = $_POST['ads_detail'];
    }
    $ads_link = $_POST['ads_link'];
    $ads_status = $_POST['ads_status'];

    $sql = " INSERT INTO ads SET
                                id = NULL,
                                ads_title = '$ads_title',
                                ads_detail = '$ads_detail',
                                ads_link = '$ads_link',
                                ads_image = '',
                                ads_num = 0,
                                ads_count = 0,
                                ads_status = '$ads_status' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=ads&file=ads_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    // อัพโหลดรูปภาพ
    if ($_FILES['fileUpload']['name'] != '') {
        $sql_max = 'SELECT MAX(id) AS max_id FROM ads';
        $result_max = mysqli_query($conn, $sql_max);
        $r_max = mysqli_fetch_assoc($result_max);
        $id_max01 = $r_max['max_id'];

        $fileUpload = $_FILES['fileUpload']['tmp_name'];
        $fileUpload_name = $_FILES['fileUpload']['name'];
        $fileUpload_size = $_FILES['fileUpload']['size'];
        $fileUpload_type = $_FILES['fileUpload']['type'];

        $ext = strtolower(end(explode('.', $fileUpload_name)));
        if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif' or $ext == 'webp') {
            $id_max_ads = $id_max01;
            $day_file_ads = date('ymd');
            $time_file_ads = date('His');
            $filename = 'ads-' . $id_max_ads . '-' . $day_file_ads . $time_file_ads . '.' . $ext;
            if ($ext == 'jpg') {
                // สร้างไฟล์ thumbnail จากไฟล์ต้นฉบับ จำนวน 2 ขนาด
                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(361, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/ads/' . $filename);
            } elseif ($ext == 'jpeg') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(361, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/ads/' . $filename);
            } elseif ($ext == 'png') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(361, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/ads/' . $filename);
            } elseif ($ext == 'gif') {

                $manager->make($_FILES['fileUpload']['tmp_name'])
                    ->resize(361, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save('../images/ads/' . $filename);
            } elseif ($ext == 'webp') {
                $filename = 'ads-' . $id_max_ads . '-' . $day_file_ads . $time_file_ads . '.jpeg';
                $im = imagecreatefromwebp($fileUpload);
                imagejpeg($im, '../images/ads/' . $filename, 100);
                imagedestroy($im);
            }

            $sql_update_im = " UPDATE ads SET ads_image = '$filename' WHERE id = '$id_max_ads' ";
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
                    <label for="ads_title">ชื่อโฆษณา</label>
                    <input type="text" class="form-control" name="ads_title" id="ads_title" placeholder="ชื่อโฆษณา">
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
                    <label for="ads_link">Link เว็บไซต์</label>
                    <input type="text" name="ads_link" id="ads_link" class="form-control" placeholder="https://www.google.com">
                </div>
                <div class="form-group d-none" id="ads-detail">
                    <label for="summernote">รายละเอียด</label>
                    <textarea name="ads_detail" id="summernote" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="ads_status">สถานะ</label>
                    <select class="form-control select2bs4" name="ads_status" id="ads_status">
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