<?php
if (isset($_POST['submit'])) {
    $id_edit  = $_POST['id_edit'];
    $blog_type_name = $_POST['blog_type_name'];
    $sql = " UPDATE blog_type SET
                    blog_type_name='$blog_type_name' 
                    WHERE id = '$id_edit'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>แก้ไขข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=blog_type&file=blog_type_list');
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
            <h3 class="card-title">แก้ไขประเภทบทความ</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM blog_type WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        ?>
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="blog_type_name">ประเภทบทความ</label>
                    <input type="text" class="form-control" name="blog_type_name" id="blog_type_name" value="<?= $rs_edit['blog_type_name'] ?>" placeholder="ประเภทวิชา" required>
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