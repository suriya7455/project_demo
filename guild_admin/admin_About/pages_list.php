<div class="card">
    <div class="card-header h5">
        <a href="index.php?mn=About&file=pages_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
    </div>
    <div class="card-body">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <h4 class="alert-heading"><i class="fas fa-info-circle"></i> แนะนำการใช้งาน</h4>
            <p>ลำดับที่ 1 สำหรับเมนูเดี่ยว</p>
            <hr>
            <p class="mb-0">ลำดับที่ 2 เป็นต้นไปแสดงเป็นกลุ่มเมนู</p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th class="align-middle">#</th>
                        <th class="align-middle">หน้า</th>
                        <th class="align-middle">ตัวจัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql_pages = " SELECT * FROM pages WHERE pages_type = '1' ORDER BY id ASC";
                    $result_pages = mysqli_query($conn, $sql_pages);
                    $no = 1;
                    while ($rs_pages = mysqli_fetch_assoc($result_pages)) {
                        $id_pages = $rs_pages['id'];
                        $name_pages = $rs_pages['username'];
                    ?>
                        <tr>
                            <td class="align-middle"><?= $no ?></td>
                            <td class="align-middle"><?= $rs_pages['pages_name'] ?></td>
                            <td class="align-middle">
                                <a href="index.php?mn=About&amp;file=pages_detail&amp;view_id=<?= $rs_pages['id'] ?>" class="btn btn-info mb-1"><i class="fas fa-binoculars"></i></a>
                                <a href="index.php?mn=About&file=pages_edit&edit_id=<?= $rs_pages['id'] ?>" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger mb-1" onclick="cdelte('<?= $name_pages ?>','index.php?mn=About&file=pages_delete&delete_id=<?= $id_pages ?>')"><i class="fas fa-trash-alt"></i></button>
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