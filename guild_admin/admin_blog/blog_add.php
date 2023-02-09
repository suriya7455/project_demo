<?php
// include composer autoload
require_once 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (isset($_POST['submit'])) {
    $blog_type_id = $_POST['blog_type_id'];
    $author_id = $_POST['author_id'];
    $blog_title = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $blog_content = mysqli_real_escape_string($conn, $_POST['blog_content']);
    $my_tags = $_POST['tags_id'];
    $blog_status = $_POST['blog_status'];

    $sql = " INSERT INTO blog SET
                                blog_type_id = $blog_type_id,
                                blog_title = '$blog_title',
                                blog_content = '$blog_content',
                                blog_view = 0,
                                author_id = $author_id,
                                blog_status = '$blog_status' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=blog&file=blog_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    // Upload Tags 
    if ($my_tags[0] != '') {
        for ($i = 0; count($my_tags) > $i; $i++) {
            $sql_max = 'SELECT MAX(id) AS max_id FROM blog';
            $result_max = mysqli_query($conn, $sql_max);
            $r_max = mysqli_fetch_assoc($result_max);
            $id_max01 = $r_max['max_id'];
            $id_tags = $my_tags[$i];
            $sql_tags = " INSERT INTO tags_detail VALUES(NULL,'$id_max01','$id_tags') ";
            $result_tags = mysqli_query($conn, $sql_tags);
        }
    }

    // อัพโหลดรูปภาพเอกสารของลูกค้า
    if ($_FILES['fileUpload']['name'][0] != '') {
        $sql_max = 'SELECT MAX(id) AS max_id FROM blog';
        $result_max = mysqli_query($conn, $sql_max);
        $r_max = mysqli_fetch_assoc($result_max);
        $id_max01 = $r_max['max_id'];
        for ($i = 0; $i < count($_FILES['fileUpload']['name']); ++$i) {
            $sql_fileUpload = " INSERT INTO images_blog VALUES(NULL,$id_max01,'') ";
            $result_fileUpload = mysqli_query($conn, $sql_fileUpload);
            $fileUpload = $_FILES['fileUpload']['tmp_name'][$i];
            $fileUpload_name = $_FILES['fileUpload']['name'][$i];
            $fileUpload_size = $_FILES['fileUpload']['size'][$i];
            $fileUpload_type = $_FILES['fileUpload']['type'][$i];

            $ext = strtolower(end(explode('.', $fileUpload_name)));
            if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif' or $ext == 'webp') {
                $sql_select_max_blog = " SELECT MAX(id) AS max_id FROM images_blog ";
                $result_max_blog = mysqli_query($conn, $sql_select_max_blog);
                $rs_max_blog = mysqli_fetch_assoc($result_max_blog);
                $id_max_blog = $rs_max_blog['max_id'];
                $day_file_blog = date('ymd');
                $time_file_blog = date('His');
                $filename = 'blog' . $id_max_blog . '-' . $day_file_blog . $time_file_blog . '.' . $ext;
                if ($ext == 'jpg') {
                    // สร้างไฟล์ thumbnail จากไฟล์ต้นฉบับ จำนวน 2 ขนาด
                    $manager->make($_FILES['fileUpload']['tmp_name'][$i])
                        ->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save('../images/blog/' . $filename);
                } elseif ($ext == 'jpeg') {

                    $manager->make($_FILES['fileUpload']['tmp_name'][$i])
                        ->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save('../images/blog/' . $filename);
                } elseif ($ext == 'png') {

                    $manager->make($_FILES['fileUpload']['tmp_name'][$i])
                        ->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save('../images/blog/' . $filename);
                } elseif ($ext == 'gif') {

                    $manager->make($_FILES['fileUpload']['tmp_name'][$i])
                        ->resize(850, null, function ($constraint) {
                            $constraint->aspectRatio();
                        })
                        ->save('../images/blog/' . $filename);
                } elseif ($ext == 'webp') {
                    $filename = 'blog' . $id_max_blog . '-' . $day_file_blog . $time_file_blog . '.jpeg';
                    $im = imagecreatefromwebp($fileUpload);
                    imagejpeg($im, '../images/blog/' . $filename, 100);
                    imagedestroy($im);
                }

                $sql_update_im = " UPDATE images_blog SET imagesupload = '$filename' WHERE id = '$id_max_blog' ";
                $result_update_im = mysqli_query($conn, $sql_update_im);
            }
        }
    }
    // สิ้นสุดการอัพโหลดรูปภาพเอกสารของลูกค้า
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">เพิ่มบทความ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="blog_title">ชื่อเรื่อง</label>
                    <input type="text" class="form-control" name="blog_title" id="blog_title" placeholder="ชื่อเรื่อง">
                </div>
                <div class="form-group">
                    <label for="blog_type_id">ประเภทบทความ</label>
                    <select class="form-control select2bs4" name="blog_type_id" id="blog_type_id">
                        <option disabled>เลือกประเภทบทความ</option>
                        <?php $sql_subtype = " SELECT * FROM blog_type ORDER BY CONVERT(blog_type_name USING tis620) ASC ";
                        $result_subtype = mysqli_query($conn, $sql_subtype);
                        while ($rs_subtype = mysqli_fetch_assoc($result_subtype)) {
                        ?>
                            <option value=" <?= $rs_subtype['id'] ?>"><?= $rs_subtype['blog_type_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="author_id">ผู้แต่ง</label>
                    <select class="form-control select2bs4" name="author_id" id="author_id">
                        <option disabled>เลือกผู้แต่ง</option>
                        <?php $sql_subauthor = " SELECT * FROM author ORDER BY CONVERT(author_name USING tis620) ASC ";
                        $result_subauthor = mysqli_query($conn, $sql_subauthor);
                        while ($rs_subauthor = mysqli_fetch_assoc($result_subauthor)) {
                        ?>
                            <option value=" <?= $rs_subauthor['id'] ?>"><?= $rs_subauthor['author_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tags_id">ป้ายกำกับ</label>
                    <select class="form-control select2bs4" name="tags_id[]" id="tags_id" multiple="multiple">
                        <option disabled>เลือกป้ายกำกับ</option>
                        <?php $sql_subtags = " SELECT * FROM tags ORDER BY CONVERT(tags_name USING tis620) ASC ";
                        $result_subtags = mysqli_query($conn, $sql_subtags);
                        while ($rs_subtags = mysqli_fetch_assoc($result_subtags)) {
                        ?>
                            <option value=" <?= $rs_subtags['id'] ?>"><?= $rs_subtags['tags_name'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="file_upload">รูปภาพ</label>
                    <input class="file-3" id="file_upload" type="file" name="fileUpload[]" accept="image/*">
                </div>
                <div class="form-group">
                    <label for="summernote">เนื้อหา</label>
                    <textarea class="form-control" id="summernote" name="blog_content"></textarea>
                </div>
                <div class="form-group">
                    <label for="blog_status">สถานะ</label>
                    <select class="form-control select2bs4" name="blog_status" id="blog_status">
                        <option disabled>เลือกสถานะ</option>
                        <option value="YES">เปิด</option>
                        <option value="NO">ปิด</option>
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