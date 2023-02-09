<div class="card card-dark">
    <div class="card-header h4 text-center">
        Hall of Fame
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h4 class="text-center mt-3 p-1 font-weight-bold rounded bg-light">Origin Quest</h4>
                <div class="table-responsive">
                    <table class="table table-borderless table-striped text-nowrap rounded">
                        <thead>
                            <tr>
                                <th class="text-center">Genesis Quest</th>
                                <th class="text-center">Quest Name</th>
                                <th class="text-center">Quest Assignor </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_quest1 = " SELECT * FROM hall_left ORDER BY id ASC ";
                            $result_quest1 = mysqli_query($conn, $sql_quest1);
                            $num_quest1 = mysqli_num_rows($result_quest1);
                            if ($num_quest1 > 0) {
                                $no = 1;
                                while ($rs_quest1 = mysqli_fetch_assoc($result_quest1)) {
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $rs_quest1['hall_genesis_quest'] ?></td>
                                        <td><?= $rs_quest1['hall_quest_name'] ?></td>
                                        <td class="text-center"><?= $rs_quest1['hall_quest_assignor'] ?></td>
                                    </tr>
                                <?php $no++;
                                } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <h4 class="text-center bg-light font-weight-bold p-1 mt-3 rounded">Boukensha Hall of Fame</h4>
                <div class="table-responsive">
                    <table class="table table-borderless table-striped text-nowrap rounded">
                        <thead>
                            <tr>
                                <th class="text-center">Genesis Quest</th>
                                <th class="text-center">Quest Name</th>
                                <th class="text-center">Quest Assignor </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql_quest2 = " SELECT * FROM hall_right ORDER BY id DESC ";
                            $result_quest2 = mysqli_query($conn, $sql_quest2);
                            $num_quest2 = mysqli_num_rows($result_quest2);
                            if ($num_quest2 > 0) {
                                $no = 1;
                                while ($rs_quest2 = mysqli_fetch_assoc($result_quest2)) {
                            ?>
                                    <tr>
                                        <td class="text-center"><?= $rs_quest2['hall_genesis_quest'] ?></td>
                                        <td><?= $rs_quest2['hall_quest_name'] ?></td>
                                        <td class="text-center"><?= $rs_quest2['hall_quest_assignor'] ?></td>
                                    </tr>
                                <?php $no++;
                                }
                            } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center">ยังไม่มี Hall of Fame</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>

<!-- แสดงรูปภาพ Background -->
<p>
    <a class="btn btn-primary" href="index.php?mn=hall&file=hall_list_bg_add"><i class="fas fa-plus"></i> เพิ่มภาพพื้นหลัง</a>
</p>
<div class="card card-dark">
    <div class="card-header h4 text-center">
        ตัวจัดการภาพพื้นหลัง
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover text-nowrap" id="dataTable">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>รูปภาพ</th>
                        <th>ชื่อ</th>
                        <th class="text-center">สถานะ</th>
                        <th class="text-center">ตัวจัดการ</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card-footer">
        &nbsp;
    </div>
</div>