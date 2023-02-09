<?php
if (isset($_POST['submit'])) {
    $tags_name = $_POST['tags_name'];
    $sql = "INSERT INTO tags SET
                    tags_name ='$tags_name' ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=tags&file=tags_list');
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
            <h3 class="card-title">เพิ่มป้ายกำกับ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="tags_name">ป้ายกำกับ</label>
                    <input type="text" class="form-control" name="tags_name" id="tags_name" placeholder="ประเภทวิชา" required>
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