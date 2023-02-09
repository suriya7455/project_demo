<?php
if (isset($_POST['submit'])) {
 
    $id_edit = $_POST['id_edit'];
    $hall_genesis_quest = $_POST['hall_genesis_quest'];
    $hall_quest_name = $_POST['hall_quest_name'];
    $hall_quest_assignor = $_POST['hall_quest_assignor'];
    $hall_quest_linke = $_POST['hall_quest_Link'];
    $sql = " UPDATE hall_left SET
                    hall_genesis_quest = '$hall_genesis_quest',
                    hall_quest_name = '$hall_quest_name',
                    hall_quest_assignor = '$hall_quest_assignor',
                    hall_quest_Link = '$hall_quest_linke'
                    WHERE id = '$id_edit'
                    ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=hall_left&file=hall_left_list');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }
}
?>
<div class="col-md-12">
    <?= $msg ?>
    <!-- general form elements -->
    <?php
    if (isset($_GET['edit_id'])) {
        $id_edit = $_GET['edit_id'];
    } else {
        $id_edit = "";
    }
    $sql_hall_edit = "SELECT * FROM hall_left WHERE id = '$id_edit' ";
    $result_hall_edit = mysqli_query($conn, $sql_hall_edit);
    $rs_hall_edit = mysqli_fetch_assoc($result_hall_edit);
    ?>
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">แก้ไข Origin Quest</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="">
            <div class="card-body">
                <div class="form-group">
                    <label for="hall_genesis_quest">Genesis Quest</label>
                    <input type="text" class="form-control" name="hall_genesis_quest" id="hall_genesis_quest" value="<?= $rs_hall_edit['hall_genesis_quest'] ?>" placeholder="Genesis Quest" required>
                </div>
                <div class="form-group">
                    <label for="hall_quest_name">Quest Name</label>
                    <input type="text" class="form-control" name="hall_quest_name" id="hall_quest_name" value="<?= $rs_hall_edit['hall_quest_name'] ?>" placeholder="Quest Name" required>
                </div>
                <div class="form-group">
                    <label for="hall_quest_assignor">Quest Assignor</label>
                    <input type="text" class="form-control" name="hall_quest_assignor" id="hall_quest_assignor" value="<?= $rs_hall_edit['hall_quest_assignor'] ?>" placeholder="Quest Assignor" required>
                </div>
                 <div class="form-group">
                    <label for="hall_quest_Link">Quest Link</label>
                    <input type="text" class="form-control" name="hall_quest_Link" id="hall_quest_Link" placeholder="Quest Link"  value="<?= $rs_hall_edit['hall_quest_Link'] ?>">
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <input type="hidden" name="id_edit" value="<?= $rs_hall_edit['id'] ?>">
                <button type="submit" class="btn btn-primary" name="submit">บันทึกข้อมูล</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
</div>