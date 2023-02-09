<?php
if (isset($_POST['submit'])) {
    $author_name = $_POST['author_name'];
    $sql = "INSERT INTO author SET
                    author_name='$author_name' ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=author&file=author_list');
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
            <h3 class="card-title">เพิ่มผู้แต่ง</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="author_name">ผู้แต่ง</label>
                    <input type="text" class="form-control" name="author_name" id="author_name" placeholder="ผู้แต่ง" required>
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