<?php
if (isset($_POST['submit'])) {
    $id_edit = $_POST['id_edit'];
    $banner_title = $_POST['banner_title'];
    $banner_link = $_POST['banner_link'];
    $banner_status = $_POST['banner_status'];

    $sql = " UPDATE banner SET
                                banner_title = '$banner_title',
                                banner_link = '$banner_link',
                                banner_status = '$banner_status' 
                                WHERE id = '$id_edit' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=banner&file=banner_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    if ($_FILES['fileUpload']['name'] != '') {
        $id_max01 = $id_edit;

        $fileUpload = $_FILES['fileUpload']['tmp_name'];
        $fileUpload_name = $_FILES['fileUpload']['name'];
        $fileUpload_size = $_FILES['fileUpload']['size'];
        $fileUpload_type = $_FILES['fileUpload']['type'];

        $ext = strtolower(end(explode('.', $fileUpload_name)));
        if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif' or $ext == 'webp') {
            $id_max_banner = $id_max01;
            $day_file_banner = date('ymd');
            $time_file_banner = date('His');
            $filename = 'banner-' . $id_max_banner . '-' . $day_file_banner . $time_file_banner . '.' . $ext;
            if ($ext == 'jpg') {
                $src = $_FILES['fileUpload']['tmp_name'];
                $dst = "../images/banner/" . $filename;
                $upload = move_uploaded_file($src, $dst);
            } elseif ($ext == 'jpeg') {
                $src = $_FILES['fileUpload']['tmp_name'];
                $dst = "../images/banner/" . $filename;
                $upload = move_uploaded_file($src, $dst);
            } elseif ($ext == 'png') {
                $src = $_FILES['fileUpload']['tmp_name'];
                $dst = "../images/banner/" . $filename;
                $upload = move_uploaded_file($src, $dst);
            } elseif ($ext == 'gif') {
                $src = $_FILES['fileUpload']['tmp_name'];
                $dst = "../images/banner/" . $filename;
                $upload = move_uploaded_file($src, $dst);
            } elseif ($ext == 'webp') {
                $src = $_FILES['fileUpload']['tmp_name'];
                $dst = "../images/banner/" . $filename;
                $upload = move_uploaded_file($src, $dst);
            }
            $sql_update_im = " UPDATE banner SET banner_image = '$filename' WHERE id = '$id_max_banner' ";
            $result_update_im = mysqli_query($conn, $sql_update_im);
        }
    }
}

if (isset($_GET['del_id'])) {

    $id_dels = $_GET['del_id'];

    $sql_delim = " SELECT * FROM banner WHERE id = $id_dels ";
    $result_delim = mysqli_query($conn, $sql_delim);
    $rs_delim = mysqli_fetch_assoc($result_delim);

    if ($rs_delim['banner_image'] != "") {
        $fileuploader = $rs_delim['banner_image'];
        unlink("../images/banner/$fileuploader");
    }

    $sql_dels = " UPDATE banner SET
                                    banner_image = ''
                                    WHERE id = $id_dels ";
    $result_dels = mysqli_query($conn, $sql_dels);

    if ($result_dels) {
        header("Location:index.php?mn=banner&file=banner_edit&edit_id=$id_dels");
        echo "<script>del_imgsuccess();</script>";
    } else {
        header("Location:index.php?mn=banner&file=banner_edit&edit_id=$id_dels");
        echo "<script>del_imgfails();</script>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">แก้ไขโฆษณา</h3>
        </div>
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM banner WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        $ids_edit = $rs_edit['id'];
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="banner_title">ชื่อโฆษณา</label>
                    <input type="text" class="form-control" name="banner_title" value="<?= $rs_edit['banner_title'] ?>" id="banner_title" placeholder="ชื่อโฆษณา">
                </div>
                <div class="form-group">
                    <?php
                    $filename = '../images/banner/' . $rs_edit['banner_image'];
                    $img_upload = $rs_edit['banner_image'];
                    $img_links = "index.php?mn=banner&file=banner_edit&edit_id=$ids_edit&del_id=$ids_edit";
                    ?>
                    <?php if ($rs_edit['banner_image'] == "") { ?>
                        <label for="file_upload">รูปภาพ</label>
                        <input class="file-3" id="file_upload" type="file" name="fileUpload" accept="image/*">
                    <?php } else { ?>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li>
                                <span class="mailbox-attachment-icon has-img mb-3"><i class="fas fa-image fa fa-2x"></i></span>
                                <div class="mailbox-attachment-info">
                                    <a href="javascript:;" class="mailbox-attachment-name" data-fancybox="single" data-src="<?= $filename ?>" data-caption="<?= $rs_edit['banner_title'] ?>"><i class="fas fa-camera"></i> รูปภาพ</a>
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
                    <label for="banner_link">Link เว็บไซต์</label>
                    <input type="text" name="banner_link" id="banner_link" class="form-control" value="<?= $rs_edit['banner_link'] ?>" placeholder="https://www.google.com">
                </div>
                <?php if ($rs_edit['banner_detail'] != "") { ?>
                    <?php $banner_descript_show = ""; ?>
                <?php  } else { ?>
                    <?php $banner_descript_show = "d-none"; ?>
                <?php } ?>

                <div class="form-group <?= $banner_descript_show ?>" id="banner-detail">
                    <label for="summernote">รายละเอียด</label>
                    <textarea name="banner_detail" id="summernote" rows="5" class="form-control"><?= $rs_edit['banner_detail'] ?></textarea>
                </div>
                <div class="form-group">
                    <?php
                    if ($rs_edit['banner_status'] == "เปิด") {
                        $ad1 = "selected";
                    }
                    if ($rs_edit['banner_status'] == "ปิด") {
                        $ad2 = "selected";
                    }
                    ?>
                    <label for="banner_status">สถานะ</label>
                    <select class="form-control select2bs4" name="banner_status" id="banner_status">
                        <option disabled>เลือกสถานะ</option>
                        <option value="1" <?= $ad1 ?>>เปิด</option>
                        <option value="2" <?= $ad2 ?>>ปิด</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id_edit" value="<?= $ids_edit ?>">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>