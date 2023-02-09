<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-2">
            <?php require 'layout/left-profile.php'; ?>
        </div>
        <div class="col-md-9 mb-2">
            <section class="bg-secondary p-1 rounded mb-3">
                <h4 class="text-light">Assign Quest</h4>
                <hr class="bg-white">
                <div class="table-responsive text-light">
                    <table class="table table-striped text-nowrap text-light" id="quest-create-table">
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
                        WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 1 ";
                            $result_q_active = mysqli_query($conn, $sql_q_active);
                            $num_q_active = mysqli_num_rows($result_q_active);
                            $no = 1;
                            while ($rs_q_active = mysqli_fetch_assoc($result_q_active)) {
                                $id_q_active = $rs_q_active['id'];
                                $name_q_active = $rs_q_active['username'];
                            ?>
                                <tr>
                                    <td class="align-middle"><?= $no ?></td>
                                    <td class="align-middle"><a class="text-light" href="quest-detail.php?id=<?= $rs_q_active['quest_id'] ?>"><?= $rs_q_active['quest_name'] ?></a></td>
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
            </section>

            <section class="bg-dark p-1 rounded mb-3">
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
                                    <td class="align-middle"><a class="text-light" href="quest-detail.php?id=<?= $rs_q_active['quest_id'] ?>"><?= $rs_q_active['quest_name'] ?></a></td>
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
            </section>

            <section class="bg-success p-1 rounded mb-3">
                <h4 class="text-light">Complete Quest</h4>
                <hr class="bg-white">
                <div class="table-responsive text-light">
                    <table class="table table-striped text-nowrap text-light" id="dataTable">
                        <thead>
                            <tr>
                                <th class="align-middle">#</th>
                                <th class="align-middle">ชื่อแสดงในระบบ</th>
                                <th class="align-middle">สถานะภารกิจ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_q_active = " SELECT quest.quest_status,quest_activity_detail.quest_id,quest.quest_duration_day,quest.quest_name,quest.quest_created,quest_activity_detail.quest_atv_created
                        FROM quest_activity_detail INNER JOIN quest ON quest_activity_detail.quest_id = quest.id
                        WHERE quest_activity_detail.member_id = '$profiles_id' AND quest_activity_detail.activety_status = 2 AND quest.quest_status = 3 ";
                            $result_q_active = mysqli_query($conn, $sql_q_active);
                            $num_q_active = mysqli_num_rows($result_q_active);
                            $no = 1;
                            while ($rs_q_active = mysqli_fetch_assoc($result_q_active)) {
                                $id_q_active = $rs_q_active['id'];
                                $name_q_active = $rs_q_active['username'];
                            ?>
                                <tr>
                                    <td class="align-middle"><?= $no ?></td>
                                    <td class="align-middle"><a class="text-light" href="quest-detail.php?id=<?= $rs_q_active['quest_id'] ?>"><?= $rs_q_active['quest_name'] ?></a></td>
                                    <td class="h5">
                                        <span class="badge badge-success"><i class="far fa-check-circle"></i> <?= $rs_q_active['quest_status'] ?></span>
                                    </td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</div>