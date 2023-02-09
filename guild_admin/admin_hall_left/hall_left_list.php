<div class="card">
    <div class="card-header h5">
        <a href="index.php?mn=hall_left&file=hall_left_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
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
                    <?php $sql_hall_left = " SELECT * FROM hall_left ORDER BY id DESC";
                    $result_hall_left = mysqli_query($conn, $sql_hall_left);
                    $no = 1;
                    while ($rs_hall_left = mysqli_fetch_assoc($result_hall_left)) {
                        $id_hall_left = $rs_hall_left['id'];
                        $name_hall_left = $rs_hall_left['hall_genesis_quest'];
                    ?>
                        <tr>
                            <td class="align-middle"><?= $no ?></td>
                            <td class="align-middle"><?= $rs_hall_left['hall_genesis_quest'] ?></td>
                            <td class="align-middle"><?= $rs_hall_left['hall_quest_name'] ?></td>
                            <td class="align-middle"><?= $rs_hall_left['hall_quest_assignor'] ?></td>
                            <td class="align-middle"><a href="<?= $rs_hall_left['hall_quest_Link'] ?>" target="_blank"><?= $rs_hall_left['hall_quest_Link'] ?></a></td>
                            <td class="align-middle">
                                <a href="index.php?mn=hall_left&file=hall_left_edit&edit_id=<?= $rs_hall_left['id'] ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger mb-1" onclick="cdelte('<?= $name_hall_left ?>','index.php?mn=hall_left&file=hall_left_delete&delete_id=<?= $id_hall_left ?>')"><i class="fas fa-trash-alt"></i></button>
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