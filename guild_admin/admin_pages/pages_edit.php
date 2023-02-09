<?php
if (isset($_POST['submit'])) {
    $id_edit = $_POST['id_edit'];
    $pages_name = $_POST['pages_name'];
    $pages_content = $_POST['pages_content'];
    $sql = " UPDATE pages SET 
                            pages_name = '$pages_name',
                            pages_content = '$pages_content'
                            WHERE id = '$id_edit' ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=pages&file=pages_list');
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
            <h3 class="card-title">แก้ไขหน้า</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM pages WHERE id = $id_edit ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        $ids_edit = $rs_edit['id'];
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="pages_name">ชื่อหน้าเมนู</label>
                    <input type="text" class="form-control" name="pages_name" id="pages_name" value="<?= $rs_edit['pages_name'] ?>">
                </div>
                <div class="form-group">
                    <label for="summernote">รายละเอียด</label>
                    <textarea class="form-control" id="summernote" name="pages_content"><?= $rs_edit['pages_content'] ?></textarea>
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