<div class="text-center">
    <i class="far fa-user-circle fa-4x text-light"></i>
</div>
<h3 class="profile-username text-center text-light"><?= $rs['member_username'] ?></h3>

<p class="text-muted text-center"><?= $rs['mobilenumber'] ?></p>
<ul class="list-group list-group-unbordered mb-3">
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
<a href="member_guild.php" class="btn btn-block btn-secondary"><i class="fas fa-scroll"></i> Dashboard</a>
<a href="member_guild.php?mn=quest&file=quest_active" class="btn btn-block btn-dark"><i class="fas fa-scroll"></i> Active Quest</a>
<a href="member_guild.php?mn=quest&file=quest_complete" class="btn btn-block btn-success"><i class="fas fa-check-circle"></i> Complete Quest</a>
<a href="member_guild.php?mn=profile&file=profile_list" class="btn btn-block btn-info"><i class="fas fa-user"></i> โปรไฟล์</a>
<a href="member_guild.php?mn=profile&file=profile_edit" class="btn btn-block btn-primary"><i class="fas fa-user-edit"></i> แก้ไขโปรไฟล์</a>
<a href="member_guild.php?mn=profile&file=profile_change" class="btn btn-block btn-warning"><i class="fas fa-user-lock"></i> เปลี่ยนรหัสผ่าน</a>
<button class="btn btn-block btn-danger" onclick="logouts('logout.php')"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</button>