<?php
if (isset($_POST['submit'])) {
    $categories_name = $_POST['categories_name'];
    $categories_status = $_POST['categories_status'];
    $sql = " INSERT INTO categories SET
                    categories_status = '$categories_status',
                    categories_name='$categories_name' ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=categories&file=categories_list');
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
            <h3 class="card-title">เพิ่มภารกิจ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="categories_status">เลือกสถานะภารกิจ</label>
                    <select name="categories_status" id="categories_status" class="form-control select2bs4">
                        <option value="2">Online</option>
                        <option value="1">Offline</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categories_name">ประเภทของภารกิจ</label>
                    <input type="text" class="form-control" name="categories_name" id="categories_name" placeholder="ภารกิจ" required>
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