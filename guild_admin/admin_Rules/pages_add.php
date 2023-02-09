<?php
if (isset($_POST['submit'])) {
    $pages_name = $_POST['pages_name'];
    $pages_content = $_POST['pages_content'];
    $sql = " INSERT INTO pages SET
                        id = NULL,
                        pages_name = '$pages_name',
                        pages_content = '$pages_content',
                        pages_type = 2 ";;
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=Rules&file=pages_list');
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
            <h3 class="card-title">เพิ่มหน้า</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="pages_name">ชื่อหน้าเมนู</label>
                    <input type="text" class="form-control" name="pages_name" id="pages_name">
                </div>
                <div class="form-group">
                    <label for="summernote">รายละเอียด</label>
                    <textarea class="form-control" id="summernote" name="pages_content"></textarea>
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