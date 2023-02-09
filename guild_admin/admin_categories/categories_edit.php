<?php
if (isset($_POST['submit'])) {
    $id_edit  = $_POST['id_edit'];
    $categories_name = $_POST['categories_name'];
    $categories_status = $_POST['categories_status'];
    $sql = " UPDATE categories SET
                    categories_status = '$categories_status',
                    categories_name='$categories_name' 
                    WHERE id = '$id_edit'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>แก้ไขข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=categories&file=categories_list');
    } else {
        $msg = "<div class='alert alert-danger'>แก้ไขข้อมูลล้มเหลว</div>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">แก้ไขภารกิจ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM categories WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);

        if ($rs_edit['categories_status'] == 'Online') {
            $ac_online  = 'selected';
        }
        if ($rs_edit['categories_status'] == 'Offline') {
            $ac_offline = 'selected';
        }
        ?>
        <form method="post" action="">
            <div class="card-body">
                <?php ?>
                <div class="form-group">
                    <label for="categories_status">เลือกสถานะภารกิจ</label>
                    <select name="categories_status" id="categories_status" class="form-control select2bs4">
                        <option value="1" <?= $ac_offline ?>>Offline</option>
                        <option value="2" <?= $ac_online ?>>Online</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="categories_name">ภารกิจ</label>
                    <input type="text" class="form-control" name="categories_name" id="categories_name" value="<?= $rs_edit['categories_name'] ?>" placeholder="ภารกิจ" required>
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