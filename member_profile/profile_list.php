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
            <h4 class="text-light">ข้อมูลโปรไฟล์</h4>
            <hr class="bg-white">
            <div class="form-horizontal mt-3">
                <div class="form-group row">
                    <label for="member_username" class="col-sm-2 col-form-label text-light">ชื่อผู้ใช้</label>
                    <div class="col-sm-10">
                        <div class="text-light pt-2">
                            <?= $rs['member_username'] ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="member_email" class="col-sm-2 col-form-label text-light">อีเมล</label>
                    <div class="col-sm-10">
                        <div class="text-light pt-2">
                            <?= $rs['member_email'] ?>
                        </div>
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
            </div>
        </div>
    </div>
</div>