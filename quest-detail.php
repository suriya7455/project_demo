<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';

if (isset($_POST['submit'])) {
    $quest_name = $_POST['quest_name'];
    $quest_description = mysqli_real_escape_string($conn, $_POST['quest_description']);
    $quest_condition = $_POST['quest_condition'];
    $quest_reward = $_POST['quest_reward'];
    $quest_human = $_POST['quest_human'];
    $quest_human_more = $_POST['quest_human_more'];
    $quest_duration = $_POST['quest_duration'];
    $quest_duration_day = $_POST['quest_duration_day'];
    $quest_location = $_POST['quest_location'];
    $quest_location_map = $_POST['quest_location_map'];
    $quest_location_address = $_POST['quest_location_address'];
    $quest_catagory = $_POST['quest_catagory'];
    if ($_POST['quest_category_id'] != "") {
        $quest_category_id = $_POST['quest_category_id'];
    }
    if ($_POST['quest_category_id2'] != "") {
        $quest_category_id = $_POST['quest_category_id2'];
    }
    $quest_category_note = $_POST['quest_category_note'];
    $quest_assignor = $_POST['quest_assignor'];
    $quest_assignor_address = $_POST['quest_assignor_address'];

    $sql = " INSERT INTO quest SET
    id = NULL,
    quest_name = '$quest_name',
    quest_description = '$quest_description',
    quest_condition = '$quest_condition',
    quest_reward = '$quest_reward',
    quest_human = '$quest_human',
    quest_human_more = '$quest_human_more',
    quest_duration = '$quest_duration',
    quest_duration_day = '$quest_duration_day',
    quest_location = '$quest_location',
    quest_location_map = '$quest_location_map',
    quest_location_address = '$quest_location_address',
    quest_catagory = '$quest_catagory',
    quest_category_id = '$quest_category_id',
    quest_category_note = '$quest_category_note',
    quest_assignor = '$quest_assignor',
    quest_assignor_address = '$quest_assignor_address',
    quest_status = 1,
    quest_created = CURRENT_TIMESTAMP,
    quest_updated = CURRENT_TIMESTAMP
    ";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";
        header('location:index.php');
    } else {
        $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
    }
}

// submit by id
if (isset($_POST['sentquest'])) {
    if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) {
        $m_user_name = $_SESSION['guild_member'];
        $sql_id_member = "SELECT * FROM member WHERE member_username = '$m_user_name' ";
        $result_id_memeber = mysqli_query($conn, $sql_id_member);
        $rs_id_member = mysqli_fetch_assoc($result_id_memeber);
        $profiles_id = $rs_id_member['id'];
        $success_id = $_POST['success_id'];

        $sql_send_q = " UPDATE quest SET quest_status = 3 WHERE id = '$success_id' ";
        $result_send_q = mysqli_query($conn, $sql_send_q);
    }
}

