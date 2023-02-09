<?php
// include composer autoload
require_once 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (isset($_POST['submit'])) {
    $id_edit = $_POST['id_edit'];
    $adslider_title = $_POST['adslider_title'];
    if ($_POST['adslider_detail'] == '<p><br></p>') {
        $adslider_detail = '';
    } else {
        $adslider_detail = $_POST['adslider_detail'];
    }
    $adslider_link = $_POST['adslider_link'];
    $adslider_status = $_POST['adslider_status'];

    $sql = " UPDATE adslider SET
                                adslider_title = '$adslider_title',
                                adslider_detail = '$adslider_detail',
                                adslider_link = '$adslider_link',
                                adslider_status = '$adslider_status' 
                                WHERE id = '$id_edit' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=adslider&file=adslider_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    // อัพโหลดรูปภาพ
    if ($_FILES['fileUpload']['name'] != '') {
        $id_max01 = $id_edit;

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

// Del images
if (isset($_GET['del_id'])) {

    $id_dels = $_GET['del_id'];

    $sql_delim = " SELECT * FROM adslider WHERE id = $id_dels ";
    $result_delim = mysqli_query($conn, $sql_delim);
    $rs_delim = mysqli_fetch_assoc($result_delim);

    if ($rs_delim['adslider_image'] != "") {
        $fileuploader = $rs_delim['adslider_image'];
        unlink("../images/adslider/$fileuploader");
    }

    $sql_dels = " UPDATE adslider SET
                                    adslider_image = ''
                                    WHERE id = $id_dels ";
    $result_dels = mysqli_query($conn, $sql_dels);

    if ($result_dels) {
        header("Location:index.php?mn=adslider&file=adslider_edit&edit_id=$id_dels");
        echo "<script>del_imgsuccess();</script>";
    } else {
        header("Location:index.php?mn=adslider&file=adslider_edit&edit_id=$id_dels");
        echo "<script>del_imgfails();</script>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">แก้ไขโฆษณา</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM adslider WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        $ids_edit = $rs_edit['id'];
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="adslider_title">ชื่อโฆษณา</label>
                    <input type="text" class="form-control" name="adslider_title" value="<?= $rs_edit['adslider_title'] ?>" id="adslider_title" placeholder="ชื่อโฆษณา">
                </div>
                <div class="form-group">
                    <?php
                    $filename = '../images/adslider/' . $rs_edit['adslider_image'];
                    $img_upload = $rs_edit['adslider_image'];
                    $img_links = "index.php?mn=adslider&file=adslider_edit&edit_id=$ids_edit&del_id=$ids_edit";
                    ?>
                    <?php if ($rs_edit['adslider_image'] == "") { ?>
                        <label for="file_upload">รูปภาพ</label>
                        <input class="file-3" id="file_upload" type="file" name="fileUpload" accept="image/*">
                    <?php } else { ?>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li>
                                <span class="mailbox-attachment-icon has-img mb-3"><i class="fas fa-image fa fa-2x"></i></span>
                                <div class="mailbox-attachment-info">
                                    <a href="javascript:;" class="mailbox-attachment-name" data-fancybox="single" data-src="<?= $filename ?>" data-caption="<?= $rs_edit['adslider_title'] ?>"><i class="fas fa-camera"></i> รูปภาพ</a>
                                    <span class="mailbox-attachment-size clearfix mt-1">
                                        <span><?= number_format(filesize($filename) / 1024 / 2024, 4) ?> MB</span>
                                        <a href="javascript:;" class="btn btn-danger btn-sm float-right" onclick="cdelimg('<?= $img_upload ?>','<?= $img_links ?>')"><i class="far fa-trash-alt"></i></a>
                                    </span>
                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="banner_type_link">เลือกรูปแบบโฆษณา (Link เว็บไซต์ / แสดงหน้ารายละเอียดโฆษณา)</label>
                    <div>
                        <?php if ($rs_edit['adslider_detail'] == "") {
                            $adslider_status1 = "checked";
                        ?>
                        <?php } else {
                            $adslider_status2 = "checked";
                        ?>
                        <?php } ?>
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-outline-info">
                                <input type="radio" name="banner_type" id="banner_type_link" <?= $adslider_status1 ?>> Link เว็บไซต์
                            </label>
                            <label class="btn btn-outline-info">
                                <input type="radio" name="banner_type" id="banner_type_detail" <?= $adslider_status2 ?>> แสดงหน้ารายละเอียด
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="adslider_link">Link เว็บไซต์</label>
                    <input type="text" name="adslider_link" id="adslider_link" class="form-control" value="<?= $rs_edit['adslider_link'] ?>" placeholder="https://www.google.com">
                </div>
                <?php if ($rs_edit['adslider_detail'] != "") { ?>
                    <?php $adslider_descript_show = ""; ?>
                <?php  } else { ?>
                    <?php $adslider_descript_show = "d-none"; ?>
                <?php } ?>

                <div class="form-group <?= $adslider_descript_show ?>" id="adslider-detail">
                    <label for="summernote">รายละเอียด</label>
                    <textarea name="adslider_detail" id="summernote" rows="5" class="form-control"><?= $rs_edit['adslider_detail'] ?></textarea>
                </div>
                <div class="form-group">
                    <?php
                    if ($rs_edit['adslider_status'] == "เปิด") {
                        $ad1 = "selected";
                    }
                    if ($rs_edit['adslider_status'] == "ปิด") {
                        $ad2 = "selected";
                    }
                    ?>
                    <label for="adslider_status">สถานะ</label>
                    <select class="form-control select2bs4" name="adslider_status" id="adslider_status">
                        <option disabled>เลือกสถานะ</option>
                        <option value="1" <?= $ad1 ?>>เปิด</option>
                        <option value="2" <?= $ad2 ?>>ปิด</option>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="hidden" name="id_edit" value="<?= $ids_edit ?>">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>