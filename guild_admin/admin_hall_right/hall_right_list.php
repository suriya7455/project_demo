<div class="card">
    <div class="card-header h5">
        <a href="index.php?mn=hall_right&file=hall_right_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="align-middle">#</th>
                        <th class="align-middle">Genesis Quest</th>
                        <th class="align-middle">Quest Name</th>
                        <th class="align-middle">Quest Assignor</th>
                         <th class="align-middle">Quest LINK</th>
                        <th class="align-middle">ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql_hall_right = " SELECT * FROM hall_right ORDER BY id DESC";
                    $result_hall_right = mysqli_query($conn, $sql_hall_right);
                    $no = 1;
                    while ($rs_hall_right = mysqli_fetch_assoc($result_hall_right)) {
                        $id_hall_right = $rs_hall_right['id'];
                        $name_hall_right = $rs_hall_right['hall_genesis_quest'];
                    ?>
                        <tr>
                            <td class="align-middle"><?= $no ?></td>
                            <td class="align-middle"><?= $rs_hall_right['hall_genesis_quest'] ?></td>
                            <td class="align-middle"><?= $rs_hall_right['hall_quest_name'] ?></td>
                            <td class="align-middle"><?= $rs_hall_right['hall_quest_assignor'] ?></td>
                            <td class="align-middle"><a href="<?= $rs_hall_right['hall_quest_Link'] ?>" target="_blank"><?= $rs_hall_right['hall_quest_Link'] ?></a></td>
                            <td class="align-middle">
                                <a href="index.php?mn=hall_right&file=hall_right_edit&edit_id=<?= $rs_hall_right['id'] ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger mb-1" onclick="cdelte('<?= $name_hall_right ?>','index.php?mn=hall_right&file=hall_right_delete&delete_id=<?= $id_hall_right ?>')"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>