// ip match
if (isset($_POST['ipquest'])) {
    $success_id = $_POST['success_id'];
    $sql_ip_match = " SELECT quest_ip FROM quest WHERE id = '$success_id' ";
    $result_id_match = mysqli_query($conn, $sql_ip_match);
    $rs_ip_match = mysqli_fetch_assoc($result_id_match);

    if ($rs_ip_match['quest_ip'] == get_client_ip()) {
        $sql_send_q = " UPDATE quest SET quest_status = 3 WHERE id = '$success_id' ";
        $result_send_q = mysqli_query($conn, $sql_send_q);
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boukensha Guild | Quest Detail</title>

    <link rel="icon" type="image/png" href="img/ico/icon.png" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="js/sweetalert.min.js"></script>
    <!-- fancybox -->
    <link href="guild_admin/plugins/fancybox/fancybox.css" rel="stylesheet" />

    <!-- dataTables -->
    <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="guild_admin/plugins/summernote/summernote-bs4.min.css">

    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="plugin/listQuestmyModal/myModal.js"></script>
    <link rel="stylesheet" href="plugin/listQuestmyModal/myModal.css" type="text/css">
    <script src="js/sweetalert.min.js"></script>
    <style>
        .bg-quest {
            background: url('images/bg_anime/bg_quest.jpg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        /* .bg-blank-color {
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 25px;
            } */
        </style>
    </head>

    <body>
        <!-- Page Preloder -->
        <div id="preloder">
            <div class="loader"></div>
        </div>

        <!-- Header Section Begin -->
        <?php require 'layout/top-menu.php'; ?>
        <!-- Header End -->

        <!-- Guild Quest Location Begin-->
        <?php
        $id_quest = $_GET['id'];
        $sql_quest = "SELECT * FROM quest WHERE id = '$id_quest' ";
        $result_quest = mysqli_query($conn, $sql_quest);
        $rs_quest = mysqli_fetch_assoc($result_quest);
        if ($rs_quest['quest_type'] == '0') {
            $tpye = 'ภารกิจทั่วไป';
            $sty = '0';
        }else{
            $tpye = 'ภารกิจลับ';
            $sty = '1';
        }

        if ($rs_quest['quest_human'] == 'นักผจญภัย 1 คน') {
         $numhuman = 1;
     }else{
        $numhuman = $rs_quest['quest_human_more'];
    }



    if ($rs_quest['quest_type_Rewards'] == '0') {
        $tpyeRewards = 'ได้รับทุกรายการ';
    }else{
        $tpyeRewards = 'เลือกอย่างไดอย่างหนึ่ง';
    }

    $sql_activity = "SELECT * FROM quest_activity_detail WHERE quest_id = '$id_quest' AND  member_id = '".$_SESSION['guild_id']."' AND  activety_status = 'สร้างเควส' ";

    $result_activity = mysqli_query($conn,$sql_activity);
    $rs_activity = mysqli_fetch_assoc($result_activity);
    if ($rs_activity) {
            $statusAdd = 1; //เจ้าของภารกิจ
        }else{
            $statusAdd = 0; // นักภจญภัย
        }



        $sql_quest_reward = "SELECT * FROM rewards_quest WHERE rq_id_quest = '$id_quest' ";
        $result_quest_reward = mysqli_query($conn, $sql_quest_reward);

        $sql_quest_conditions = "SELECT * FROM conditions_quest WHERE cq_id_quest = '$id_quest' ";
        $result_quest_conditions = mysqli_query($conn, $sql_quest_conditions);

        $sql_quest_contact = "SELECT * FROM contact_quest WHERE coq_id_quest = '$id_quest' ";
        $result_quest_contact = mysqli_query($conn, $sql_quest_contact);



        ?>
        <section class="product spad bg-quest" style="margin-bottom:0;padding-bottom:0">
            <div class="container">
                <div class="row bg-blank-color py-5 px-5">
                    <?= $msg ?>
                    <div class="col-lg-12">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <p class="text-center text-dark">Quest Description</p>
                                <h2 class="text-center text-dark font-weight-bold">รายละเอียดภารกิจ</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 3rem;">

                        <p class="text-right text-dark"><?= guildDate($rs_quest['quest_created']) ?></p>
                        <span class="mb-2 text-dark p-1 h4">
                            <?= $rs_quest['quest_name'] ?>
                        </span>
                        <hr class="border-dark">
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <div class="row mb-2">
                                    <div class="col-md-6 text-dark">เลขที่ภารกิจ : <?= sprintf("%05d", $rs_quest['id']) ?></div>
                                    <div class="col-md-6 text-dark">
                                        <div class="row">
                                            <div class="col-md-6 text-left">จำนวนนักผจญภัย :
                                                <?php if ($rs_quest['quest_human'] == 'นักผจญภัย มากกว่า 1 คน') { ?>
                                                    <?= $rs_quest['quest_human_more'] ?> คน
                                                <?php } else { ?>
                                                    <?= $rs_quest['quest_human'] ?>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-6 text-left">สถานะภารกิจ : <?= $rs_quest['quest_status'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6 text-dark">ผู้มอบหมายภารกิจ : <?= $rs_quest['quest_assignor'] ?></div>
                                    <div class="col-md-6 text-dark">
                                      <label>รางวัลภารกิจ : <?= $tpyeRewards ?></label><br>  

                                  </div>
                              </div>
                              <div class="row mb-2">
                                <div class="col-md-6 text-dark">
                                   <label> ระยะเวลาการทำภารกิจ : <?= $rs_quest['quest_duration'] ?></label><br>
                                   <label> ประเภทของภารกิจ : <?= $tpye ?></label><br>
                                   <label> นักผจญภัย : <?= $rs_quest['quest_status'] ?></label>
                               </div>
                               <div class="col-md-6 text-dark">
                                 <?php $nn = 1; while ($rs_quest_reward = mysqli_fetch_assoc($result_quest_reward)) {
                                     ?>
                                     <label><label style="color: #0a82e1;">ลำดับที่ <?= $nn ?></label> <?= $rs_quest_reward['rq_name_Rewards'].'  '.$rs_quest_reward['rq_Rewards_type'] ?></label><br>
                                     <?php
                                     $nn++; } ?>
                                 </div>
                             </div>
                             <div class="row mb-2">
                                <?php
                                $sql_categories = " SELECT * FROM categories WHERE id = " . $rs_quest['quest_category_id'];
                                $result_categories = mysqli_query($conn, $sql_categories);
                                $num_categories = mysqli_num_rows($result_categories);
                                $rs_categories = mysqli_fetch_assoc($result_categories);
                                ?>
                                <?php if ($num_categories > 0) { ?>
                                    <div class="col-md-6 text-dark">Hastag : <span class="badge badge-primary"><?= $rs_categories['categories_name'] ?></span></div>
                                    <div class="col-md-6 text-dark">
                                        <div class="row">
                                            <div class="col-md-6 text-left">Categories1 : <?= $rs_quest['quest_catagory'] ?></div>
                                            <div class="col-md-6 text-left">Categories2 : <?= $rs_categories['categories_name'] ?></div>
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-6 text-dark">Hastag : <span class="badge badge-primary"><?= $rs_quest['quest_category_note'] ?></span></div>
                                    <div class="col-md-6 text-dark">
                                        <div class="row">
                                            <?php
                                            if ($rs_quest['quest_category_id'] == 0) {
                                                $other_cate = "อื่นๆ";
                                            }
                                            ?>
                                            <div class="col-md-6 text-left">Categories1 : <?= $other_cate ?></div>
                                            <div class="col-md-6 text-left">Categories2 : <?= $rs_quest['quest_category_note'] ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <hr class="border-dark">
                            <div class="col-md-12">
                                <h4 class="text-dark">Quest Descriptions | รายละเอียดภารกิจ</h4>
                                <div class="mt-3">
                                    <?= $rs_quest['quest_description'] ?>
                                </div>
                            </div>
                            <div class="clearfix mb-5" style="clear:both"></div>
                            <div class="col-md-12">
                                <h4 class="text-dark">Quest Conditions | เงื่อนไขการส่งมอบภารกิจ</h4>
                                <div class="mt-3 text-dark">
                                    <?php $nn = 1; while ($rs_quest_conditions = mysqli_fetch_assoc($result_quest_conditions)) {
                                     ?>
                                     <label><label style="color: #0a82e1;">ลำดับที่ <?= $nn ?></label> <?= $rs_quest_conditions['cq_conditionsName_quest']; ?></label><br>
                                     <?php if ($rs_quest_conditions['cq_conditionsImg_quest'] != '') {  ?>
                                         <img src="img/imgQuest/<?= $rs_quest_conditions['cq_conditionsImg_quest']; ?>">
                                     <?php  } ?>


                                     <?php
                                     $nn++; } ?>
                                 </div>
                             </div>
                             <div class="clearfix mb-5" style="clear:both"></div>

                             <div class="col-md-12 mt-3 mb-2">
                                <h4 class="text-dark mb-3">Quest Location | ตำแหน่งการทำภารกิจ</h4>
                                <div class="ml-3 text-dark mt-2 mb-1">
                                    <?= $rs_quest['quest_location'] ?> ที่อยู่
                                    <?php
                                    if ($rs_quest['quest_location_address'] != "") {
                                        echo $rs_quest['quest_location_address'];
                                    } else {
                                        echo $rs_quest['quest_location_map'];
                                    }
                                    ?>
                                </div>
                                <?php if ($rs_quest['quest_location_map'] != "") { ?>
                                    <div class="form-group row">
                                        <div class="col-md-12 pt-2 mt-3">
                                            <?php
                                            $map = $rs_quest['quest_location_map'];
                                            $array_date = explode(')', $map);
                                            $msg1 = $array_date[0];
                                            $msg2 = $array_date[1];

                                            $key = str_replace("(", "", $msg1);
                                            $latlong = str_replace(" ", "", $key);
                                            ?>
                                            <iframe width="100%" height="350px" style="border:0;" allowfullscreen="" loading="lazy" src="https://maps.google.com/maps?q=<?= $latlong ?>&hl=th;z=14&amp;output=embed"></iframe>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if ($rs_quest['quest_location_address'] != "") { ?>
                                    <div class="form-group row">
                                        <div class="col-md-12 pt-2 mt-3">
                                            <?php
                                            $map = $rs_quest['quest_location_address'];
                                            $array_date = explode(')', $map);
                                            $msg1 = $array_date[0];
                                            $msg2 = $array_date[1];

                                            $key = str_replace("(", "", $msg1);
                                            $latlong = str_replace(" ", "", $key);
                                            ?>
                                            <iframe width="100%" height="350px" style="border:0;" allowfullscreen="" loading="lazy" src="https://maps.google.com/maps?q=<?= $latlong ?>&hl=th;z=14&amp;output=embed"></iframe>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                           <!--  <div class="col-md-12 mt-2 mb-2">
                                <h4 class="text-dark mb-3">Quest Duration | ระยะเวลาการทำภารกิจ</h4>
                                <p class="text-dark mt-1"><?= $rs_quest['quest_duration'] ?></p>
                            </div>
                            <div class="col-md-12 mt-2 mb-2">
                                <h4 class="text-dark mb-3">Quest Rewards | รางวัลของภารกิจ</h4>
                                <p class="text-dark mt-1"><?= $rs_quest['quest_reward'] ?></p>
                            </div> -->
                            <hr class="border-dark">
                            <div class="col-md-12 mt-2 mb-2">
                                <h4 class="text-dark mb-3">Mura Contact | ช่องทางติดต่อผู้มอบหมายภารกิจ</h4>

                                <?php $t = 1; while ($rsstcontact = mysqli_fetch_assoc($result_quest_contact)) { ?>
                                    <div class="mt-2 text-dark" class="cotext-02"><label style="color: #0a82e1;">ลำดับที่ <?=$t ?></label>  <?php echo  $rsstcontact['coq_Contact_type'].' : '.$rsstcontact['coq_Contact'] ?></div>
                                    <?php $t++; } ?>
                                </div>
                                <hr class="border-dark">
                                <div class="col-md-12 mt-2 mb-2">
                                   <?php if ($statusAdd == '0') { ?>
                                    <h4 class="text-dark mb-3">Submit a Request | ยืนความประสงค์ขอรับภารกิจ</h4>
                                    <div class="mt-2 text-dark">

                                        <div class="bt-from">
                                            <?php

                                            $sqlstatus = "SELECT * FROM quest_interested WHERE qi_id_quest = '".$_GET['id']."' AND qi_id_number = '".$_SESSION['guild_id']."' AND qi_status_agree = '1' ";
                                            $resultst = mysqli_query($conn, $sqlstatus);
                                            $rsst = mysqli_fetch_assoc($resultst);
                                            if ($rsst) {
                                             ?>
                                             <div class="appud-t">รอการยืนยันจากเจ้าของภารกิจ</div>

                                             <?php
                                         }else{

                                            ?>
                                            <div class="btn btn-lg btn-block btn-primary" id="interested" data-id="<?=$_GET['id'];?>">สนใจรับภารกิจ</div>
                                        <?php  }  ?>
                                    </div>
                                    <?php if ($rsst){
                                        if ($sty == '0') { ?>
                                            <div class="from-details-owner">
                                                <div class="t-details">ข้อมูลติดต่อเจ้าของภารกิจ</div>
                                                <div class="from-details">
                                                    <div class="d-l">
                                                        <div class="img-logo"><img src="plugin/myModal/02.jpg" class="imagecontart"> </div>        
                                                    </div>
                                                    <div class="d-r">
                                                        <?php while ($rsstcontact = mysqli_fetch_assoc($result_quest_contact)) { ?>
                                                            <label class="cotext-02"><?php echo  $rsstcontact['coq_Contact_type'].' : '.$rsstcontact['coq_Contact'] ?></label><br>

                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }  } ?>
                                    </div>
                                <?php }else{

                                   $sqlinterested = "SELECT * FROM quest_interested INNER JOIN member ON quest_interested.qi_id_number = member.id WHERE quest_interested.qi_id_quest = '".$_GET['id']."'  AND quest_interested.qi_status_agree = '1' ";
                                   $resultinterested = mysqli_query($conn, $sqlinterested);


                                   ?>
                                   <h4 class="text-dark mb-3">Quest Status | สถานะของภารกิจ</h4>
                                   <div class="from-details01">
                                    <div class="list-interested">
                                       <div class="t-interested01">การตอบกลับของนักผจญภัย</div>

                                       <?php $numadd = 0; while ($rsstinterested = mysqli_fetch_assoc($resultinterested)) {
                                        if ($rsstinterested['qi_status'] == '1') {
                                            $numadd += 1;
                                        }

                                        ?>
                                        <div class="list-in-01 mem-<?= $rsstinterested['id']?> recllass">
                                            <div class="h33 in_l"><?= $rsstinterested['member_username']?> </div>
                                            <div class="bt-choose button1 in_r" id="lismenbber" data-id="<?=$rsstinterested['id'] ?>" data-q="<?=$_GET['id'] ?>" data-nm="<?=$rsstinterested['member_username'] ?>" data-st="<?=$rsstinterested['qi_status'] ?>">เลือกนักผจญภัย
                                            </div>
                                            <?php if ($rsstinterested['qi_status'] == '1') { 
                                                    if ($rsstinterested['qi_mission'] == '1') {
                                                        ?>
                                                        <div style="color: #09a52d;float: left;">รับมอบภารกิจจากนักผจญภัยท่านนี้เรียบร้อย</div>

                                                        <?php
                                                    }else{
                                                ?>
                                                <div style="color: red;float: left;">รับนักผจญภัยท่านนี้</div>
                                            <?php } } ?>
                                        </div>

                                    <?php } ?>
                                    <div class="footers">จำนวนนักผจญภัยที่ต้องการ <?=$numhuman ?> / <label class="numlistadd"><?=$numadd ?></label> คน</div>
                                </div>


                            </div>
                           

                            <div class="from-details detailmenber" >
                                <div class="d-l">
                                    <div class="img-logo"><img src="plugin/myModal/02.jpg" class="imagecontart"> </div>   </div>
                                    <div class="d-r">
                                        <div class="listmenberin">
                                            <div class="d-r">
                                             <h3 class="hname">BOUKENSHA CONTRACT INFORMATION</h3>
                                             <hr>
                                             <h5 class="hname">ข้อมูลการติดต่อกลับนักผจญภัย</h5>
                                         </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="from-details01">
                                    <div class="form-bt">
                                    <div class="button2 w-01" id="agreemenber" data-idq="" data-idmen="" data-st="">ตกลงรับนักผจญภัย</div>
                                    
                                    <div class="button2 w-01" id="mission" data-idq="" data-idmen="">รับมอบภารกิจ</div>
                                    <div class="button2 bty w-01">แก้ไขข้อมูลภารกิจ</div>
                                    <div class="button2 w-01" style="background: red" id="cancelagreemenber" data-idq="" data-idmen="" data-st="">ยกเลิกนักผจญภัย</div>
                                </div>
                                </div>

                                <div class="listnammen">นักผจญภัยผู้รับผิดชอบภารกิจ....<label class="listnamemenber"></label>......</div>
                                <div class="listnammen">
                                    <small id="quest_namehelps" class="form-text text-danger">* หากกด "ตกลงรับนักผจญภัย" แล้ว สถานะของภารกิจจะเปลี่ยนเป็น "นักผจญภัยรับภารกิจ" โดยอัตโนมัติ</small>

                                    <small id="quest_namehelps" class="form-text text-danger">* หากกด "รับมอบภารกิจ" แล้ว สถานะของภารกิจจะเปลี่ยนเป็น "ภารกิจเสร็จสิ้น" โดยอัตโนมัติ</small>


                                </div>
                               


                            <?php } ?>
                        </div>
                        <div class="listDetalMlist"></div>
                        <div class="clearfix mb-5" style="clear:both"></div>
                        <hr class="border-dark">
                        <div class="col-md-12 mt-2 mb-2">
                            <h4 class="text-dark mb-5">Boukensha Forum | กระดานติดต่อนักผจญภัย</h4>
                            <div class="card">
                                <div class="card-body">
                                    <div class="fb-comments text-dark" data-href="quest-detail.php?id=<?= $_GET['id'] ?>" data-width="100%" data-numposts="5"></div>
                                </div>
                            </div>
                        </div>
                        <small id="quest_namehelps" class="form-text text-danger">*หากไม่สามารถเชื่อมต่อปลั้กอินของ Facebook เพื่อแสดงความเห็นได้ให้ทดลองเปลี่ยนไปใช้บริการผ่าน Google Chome Brower</small>
                           <!--  <hr class="border-dark">
                            <div class="col-md-12 mt-2 mb-2">
                                <h4 class="text-dark">Quest Status | สถานะของภารกิจ (สำหรับผู้มอบหมายภารกิจ) IP Address : <?= $rs_quest['quest_ip'] ?></h4>
                            </div> -->
                           <!--  <div class="col-md-12 mt-5">
                                <div class="row">
                                    <div class="col-md-4 mb-2 text-center"><a href="guild-board.php" class="btn btn-lg btn-block btn-info">ตามหานักผจญภัย</a></div>
                                    <div class="col-md-4 mb-2 text-center"><a href="member_guild.php?mn=quest&file=quest_active&id=<?= $rs_quest['id'] ?>" class="btn btn-lg btn-block btn-primary">นักผจญภัยรับภารกิจ</a></div>
                                    <div class="col-md-4 mb-2 text-center">
                                        <?php
                                        $sql_check_quest = "SELECT * FROM quest_activity_detail WHERE quest_id = '$id_quest' AND activety_status = 1 ";
                                        $result_check_quest = mysqli_query($conn, $sql_check_quest);
                                        $rs_check_quest = mysqli_fetch_assoc($result_check_quest);
                                        ?>
                                        <?php if ($rs_quest['quest_status'] != "ส่งมอบภารกิจ") { ?>
                                            <?php
                                            if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) {
                                                $m_user_name = $_SESSION['guild_member'];
                                                $sql_id_member = "SELECT * FROM member WHERE member_username = '$m_user_name' ";
                                                $result_id_memeber = mysqli_query($conn, $sql_id_member);
                                                $rs_id_member = mysqli_fetch_assoc($result_id_memeber);
                                                $profiles_id = $rs_id_member['id'];
                                            ?>
                                                <?php if ($rs_check_quest['member_id'] == $profiles_id) { ?>
                                                    <form action="" method="POST">
                                                        <input type="hidden" id="success_id" name="success_id" value="<?= $rs_quest['id'] ?>">
                                                        <button type="submit" name="sentquest" class="btn btn-lg btn-block btn-success" id="quest_1">ส่งมอบภารกิจ</button>
                                                    </form>
                                                <?php } ?>
                                            <?php } elseif ($rs_quest['quest_ip'] == get_client_ip() && (!isset($_SESSION['guild_member']) && !isset($_SESSION['guild_member_login']))) {
                                            ?>
                                                <form action="" method="POST">
                                                    <input type="hidden" id="success_id" name="success_id" value="<?= $rs_quest['id'] ?>">
                                                    <button type="submit" name="ipquest" class="btn btn-lg btn-block btn-success" id="quest_2">ส่งมอบภารกิจ</button>
                                                </form>
                                            <?php } else { ?>
                                                <input type="hidden" id="quest_id" value="<?= $rs_quest['id'] ?>">
                                                <button class="btn btn-lg btn-block btn-success" id="quest_3">ส่งมอบภารกิจ</button>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-4 text-center"><i class="fas fa-door-open text-primary"></i>&nbsp; <a href="new-quest.php" class="text-danger font-weight-bold">ภารกิจอื่นๆ (กลับไปหน้า New Quest)</a></div>
                        <div class="col-md-4 text-center"><i class="fas fa-scroll text-primary"></i>&nbsp; <a href="guild-board.php" class="text-danger font-weight-bold">กลับไปที่ Guild Board</a></div>
                        <div class="col-md-4 text-center"><i class="fas fa-dungeon text-primary"></i>&nbsp; <a href="index.php" class="text-danger font-weight-bold">กลับไปที่ Guild (หน้าหลัก)</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Guild Quest Location End-->

    <?php
    require 'layout/footer-menu.php';
    ?>

    <!-- Js Plugins -->
    <!-- <script src="js/jquery-3.3.1.min.js"></script>
        <script src="guild_admin/plugins/jquery/jquery.min.js"></script> -->
        <script src="guild_admin/plugins/jquery/jquery.min.js"></script>
        <!-- <script src="dist/js/jquery-1.12.4.min.js"></script> -->
        <!-- Bootstrap 4 -->
        <script src="guild_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="guild_admin/dist/js/adminlte.min.js"></script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/player.js"></script>
        <script src="js/jquery.nice-select.min.js"></script>
        <script src="js/mixitup.min.js"></script>
        <script src="js/jquery.slicknav.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Datatable -->
        <script src="guild_admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="guild_admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="guild_admin/plugins/datatables/data.th.js"></script>

        <script src="guild_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Summernote -->
        <script src="guild_admin/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- include summernote-th-TH -->
        <script src="guild_admin/plugins/summernote/lang/summernote-th-TH.min.js"></script>

        <!-- fancybox -->
        <script src="guild_admin/plugins/fancybox/fancybox.umd.js"></script>

        <!-- Sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="js/app.js"></script>
        <!-- facebook comment -->
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v13.0&appId=1179483049462759&autoLogAppEvents=1" nonce="YLUiVDFA"></script>

        <script>
            $('font').css('color', 'black');
            $('p').css('color', 'black');
        </script>
    </body>

    </html>