<?php

if (isset($_POST['submit'])) {
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
            } elseif ($ext == 'jpeg') {
            } elseif ($ext == 'png') {
            } elseif ($ext == 'gif') {
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
            <h3 class="card-title">เพิ่มภาพพื้นหลังบันทึกแห่งเกียรติยศ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="position_hall">ตำแหน่งการแสดงผล</label>
                    <select name="position_hall" id="position_hall" class="form-control">
                        <option value="1">หน้าแรก</option>
                        <option value="2">หน้า GuildBoard</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fileUpload">รูปภาพ</label>
                    <input class="file-3" id="fileUpload" type="file" name="fileUpload" accept="image/*">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-plus"></i> บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>