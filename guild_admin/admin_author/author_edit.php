<?php
if (isset($_POST['submit'])) {
    $id_edit  = $_POST['id_edit'];
    $author_code = $_POST['author_code'];
    $author_name = $_POST['author_name'];
    $sql = " UPDATE author SET
                    author_name='$author_name' 
                    WHERE id = '$id_edit'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>แก้ไขข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=author&file=author_list');
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
            <h3 class="card-title">แก้ไขผู้แต่ง</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        $id_edit = $_GET['edit_id'];
        $sql_edit = " SELECT * FROM author WHERE id = '$id_edit' ";
        $result_edit = mysqli_query($conn, $sql_edit);
        $rs_edit = mysqli_fetch_assoc($result_edit);
        ?>
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="author_name">ผู้แต่ง</label>
                    <input type="text" class="form-control" name="author_name" id="author_name" value="<?= $rs_edit['author_name'] ?>" placeholder="ผู้แต่ง" required>
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