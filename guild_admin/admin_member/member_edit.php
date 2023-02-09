<?php
if (isset($_POST['submit'])) {
    $edit_id = $_POST['edit_id'];
    $member_email = mysqli_real_escape_string($conn, $_POST['member_email']); // รับค่า full_name
    $member_username = mysqli_real_escape_string($conn, $_POST['member_username']); // รับค่า username
    $sql_users = " UPDATE member SET 
                                        member_email = '$member_email',
                                        member_username = '$member_username'
                                        WHERE id = $edit_id ";
    $result_users = mysqli_query($conn, $sql_users);
    if ($result_users) {
        header("Location:index.php?mn=member&file=member_list");
    } else {
        $msg = "<div class=\"alert alert-danger\">ไม่สามารถแก้ไขข้อมูลได้</div>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <?php
    $edit_id = $_GET['edit_id'];
    $sql = " SELECT * FROM member WHERE id = '$edit_id' ";
    $result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($result);
    ?>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">แก้ไขผู้ใช้งาน</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="" enctype="multipart/form-data">
            <div class="card-body">
                <div class="form-group">
                    <label for="member_email">อีเมล</label>
                    <input type="text" class="form-control" name="member_email" id="member_email" placeholder="อีเมล" value="<?= $rs['member_email'] ?>">
                </div>
                <div class="form-group">
                    <label for="member_username">ชื่อผู้ใช้งาน</label>
                    <input type="text" class="form-control" name="member_username" id="member_username" placeholder="ชื่อผู้ใช้งาน" value="<?= $rs['member_username'] ?>">
                </div>
                <div class="form-group">
                    <label for="member_status">สถานะ</label>
                    <div class="pt-1"><?= $rs['member_status'] ?></div>
                </div>
                <div class="form-group">
                    <label for="member_created">วันที่ลงทะเบียน</label>
                    <div class="pt-1"><?= DateThaiFull($rs['member_created']) ?></div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <input type="hidden" name="edit_id" value="<?= $rs['id'] ?>">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>