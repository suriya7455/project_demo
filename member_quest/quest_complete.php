<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mb-2">
            <?php require 'layout/left-profile.php'; ?>
        </div>
        <div class="col-md-9 mb-2">
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
                                <td class="align-middle"><a href="quest-detail.php?id=<?= $rs_q_active['quest_id'] ?>"><?= $rs_q_active['quest_name'] ?></a></td>
                                <td class="h5">
                                    <span class="badge badge-success"><i class="far fa-check-circle"></i> <?= $rs_q_active['quest_status'] ?></span>
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