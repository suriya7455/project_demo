<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <?php
            $sql_quest = "SELECT * FROM quest ORDER BY id ASC";
            $result_quest = mysqli_query($conn, $sql_quest);
            $num_quest = mysqli_num_rows($result_quest);
            ?>
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3><?= number_format($num_quest) ?></h3>

                    <p>ภารกิจ</p>
                </div>
                <div class="icon">
                    <i class="fas fa-scroll text-white"></i>
                </div>
                <a href="index.php?mn=quest&file=quest_list" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <?php
        $sql_categories = "SELECT * FROM categories ORDER BY id ASC";
        $result_categories = mysqli_query($conn, $sql_categories);
        $num_categories = mysqli_num_rows($result_categories);
        ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-light">
                <div class="inner">
                    <h3><?= number_format($num_categories) ?></h3>

                    <p>ประเภทภารกิจ</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th-list"></i>
                </div>
                <a href="index.php?mn=categories&file=categories_list" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <?php
        $sql_banner = "SELECT * FROM banner ORDER BY id ASC";
        $result_banner = mysqli_query($conn, $sql_banner);
        $num_banner = mysqli_num_rows($result_banner);
        ?>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-olive">
                <div class="inner">
                    <h3><?= number_format($num_banner) ?></h3>
                    <p>โฆษณา</p>
                </div>
                <div class="icon">
                    <i class="fas fa-ad"></i>
                </div>
                <a href="index.php?mn=banner&file=banner_list" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <?php
            $sql_member = "SELECT * FROM member ORDER BY id ASC";
            $result_member = mysqli_query($conn, $sql_member);
            $num_member = mysqli_num_rows($result_member);
            ?>
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= number_format($num_member) ?></h3>

                    <p>ผู้ใช้งาน</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="index.php?mn=member&file=member_list" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <?php
            $sql_admin = "SELECT * FROM user_admin ORDER BY id ASC";
            $result_admin = mysqli_query($conn, $sql_admin);
            $num_admin = mysqli_num_rows($result_admin);
            ?>
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= number_format($num_admin) ?></h3>

                    <p>ผู้ดูแลระบบ</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-lock"></i>
                </div>
                <a href="index.php?mn=system&file=system_list" class="small-box-footer">ดูเพิ่มเติม <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>