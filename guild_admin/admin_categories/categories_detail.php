<?php
$view_id = $_GET['view_id'];
$sql = "SELECT * FROM categories WHERE id = '$view_id'";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="row">
    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">รายละเอียดภารกิจ</h3>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush text-left">
                    <li class="list-group-item">
                        <strong>ภารกิจ <?= $rs['categories_name'] ?></strong>
                    </li>
                </ul>
                <ul class="list-group list-group-flush text-left">
                    <li class="list-group-item">
                        <i class="bi bi-alarm"></i> เมื่อ <?= $rs['categories_create'] ?>
                    </li>
                </ul>
                <ul class="list-group list-group-flush text-left">
                    <li class="list-group-item">
                        <i class="bi bi-alarm"></i> อัปเดตล่าสุด <?= $rs['categories_updated'] ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header h4">
                ภารกิจ <?= $rs['categories_name'] ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover text-nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th class="align-middle">#</th>
                                <th class="align-middle">ภารกิจ</th>
                                <th class="align-middle">สถานะภารกิจ</th>
                                <th class="align-middle">ตัวจัดการ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_quest = " SELECT * FROM quest WHERE quest_category_id = '$view_id'  ORDER BY id ASC";
                            $result_quest = mysqli_query($conn, $sql_quest);
                            $no = 1;
                            while ($rs_quest = mysqli_fetch_assoc($result_quest)) {
                                $id_quest = $rs_quest['id'];
                                $name_quest = $rs_quest['quest_name'];
                            ?>
                                <tr>
                                    <td class="align-middle"><?= $rs_quest['id'] ?></td>
                                    <td class="align-middle"><?= $rs_quest['quest_name'] ?></td>
                                    <td class="align-middle"><?= $rs_quest['quest_status'] ?></td>
                                    <td class="align-middle">
                                        <a href="index.php?mn=quest&file=quest_detail&view_id=<?= $rs_quest['id'] ?>" class="btn btn-info mb-1"><i class="fas fa-binoculars"></i></a>
                                        <a href="index.php?mn=quest&file=quest_edit&edit_id=<?= $rs_quest['id'] ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                        <!-- ป้องกันการลบไอดี 1 ทิ้งกรณีลบออกหมดจะไม่สามารถ login ได้ -->
                                        <?php if ($no != 1) { ?>
                                            <button class="btn btn-danger mb-1" onclick="cdelte('<?= $name_quest ?>','index.php?mn=quest&file=quest_delete&delete_id=<?= $id_quest ?>')"><i class="fas fa-trash-alt"></i></button>
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
    </div>
</div>