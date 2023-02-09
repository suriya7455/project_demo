<?php
$sql = " SELECT * FROM setting WHERE id = 1 ";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_assoc($result);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <i class="fas fa-mail-bulk fa-4x"></i>
                    </div>
                    <div class="text-muted text-center mt-2 mb-1"><i class="far fa-calendar-plus"></i> <?= DateThaiFull($rs['setting_created']) ?></div>
                    <div class="text-muted text-center mb-1"><i class="far fa-edit"></i> <?= DateThaiFull($rs['setting_updated']) ?></div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#email-setting" data-toggle="tab">ตั้งค่าอีเมล</a></li>
                        <li class="nav-item"><a class="nav-link" href="#stat-setting" data-toggle="tab">สถิติการเข้าชม</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="email-setting">
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">การตั้งค่าอีเมลนี้</h4>
                                <p>ใช้ในการยืนยันการสมัครสมาชิก Boukensha Guild การยืนยันอีเมล การแจ้งเตือน การกู้คืนรหัสผ่าน ของระบบ Boukensha Guild</p>
                                <hr>
                                <p class="mb-0">กรณีจดโดเมนหรือเช่าโฮสต์ การตั้งค่านี้จะขึ้นตรงต่อเว็บไซต์ที่ใช้งาน</p>
                            </div>
                            <?php
                            if (isset($_POST['submit_email'])) {
                                $email_host_name = $_POST['email_host_name'];
                                $email_port_name = $_POST['email_port_name'];
                                $email_username = $_POST['email_username'];
                                $email_password = $_POST['email_password'];
                                $sql_api = " UPDATE setting SET 
                                                                email_host_name = '$email_host_name',
                                                                email_port_name = '$email_port_name',
                                                                email_username = '$email_username',
                                                                email_password = '$email_password'
                                                                WHERE id = '1' ";
                                $result_api = mysqli_query($conn, $sql_api);
                                if ($result_api) {
                                    header("Refresh:1; url=index.php?mn=setting&file=setting_list&tab=email-setting");
                                    $msg2 = "<div class=\"alert alert-success text-center\">แก้ไข้ข้อมูลสำเร็จ</div>";
                                }
                            }
                            ?>
                            <?php
                            if (!empty($msg2)) {
                                echo $msg2;
                            }
                            ?>
                            <form class="form-horizontal" method="POST" action="index.php?mn=setting&file=setting_list&tab=email-setting">
                                <div class="form-group row">
                                    <label for="email_host_name" class="col-sm-2 col-form-label">HOST</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_host_name" name="email_host_name" value="<?= $rs['email_host_name'] ?>" placeholder="URL ผู้ให้บริการอีเมล">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_port_name" class="col-sm-2 col-form-label">PORT</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_port_name" name="email_port_name" value="<?= $rs['email_port_name'] ?>" placeholder="PORT อีเมล">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_username" class="col-sm-2 col-form-label">USERNAME</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_username" name="email_username" value="<?= $rs['email_username'] ?>" placeholder="ชื่อผู้ใช้งาน">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email_password" class="col-sm-2 col-form-label">PASSWORD</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_password" name="email_password" value="<?= $rs['email_password'] ?>" placeholder="รหัสผ่าน">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" name="submit_email" class="btn btn-primary btn-block">บันทึก</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="stat-setting">
                            <?php
                            $strSQL = " SELECT DATE FROM counter LIMIT 0,1";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            if ($objResult["DATE"] != date("Y-m-d")) {
                                //*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
                                $strSQL = " INSERT INTO daily (DATE,NUM) SELECT '" . date('Y-m-d', strtotime("-1 day")) . "',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '" . date('Y-m-d', strtotime("-1 day")) . "'";
                                mysqli_query($conn, $strSQL);

                                //*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
                                $strSQL = " DELETE FROM counter WHERE DATE != '" . date("Y-m-d") . "' ";
                                mysqli_query($conn, $strSQL);
                            }

                            //*** Insert Counter ปัจจุบัน ***//
                            $strSQL = " INSERT INTO counter (DATE,IP) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "') ";
                            mysqli_query($conn, $strSQL);

                            //******************** Get Counter ************************//

                            // Today //
                            $strSQL = " SELECT COUNT(DATE) AS CounterToday FROM counter WHERE DATE = '" . date("Y-m-d") . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strToday = $objResult["CounterToday"];

                            // Yesterday //
                            $strSQL = " SELECT NUM FROM daily WHERE DATE = '" . date('Y-m-d', strtotime("-1 day")) . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strYesterday = $objResult["NUM"];

                            // This Month //
                            $strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m') . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strThisMonth = $objResult["CountMonth"];

                            // Last Month //
                            $strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m', strtotime("-1 month")) . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strLastMonth = $objResult["CountMonth"];

                            // This Year //
                            $strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y') . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strThisYear = $objResult["CountYear"];

                            // Last Year //
                            $strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y', strtotime("-1 year")) . "' ";
                            $objQuery = mysqli_query($conn, $strSQL);
                            $objResult = mysqli_fetch_assoc($objQuery);
                            $strLastYear = $objResult["CountYear"];
                            ?>
                            <table class="table table-bordered">
                                <tr>
                                    <td colspan="2" class="text-center align-middle font-weight-bold">
                                        จำนวนผู้ใช้บริการนับจาก IP
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">วันนี้</td>
                                    <td>
                                        <?php echo number_format($strToday, 0); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">เมื่อวานนี้</td>
                                    <td>
                                        <?php echo number_format($strYesterday, 0); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">เดือนนี้</td>
                                    <td>
                                        <?php echo number_format($strThisMonth, 0); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">เดือนที่แล้ว</td>
                                    <td>
                                        <?php echo number_format($strLastMonth, 0); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">ปีนี้</td>
                                    <td>
                                        <?php echo number_format($strThisYear, 0); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold align-middle">ปีที่แล้ว</td>
                                    <td>
                                        <?php echo number_format($strLastYear, 0); ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>