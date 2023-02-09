<?php
if (isset($_POST['submit'])) {
    $author_name = $_POST['author_name'];
    $sql = "INSERT INTO author SET
                    author_name='$author_name' ";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php?mn=author&file=author_list');
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
                    <label for="hall_quest _assignor">Quest Assignor</label>
                    <input type="text" class="form-control" name="hall_quest _assignor" id="hall_quest _assignor" placeholder="Quest Assignor" required>
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