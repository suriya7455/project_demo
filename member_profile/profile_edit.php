<?php
if (isset($_POST['submit'])) {
    $member_username = $_POST['member_username'];
    $member_email = $_POST['member_email'];

    $sql_check_user = " SELECT member_username FROM member WHERE id <> '$profiles_id' AND member_username = '$member_username' ";
    $result_check_user = mysqli_query($conn, $sql_check_user);
    $num_check_user = mysqli_num_rows($result_check_user);
    if ($num_check_user > 0) {
        $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>ชื่อผู้ใช้ซ้ำ!</strong> ชื่อผู้ใช้นี้ถูกใช้งานแล้วในระบบ
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }

    $sql_check_email = " SELECT member_email FROM member WHERE id <> '$profiles_id' AND member_email = '$member_email' ";
    $result_check_email = mysqli_query($conn, $sql_check_email);
    $num_check_email = mysqli_num_rows($result_check_email);
    if ($num_check_email > 0) {
        $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>อีเมลซ้ำ!</strong> อีเมลนี้ถูกใช้งานแล้วในระบบ
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
    }
    if ($num_check_email == 0 && $num_check_user == 0) {
        $sql_update_member = " UPDATE member SET 
                                    member_email = '$member_email',
                                    member_username = '$member_username'
                                    WHERE id = '$profiles_id' ";
        $result_update_member = mysqli_query($conn, $sql_update_member);
        if ($result_update_member) {
            $_SESSION['guild_member'] = $member_username;
            $msg = "<div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        <strong>บันทึกข้อมูลสำเร็จ</strong> กรณีเปลี่ยนชื่อผู้ใช้ใหม่ ต้องใช้ชื่อผู้ใช้ใหม่ในการเข้าสู่ระบบ
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
                    <label for="member_username" class="col-sm-2 col-form-label text-light">ชื่อผู้ใช้</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="member_username" name="member_username" value="<?= $rs['member_username'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_email" class="col-sm-2 col-form-label text-light">อีเมล</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="member_email" name="member_email" value="<?= $rs['member_email'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_updated" class="col-sm-2 col-form-label text-light">แก้ไขล่าสุด</label>
                    <div class="col-sm-10">
                        <div class="text-light pt-2">
                            <?= guildDate($rs['member_updated']) ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_created" class="col-sm-2 col-form-label text-light">วันที่ลงทะเบียน</label>
                    <div class="col-sm-10">
                        <div class="text-light pt-2">
                            <?= guildDate($rs['member_created']) ?>
                        </div>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-lg btn-block btn-primary"><i class="far fa-check-circle"></i> บันทึก</button>
            </form>
        </div>
    </div>
</div>