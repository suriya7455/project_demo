<?php
if (isset($_POST['submit'])) {
    $old_password = md5(mysqli_real_escape_string($conn, $_POST['old_password']));
    $new_password = md5(mysqli_real_escape_string($conn, $_POST['new_password']));
    $new_password2 = md5(mysqli_real_escape_string($conn, $_POST['new_password2']));

    $sql_check_user = " SELECT member_password FROM member WHERE member_password = '$old_password' ";
    $result_check_user = mysqli_query($conn, $sql_check_user);
    $num_check_user = mysqli_num_rows($result_check_user);
    if ($num_check_user == 0) {
        $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>รหัสผ่านเดิมไม่ถูกต้อง!</strong> กรุณากรอกรหัสผ่านเดิมให้ถูกต้อง
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }
    if ($new_password != $new_password2) {
        $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>รหัสผ่านใหม่ไม่ตรงกัน!</strong> กรุณากรอกรหัสผ่านใหม่กับยืนยันรหัสผ่านให้ตรงกัน
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }

    if ($num_check_user > 0 && $new_password == $new_password2) {
        $sql_update_member = " UPDATE member SET 
                                    member_password = '$new_password'
                                    WHERE id = '$profiles_id' ";
        $result_update_member = mysqli_query($conn, $sql_update_member);
        if ($result_update_member) {
            $msg = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>บันทึกข้อมูลสำเร็จ</strong> กรณีเมื่อเปลี่ยนรหัสผ่านใหม่ ต้องใช้รหัสผ่านใหม่ในการเข้าสู่ระบบ
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
        }
    }
}
?>
<?php
$view_id = $profiles_id;
$sql = " SELECT * FROM member WHERE id = '$view_id' ";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-2">
            <?php require 'layout/left-profile.php'; ?>
        </div>
        <div class="col-md-9 mb-2">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <h4 class="text-light">ข้อมูลโปรไฟล์</h4>
            <hr class="bg-white">
            <form class="form-horizontal mt-3" action="" method="POST">
                <div class="form-group row">
                    <label for="old_password" class="col-sm-3 col-form-label text-light">รหัสผ่านเดิม</label>
                    <div class="col-sm-9">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="กรอกรหัสผ่านเดิม" aria-label="กรอกรหัสผ่านเดิม" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark text-light" type="button" id="button-addon1"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="bg-light">
                <div class="form-group row">
                    <label for="new_password" class="col-sm-3 col-form-label text-light">รหัสผ่านใหม่</label>
                    <div class="col-sm-9">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="กรอกรหัสผ่านใหม่" aria-label="กรอกรหัสผ่านใหม่" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark text-light" type="button" id="button-addon2"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="new_password2" class="col-sm-3 col-form-label text-light">ยืนยันรหัสผ่านใหม่</label>
                    <div class="col-sm-9">
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="ยืนยันรหัสผ่านใหม่" aria-label="ยืนยันรหัสผ่านใหม่" aria-describedby="button-addon3">
                            <div class="input-group-append">
                                <button class="btn btn-outline-dark text-light" type="button" id="button-addon3"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" name="submit" class="btn btn-lg btn-block btn-success"><i class="far fa-check-circle"></i> บันทึก</button>
                    </div>
                    <div class="col-md-6">
                        <button type="reset" name="reset" class="btn btn-lg btn-block btn-warning"><i class="fas fa-redo"></i> รีเซ็ท</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>