<?php if ($_GET['msg'] == "ban") { ?>
    <div class="alert alert-warning">ระบบไม่อนุญาตให้ลบไอดีหลัก</div>
<?php } ?>
<div class="card">
    <div class="card-header">
        <a href="index.php?mn=system&file=system_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="align-middle">#</th>
                        <th class="align-middle">ชื่อแสดงในระบบ</th>
                        <th class="align-middle">Username</th>
                        <th class="align-middle">ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql_system = " SELECT * FROM user_admin ORDER BY id ASC";
                    $result_system = mysqli_query($conn, $sql_system);
                    $no = 1;
                    while ($rs_system = mysqli_fetch_assoc($result_system)) {
                        $id_system = $rs_system['id'];
                        $name_system = $rs_system['username'];
                    ?>
                        <tr>
                            <td class="align-middle"><?= $rs_system['id'] ?></td>
                            <td class="align-middle"><?= $rs_system['full_name'] ?></td>
                            <td class="align-middle"><?= $rs_system['username'] ?></td>
                            <td class="align-middle">
                                <a href="index.php?mn=system&file=system_change&change_id=<?= $rs_system['id'] ?>" class="btn btn-dark mb-1"><i class="fas fa-user-lock"></i></a>
                                <a href="index.php?mn=system&file=system_edit&edit_id=<?= $rs_system['id'] ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                <!-- ป้องกันการลบไอดี 1 ทิ้งกรณีลบออกหมดจะไม่สามารถ login ได้ -->
                                <?php if ($no != 1) { ?>
                                    <button class="btn btn-danger mb-1" onclick="cdelte('<?= $name_system ?>','index.php?mn=system&file=system_delete&delete_id=<?= $id_system ?>')"><i class="fas fa-trash-alt"></i></button>
                                <?php } ?>
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