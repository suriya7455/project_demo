<?php
$view_id = $_GET['view_id'];
$profiles_id = $view_id;
$sql = " SELECT * FROM member WHERE id = '$view_id' ";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="far fa-user-circle fa-4x"></i>
                    </div>
                    <h3 class="profile-username text-center"><?= $rs['firstname'] ?>&nbsp;&nbsp;<?= $rs['lastname'] ?></h3>

                    <p class="text-muted text-center"><?= $rs['mobilenumber'] ?></p>

                    <?php
                    $sql_q_create = " SELECT quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
    FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
    WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 1 ";
                    $result_q_create = mysqli_query($conn, $sql_q_create);
                    $num_q_create = mysqli_num_rows($result_q_create);

                    $sql_q_active = " SELECT quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
    FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
    WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 2 ";
                    $result_q_active = mysqli_query($conn, $sql_q_active);
                    $num_q_active = mysqli_num_rows($result_q_active);

                    $sql_q_complete = " SELECT quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
    FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
    WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 2 AND quest.quest_status = 3 ";
                    $result_q_complete = mysqli_query($conn, $sql_q_complete);
                    $num_q_complete = mysqli_num_rows($result_q_complete);


                    ?>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>สร้างภารกิจ</b> <a class="float-right"><?= number_format($num_q_create) ?> ครั้ง</a>
                        </li>
                        <li class="list-group-item">
                            <b>ทำภารกิจ</b> <a class="float-right"><?= number_format($num_q_active) ?> ครั้ง</a>
                        </li>
                        <li class="list-group-item">
                            <b>สำเร็จภารกิจ</b> <a class="float-right"><?= number_format($num_q_complete) ?> ครั้ง</a>
                        </li>
                        <li class="list-group-item">
                            <b>รางวัลสะสม</b> <a class="float-right"><?= number_format($num_q_complete) ?> รายการ</a>
                        </li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">รายละเอียดผู้ใช้งาน</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <label for="member_email" class="col-sm-2 col-form-label">อีเมล</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="member_email" value="<?= $rs['member_email'] ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="member_username" class="col-sm-2 col-form-label">ชื่อผู้ใช้</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="member_username" value="<?= $rs['member_username'] ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="member_status" class="col-sm-2 col-form-label">สถานะ</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="member_status" value="<?= $rs['member_status'] ?>" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="member_created	" class="col-sm-2 col-form-label">วันที่ลงทะเบียน</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="member_created	" value="<?= DateThaiFull($rs['member_created']) ?>" readonly="true">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
</div>