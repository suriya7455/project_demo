<?php
if (isset($_POST['submit'])) {
    $banner_title = $_POST['banner_title'];
    $banner_link = $_POST['banner_link'];
    $banner_status = $_POST['banner_status'];

    $sql = " INSERT INTO banner SET
                                id = NULL,
                                banner_title = '$banner_title',
                                banner_link = '$banner_link',
                                banner_image = '',
                                banner_num = 0,
                                banner_count = 0,
                                banner_status = '$banner_status' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=banner&file=banner_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    if ($_FILES['fileUpload']['name'] != '') {
        $sql_max = 'SELECT MAX(id) AS max_id FROM banner';
        $result_max = mysqli_query($conn, $sql_max);
        $r_max = mysqli_fetch_assoc($result_max);
        $id_max01 = $r_max['max_id'];

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
?>
<div class="col-md-12">
    <?php if (isset($msg)) {
        echo $msg;
    } ?>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">เพิ่มโฆษณา</h3>
        </div>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="banner_title">ชื่อโฆษณา</label>
                    <input type="text" class="form-control" name="banner_title" id="banner_title" placeholder="ชื่อโฆษณา">
                </div>
                <div class="form-group">
                    <label for="fileUpload">รูปภาพ</label>
                    <input class="file-3" id="fileUpload" type="file" name="fileUpload" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="banner_link">Link เว็บไซต์</label>
                    <input type="text" name="banner_link" id="banner_link" class="form-control" placeholder="https://www.google.com">
                </div>
                <div class="form-group">
                    <label for="banner_status">สถานะ</label>
                    <select class="form-control select2bs4" name="banner_status" id="banner_status">
                        <option disabled>เลือกสถานะ</option>
                        <option value="1">เปิด</option>
                        <option value="2">ปิด</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
</div>