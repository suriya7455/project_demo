<?php
if (isset($_POST['submit'])) {
    $id_edit  = $_POST['id_edit'];
    $tags_name = $_POST['tags_name'];
    $sql = " UPDATE tags SET
                    tags_name='$tags_name' 
                    WHERE id = '$id_edit'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>แก้ไขข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=tags&file=tags_list');
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
            <h3 class="card-title">แก้ไขป้ายกำกับ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM tags WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        ?>
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="tags_name">ป้ายกำกับ</label>
                    <input type="text" class="form-control" name="tags_name" id="tags_name" value="<?= $rs_edit['tags_name'] ?>" placeholder="ประเภทวิชา" required>
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