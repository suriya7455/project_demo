<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-2">
            <?php require 'layout/left-profile.php'; ?>
        </div>
        <?php
        if (!empty($_GET['id'])) {
            $quest_id = $_GET['id'];
            $sql_q_active_check = " SELECT quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
                        FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
                        WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 2 AND quest.quest_status = 2 ";
            $result_q_active_check = mysqli_query($conn, $sql_q_active_check);
            $num_q_active_check = mysqli_num_rows($result_q_active_check);

            $sql_quest_check_human = " SELECT COUNT(quest_activity_detail.member_id) AS 'count_human' FROM quest INNER JOIN quest_activity_detail ON quest.id = quest_activity_detail.quest_id WHERE quest.id = '$quest_id' AND quest_activity_detail.activety_status = 2 ";
            $result_quest_check_human = mysqli_query($conn, $sql_quest_check_human);
            $rs_quest_check_human = mysqli_fetch_assoc($result_quest_check_human);

            $sql_hm_quest = " SELECT quest_human,quest_human_more FROM quest WHERE id = '$quest_id' ";
            $result_hm_quest = mysqli_query($conn, $sql_hm_quest);
            $rs_hm_quest = mysqli_fetch_assoc($result_hm_quest);
            if ($rs_hm_quest['quest_human'] == 'นักผจญภัย 1 คน') {
                $hm_get_quest = 1;
            }
            if ($rs_hm_quest['quest_human'] == 'นักผจญภัย มากกว่า 1 คน') {
                $hm_get_quest = $rs_hm_quest['quest_human_more'];
            }

            if ($rs_quest_check_human['count_human'] < $hm_get_quest) {

                if ($num_q_active_check == 0) {
                    $sql_get_q = " INSERT INTO quest_activity_detail SET
                                                                id = NULL,
                                                                quest_id = '$quest_id',
                                                                member_id = '$profiles_id',
                                                                guest_name = NULL,
                                                                guest_password = NULL,
                                                                guest_ip = NULL,
                                                                activety_status = 2,
                                                                quest_atv_created = CURRENT_TIMESTAMP
            ";
                    $result_get_q = mysqli_query($conn, $sql_get_q);
                    if ($result_get_q) {
                        $sql_up_status_quest = "UPDATE quest SET quest_status = 2 WHERE id = $quest_id";
                        mysqli_query($conn, $sql_up_status_quest);
                        header('location:member_guild.php?mn=quest&file=quest_active');
                    }
                } else {
                    $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>ไม่สามารถรับภารกิจได้</strong> เนื่องจากคุณรับภารกิจไปแล้ว ต้องทำให้เสร็จก่อนถึงรับภารกิจเพิ่มได้
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
                }
            } else {
                $msg = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
        <strong>ไม่สามารถรับภารกิจได้</strong> เนื่องจำนวนนักผจญภัยเต็มแล้ว
        <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
        </button>
    </div>";
            }
        }
        ?>
        <div class="col-md-9 mb-2">
            <?php
            if (!empty($msg)) {
                echo $msg;
            }
            ?>
            <h4 class="text-light">Active Quest</h4>
            <hr class="bg-white">
            <div class="table-responsive text-light">
                <table class="table table-striped text-nowrap text-light" id="quest-active-table">
                    <thead>
                        <tr>
                            <th class="align-middle">#</th>
                            <th class="align-middle">ชื่อแสดงในระบบ</th>
                            <th class="align-middle">วันที่รับภารกิจ</th>
                            <th class="align-middle">วันที่สิ้นสุดภารกิจ</th>
                            <th class="align-middle">เวลาทำภารกิจ</th>
                            <th class="align-middle">วันคงเหลือ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_q_active = " SELECT quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
                        FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
                        WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 2 AND quest.quest_status = 2 ";
                        $result_q_active = mysqli_query($conn, $sql_q_active);
                        $num_q_active = mysqli_num_rows($result_q_active);
                        $no = 1;
                        while ($rs_q_active = mysqli_fetch_assoc($result_q_active)) {
                            $id_q_active = $rs_q_active['id'];
                            $name_q_active = $rs_q_active['username'];
                        ?>
                            <tr>
                                <td class="align-middle"><?= $no ?></td>
                                <td class="align-middle"><a href="quest-detail.php?id=<?= $rs_q_active['quest_id'] ?>"><?= $rs_q_active['quest_name'] ?></a></td>
                                <td class="align-middle"><?= DateTh($rs_q_active['quest_atv_created']) ?></td>
                                <td class="align-middle">
                                    <?php if ($rs_q_active['quest_duration_day'] != "") {
                                        $days_q = $rs_q_active['quest_duration_day'];
                                        $days_s = $rs_q_active['quest_atv_created'];
                                    ?>
                                        <?= DateTh(addDayswithdate($days_s, $days_q)) ?>
                                    <?php } else { ?>
                                        ไม่จำกัดระยะเวลา
                                    <?php } ?>
                                </td>
                                <td class="align-middle"><?= $rs_q_active['quest_duration_day'] ?></td>
                                <td class="align-middle text-center">
                                    <?php if ($rs_q_active['quest_duration_day'] != "") {
                                        $days_q = $rs_q_active['quest_duration_day'];
                                        $days_s = $rs_q_active['quest_atv_created'];
                                        $days_duration = addDayswithdate($days_s, $days_q);
                                        $sql_datediff = " SELECT DATEDIFF(day, '$days_s', '$days_duration') AS DateDiff ";
                                        $result_datediff = mysqli_query($conn, $sql_datediff);
                                        $rs_datediff = mysqli_fetch_assoc($result_datediff);


                                        $date1 = date_create($days_s);
                                        $date2 = date_create($days_duration);
                                        $diff = date_diff($date1, $date2);
                                        if ($diff > 0) {
                                            echo $diff->format("%R%a วัน");
                                        } else {
                                            echo "ครบกำหนด";
                                        }
                                    ?>
                                    <?php } else { ?>
                                        ไม่จำกัดระยะเวลา
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>