<?php
if (isset($_POST['submit'])) {
    $hall_genesis_quest = $_POST['hall_genesis_quest'];
    $hall_quest_name = $_POST['hall_quest_name'];
    $hall_quest_assignor = $_POST['hall_quest_assignor'];
    $hall_quest_linke = $_POST['hall_quest_Link'];
    $sql = " INSERT INTO hall_right SET
                    id = NULL,
                    hall_genesis_quest = '$hall_genesis_quest',
                    hall_quest_name = '$hall_quest_name',
                    hall_quest_assignor = '$hall_quest_assignor',
                    hall_created = CURRENT_TIMESTAMP,
                    hall_updated = CURRENT_TIMESTAMP,
                    hall_quest_Link = '$hall_quest_linke'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=hall_right&file=hall_right_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Origin Quest</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="hall_genesis_quest">Genesis Quest</label>
                    <input type="text" class="form-control" name="hall_genesis_quest" id="hall_genesis_quest" placeholder="Genesis Quest" required>
                </div>
                <div class="form-group">
                    <label for="hall_quest_name">Quest Name</label>
                    <input type="text" class="form-control" name="hall_quest_name" id="hall_quest_name" placeholder="Quest Name" required>
                </div>
                <div class="form-group">
                    <label for="hall_quest_assignor">Quest Assignor</label>
                    <input type="text" class="form-control" name="hall_quest_assignor" id="hall_quest_assignor" placeholder="Quest Assignor" required>
                </div>
                <div class="form-group">
                    <label for="hall_quest_Link">Quest Link</label>
                    <input type="text" class="form-control" name="hall_quest_Link" id="hall_quest_Link" placeholder="Quest Link" >
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>