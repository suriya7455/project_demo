<?php
if ($msg != "") {
    echo $msg;
}
?>
<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <a href="index.php?mn=author&file=author_add" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover text-nowrap" id="author_type-grid">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">ผู้แต่ง</th>
                            <th class="text-center">เมื่อ</th>
                            <th class="text-center">ตัวจัดการ</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>