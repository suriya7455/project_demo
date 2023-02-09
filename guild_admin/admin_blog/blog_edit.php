<?php
// include composer autoload
require_once 'vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

// สร้างตัวแปรอ้างอิง object ตัวจัดการรูปภาพ
$manager = new ImageManager();

if (isset($_POST['submit'])) {
    $id_edit = $_POST['id_edit'];
    $blog_type_id = $_POST['blog_type_id'];
    $author_id = $_POST['author_id'];
    $blog_title = mysqli_real_escape_string($conn, $_POST['blog_title']);
    $blog_content = mysqli_real_escape_string($conn, $_POST['blog_content']);
    $my_tags = $_POST['tags_id'];
    $blog_status = $_POST['blog_status'];

    $sql = " UPDATE blog SET
                                blog_type_id = $blog_type_id,
                                blog_title = '$blog_title',
                                blog_content = '$blog_content',
                                author_id = $author_id,
                                blog_status = '$blog_status'
                                WHERE id = '$id_edit' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=blog&file=blog_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }

    // Upload Tags 
    if ($my_tags[0] != '') {
        $sql_dtags = " DELETE FROM tags_detail WHERE blog_id = $id_edit ";
        $result_dtags = mysqli_query($conn, $sql_dtags);
        for ($i = 0; count($my_tags) > $i; $i++) {
            $id_max01 = $id_edit;
            $id_tags = $my_tags[$i];
            $sql_tags = " INSERT INTO tags_detail VALUES(NULL,'$id_max01','$id_tags') ";
            $result_tags = mysqli_query($conn, $sql_tags);
        }
    } else {
        $sql_dtags = " DELETE FROM tags_detail WHERE blog_id = $id_edit ";
        $result_dtags = mysqli_query($conn, $sql_dtags);
    }

    // อัพโหลดรูปภาพเอกสารของลูกค้า
    if ($_FILES['fileUpload']['name'][0] != '') {
        $id_max01 = $id_edit;
        for ($i = 0; $i < count($_FILES['fileUpload']['name']); ++$i) {
            $sql_fileUpload = " INSERT INTO images_blog VALUES(NULL,$id_max01,'') ";
            $result_fileUpload = mysqli_query($conn, $sql_fileUpload);
            $fileUpload = $_FILES['fileUpload']['tmp_name'][$i];
            $fileUpload_name = $_FILES['fileUpload']['name'][$i];
            $fileUpload_size = $_FILES['fileUpload']['size'][$i];
            $fileUpload_type = $_FILES['fileUpload']['type'][$i];

            $ext = strtolower(end(explode('.', $fileUpload_name)));
            if ($ext == 'jpg' or $ext == 'jpeg' or $ext == 'png' or $ext == 'gif' or $ext == 'webp') {
                $id_max_blog = $id_max01;
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

// Del images
if (isset($_GET['del_id'])) {

    $id_dels = $_GET['del_id'];

    $sql_delim = " SELECT * FROM images_blog WHERE ref_blog = $id_dels ";
    $result_delim = mysqli_query($conn, $sql_delim);
    $rs_delim = mysqli_fetch_assoc($result_delim);

    if ($rs_delim['imagesupload'] != "") {
        $fileuploader = $rs_delim['imagesupload'];
        unlink("../images/blog/$fileuploader");
    }

    $sql_dels = " UPDATE images_blog SET
                                    imagesupload = ''
                                    WHERE ref_blog = $id_dels ";
    $result_dels = mysqli_query($conn, $sql_dels);

    if ($result_dels) {
        header("Location:index.php?mn=blog&file=blog_edit&edit_id=$id_dels");
        echo "<script>del_imgsuccess();</script>";
    } else {
        header("Location:index.php?mn=blog&file=blog_edit&edit_id=$id_dels");
        echo "<script>del_imgfails();</script>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">แก้ไขบทความ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM blog WHERE id = $id_edit ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        $ids_edit = $rs_edit['id'];
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="blog_title">ชื่อเรื่อง</label>
                    <input type="text" class="form-control" name="blog_title" id="blog_title" value="<?= $rs_edit['blog_title'] ?>" placeholder="ชื่อเรื่อง">
                </div>
                <div class="form-group">
                    <label for="blog_type_id">ประเภทบทความ</label>
                    <select class="form-control select2bs4" name="blog_type_id" id="blog_type_id">
                        <option disabled>เลือกประเภทบทความ</option>
                        <?php $sql_subtype = " SELECT * FROM blog_type ORDER BY CONVERT(blog_type_name USING tis620) ASC ";
                        $result_subtype = mysqli_query($conn, $sql_subtype);
                        while ($rs_subtype = mysqli_fetch_assoc($result_subtype)) {
                        ?>
                            <?php if ($rs_edit['blog_type_id'] == $rs_subtype['id']) { ?>
                                <option value=" <?= $rs_subtype['id'] ?>" selected><?= $rs_subtype['blog_type_name'] ?></option>
                            <?php } else { ?>
                                <option value=" <?= $rs_subtype['id'] ?>"><?= $rs_subtype['blog_type_name'] ?></option>
                            <?php } ?>
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
                            <?php if ($rs_subauthor['id'] == $rs_edit['author_id']) { ?>
                                <option value=" <?= $rs_subauthor['id'] ?>" selected><?= $rs_subauthor['author_name'] ?></option>
                            <?php } else { ?>
                                <option value=" <?= $rs_subauthor['id'] ?>"><?= $rs_subauthor['author_name'] ?></option>
                            <?php } ?>
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
                            $ids_tags = $rs_subtags['id'];
                            $sql_tags_detail = " SELECT * FROM tags_detail WHERE blog_id = '$id_edit' AND tags_id = '$ids_tags' ";
                            $result_tags_detail = mysqli_query($conn, $sql_tags_detail);
                            $num_tags_detail = mysqli_num_rows($result_tags_detail);
                        ?>
                            <?php if ($num_tags_detail == 1) { ?>
                                <option value=" <?= $rs_subtags['id'] ?>" selected><?= $rs_subtags['tags_name'] ?></option>
                            <?php } else { ?>
                                <option value=" <?= $rs_subtags['id'] ?>"><?= $rs_subtags['tags_name'] ?></option>
                            <?php } ?>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <?php
                    $sql_images_blog = " SELECT * FROM images_blog WHERE ref_blog = " . $rs_edit['id'];
                    $result_images_blog = mysqli_query($conn, $sql_images_blog);
                    $rs_images_blog = mysqli_fetch_assoc($result_images_blog);
                    $filename = '../images/blog/' . $rs_images_blog['imagesupload'];
                    $img_upload = $rs_images_blog['imagesupload'];
                    $img_links = "index.php?mn=blog&file=blog_edit&edit_id=$ids_edit&del_id=$ids_edit";
                    ?>
                    <?php if ($rs_images_blog['imagesupload'] == "") { ?>
                        <label for="file_upload">รูปภาพ</label>
                        <input class="file-3" id="file_upload" type="file" name="fileUpload[]" accept="image/*">
                    <?php } else { ?>
                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                            <li>
                                <span class="mailbox-attachment-icon has-img"><img src="<?= $filename ?>" style="width:50%;" alt="Attachment"></span>
                                <div class="mailbox-attachment-info">
                                    <a href="javascript:;" class="mailbox-attachment-name" data-fancybox="single" data-src="<?= $filename ?>" data-caption="รูปภาพบทความ"><i class="fas fa-camera"></i> รูปภาพ</a>
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
                    <label for="summernote">เนื้อหา</label>
                    <textarea class="form-control" id="summernote" name="blog_content"><?= $rs_edit['blog_content'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="blog_status">สถานะ</label>
                    <select class="form-control select2bs4" name="blog_status" id="blog_status">
                        <option disabled>เลือกสถานะ</option>
                        <?php if ($rs_edit['blog_status'] == 'YES') { ?>
                            <option value="YES" selected>เปิด</option>
                        <?php } else { ?>
                            <option value="YES">เปิด</option>
                        <?php } ?>
                        <?php if ($rs_edit['blog_status'] == 'NO') { ?>
                            <option value="NO" selected>ปิด</option>
                        <?php } else { ?>
                            <option value="NO">ปิด</option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="hidden" name="id_edit" value="<?= $rs_edit['id'] ?>">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>