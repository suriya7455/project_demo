<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';

if ($_SESSION['guild_member'] != "" && $_SESSION['guild_member_login'] === true) {
    $m_user_name = $_SESSION['guild_member'];
    $sql_id_member = "SELECT * FROM member WHERE member_username = '$m_user_name' ";
    $result_id_memeber = mysqli_query($conn, $sql_id_member);
    $rs_id_member = mysqli_fetch_assoc($result_id_memeber);
    $profiles_id = $rs_id_member['id'];
}
if (isset($_GET['msg'])) {
  $msg = $_GET['msg'];
}
 
if (isset($_POST['submit'])) {
    if (!isset($_SESSION['guild_member']) && !isset($_SESSION['guild_member_login'])){
        $msg = "<div class='alert alert-success'>กรุณา Login ก่อนมอบหมายภารกิจ</div>";
        header('location:signup.php?msg='.$msg);
        return false;



    }

    $quest_name = $_POST['quest_name'];
    if (!isset($_SESSION['user_admin'])) {
        # code...

        if ($quest_name == '') {
            $msg = "<div class='alert alert-success'>กรุณากรอกชื่อภารกิจ</div>";
            header('location:quest-add.php?msg='.$msg);
            return false;

        }
        if (strpos($quest_name,'ทดสอบระบบ') != '' || strpos($quest_name,'test') != '' || strpos($quest_name,'Test') != '') {
           $msg = "<div class='alert alert-success'>ไม่สามารถใช้ชื่อภารกิจ</div>";
           header('location:quest-add.php?msg='.$msg);
           return false;
       }
   }
   $quest_description = mysqli_real_escape_string($conn, $_POST['quest_description']);
   $quest_condition = $_POST['quest_condition'];
   $quest_reward = $_POST['quest_reward'];

   $quest_human = $_POST['quest_human'];


   $modelgeneral = $_POST['modelgeneral'];
   $quest_human_more = $_POST['quest_adventure_num'];
   $quest_duration = $_POST['quest_duration'];
   $quest_duration_day = $_POST['quest_duration_day'];
   $quest_location = $_POST['quest_location'];
   if ($_POST['quest_location_map'] != '') {
       $quest_location_map = $_POST['quest_location_map'];
   }else{
    $quest_location_map = $_POST['quest_adventure_location'];
}

$quest_location_address = $_POST['quest_location_address'];
$quest_catagory = $_POST['quest_catagory'];
if ($_POST['quest_category_id'] != "") {
    $quest_category_id = $_POST['quest_category_id'];
}
if ($_POST['quest_category_id2'] != "") {
    $quest_category_id = $_POST['quest_category_id2'];
}

   // $quest_category_note = $_POST['quest_category_note'];
if ($_POST['quest_category_note'] != '') {
    $quest_category_note = $_POST['quest_category_note'];
}else{
    $quest_category_note = $_POST['quest_category_note2'];
}

$quest_assignor = $_POST['quest_assignor'];
$onereward = $_POST['onereward'];
$quest_assignor_address = $_POST['quest_assignor_address'];

$my_ips2 = get_client_ip();

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
quest_ip = '$my_ips2',
quest_created = CURRENT_TIMESTAMP,
quest_updated = CURRENT_TIMESTAMP,
quest_type = '$modelgeneral',
quest_type_Rewards = '$onereward'
";

$res = mysqli_query($conn, $sql);
$last_id = $conn->insert_id;


if ($res) {

    if (!empty($_POST['name'])) {
        //echo '1'; die;
        for ($n=0; $n < count($_POST['name']) ; $n++){
            if (!empty($_FILES['file']['name'][$n])) {
                $fileName = $_FILES['file']['name'][$n];
                $manty = explode(".",$fileName);
                $type =  $manty[1];
                $namefile =  date('YmdHis');
                $nameimgSql = $namefile.'.'.$type;
                $froder = 'img/imgQuest';
                $tmp = $_FILES["file"]["tmp_name"][$n];
                $status = 'insert';
                $nameUpdate = '';
                flieDUpload($tmp,$froder,$type,$namefile,$status,$nameUpdate);

                $sqlimg = "INSERT INTO conditions_quest (cq_id_quest, cq_conditionsName_quest, cq_conditionsImg_quest)
                VALUES ('".$last_id."', '".$_POST['name'][$n]."', '".$nameimgSql."')";
                mysqli_query($conn, $sqlimg);
            }else{

                $sqlimg = "INSERT INTO conditions_quest (cq_id_quest, cq_conditionsName_quest, cq_conditionsImg_quest)
                VALUES ('".$last_id."', '".$_POST['name'][$n]."', '')";
                mysqli_query($conn, $sqlimg);

            }
        }
    }
    if (!empty($_POST['rewardname'])){
        for ($i=0; $i < count($_POST['rewardname']) ; $i++){

            $sqlre = "INSERT INTO rewards_quest (rq_name_Rewards, rq_Rewards_type, rq_id_quest)
            VALUES ('".$_POST['rewardname'][$i]."', '".$_POST['location'][$i]."', '".$last_id."')";
            mysqli_query($conn, $sqlre);

        }

    }

    if (!empty($_POST['contactname'])){
        for ($i=0; $i < count($_POST['contactname']) ; $i++){

            $sqlcon = "INSERT INTO contact_quest (coq_id_quest, coq_Contact_type, coq_Contact)
            VALUES ('".$last_id."', '".$_POST['contactname'][$i]."', '".$_POST['idcontact'][$i]."')";
            mysqli_query($conn, $sqlcon);
        }

    }
    $msg = "<div class='alert alert-success'>บันทึกข้อมูลสำเร็จ</div>";

    if (!empty($_POST['quest_code'])) {
        $quest_code = $_POST['quest_code'];
    } else {
        $quest_code = NULL;
    }
    if ($profiles_id != "") {
        $memb_id = $profiles_id;
    } else {
        $memb_id = 0;
    }
    $my_ips = get_client_ip();

    $sql_max_quest = "SELECT MAX(id) AS 'max_quest' FROM quest";
    $result_max_quest = mysqli_query($conn, $sql_max_quest);
    $rs_max_quest = mysqli_fetch_assoc($result_max_quest);
    $max_quest = $rs_max_quest['max_quest'];

    $sql_ac = "INSERT INTO quest_activity_detail SET
    id = NUll,
    quest_id = '$max_quest',
    member_id = '$memb_id',
    guest_name = '$quest_assignor',
    guest_password = '$quest_code',
    guest_ip = '$my_ips',
    activety_status = 1,
    quest_atv_created = CURRENT_TIMESTAMP
    ";
    $result_ac = mysqli_query($conn, $sql_ac);

    header('location:index.php');
} else {
    $msg = "<div class='alert alert-danger'>บันทึกข้อมูลล้มเหลว</div>";
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
    <title>Boukensha Guild | Quest</title>


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

    <!-- dataTables -->
    <link href="guild_admin/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="guild_admin/plugins/summernote/summernote-bs4.min.css">

    <!-- font-awesome  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="plugin/myModal/myModal.js"></script>
    <link rel="stylesheet" href="plugin/myModal/myModal.css" type="text/css">
    <style>
        .bg-quest {
            background: url('images/bg_anime/bg_quest.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
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
        <section class="product spad bg-quest">
            <div class="container bg-blank-color">
                <div class="row py-5 px-5">
                    <div class="col-lg-12">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h2 class="text-center text-dark font-weight-bold">มอบหมายภารกิจ</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top: 3rem;">
                        <?= $msg; ?>
                        <p class="text-right text-dark">เวลา <?= date('H:i') ?>, วัน<?= Thweek() ?> ที่ <?= DateTh(date('Y/m/d')) ?></p>
                        <span class="mb-2 text-dark p-1 h4" style="border-bottom: 0.2rem black solid;">
                            Main Quest Information | ข้อมูลภารกิจ
                        </span>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <form method="POST" enctype="multipart/form-data" id="formquest-add">
                                    <div class="form-group mb-5 mt-3">
                                        <label for="quest_name" class="h4 text-dark mb-3">Quest Name | ชื่อภารกิจ</label>
                                        <input type="text" class="form-control" maxlength ="160" id="quest_name" name="quest_name" aria-describedby="quest_namehelps" placeholder="โปรดระบุชื่อของภารกิจที่ท่านต้องการมอบหมายให้กับเหล่านักผจญภัย...">
                                        <small id="quest_namehelps" class="form-text text-danger">*การตั้งชื่อภารกิจควรตัÊงชืÉอให้สามารถเข้าใจได้ง่าย และมีความสอดคล้องกับรายละเอียดของภารกิจทีÉต้องการมอบหมาย
                                            ให้นักผจญภัย
                                        </small>
                                        <small id="quest_namehelps" class="form-text text-danger">*จํากัด 160 ตัวอักษร (รับข้อมูลไม่เกิน 160 ตัวอักษร)</small>

                                        <small id="quest_namehelps" class="form-text text-danger">*ไม่อนุญาติให้ตัÊงชืÉอโดยระบุว่า: [Tutorial], [ภารกิจตัวอย่าง], [ทดสอบระบบ]</small>

                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="summernote1" class="h4 text-dark mb-3">Quest Descriptions | รายละเอียดภารกิจ</label>
                                        <textarea class="form-control " name="quest_description" id="summernote1" rows="10" placeholder="โปรดระบุเนื้อหาของภารกิจโดยละเอียด ควรอธิบายเรื่องราวของเนื้อหาด้วยภาษาที่เข้าใจง่าย หลีกเลี่ยงการใช้ศัพท์เฉพาะ(หากเป็นไปได้) และเขียนอธิบายเนื้อหาให้ชัดเจนไม่ใช้คำศัพท์ที่มีความกำกวม..."></textarea>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="summernote2" class="h4 text-dark mb-3">Quest Conditions | เงื่อนไขการส่งมอบภารกิจ</label>
                                        <div class="listquest">
                                           <div class="from-uplosdinput form-quest-01">
                                            <div class="from-inputo">
                                                <h4 class="h3">เงื่อนไขการส่งมอบภารกิจ ลำดับที่ 1</h4>
                                            </div>
                                            <div class="from-inputo fm">
                                                <input type="text" name="name[]" id="name" class="input" placeholder="โปรดระบุ เงื่อนไขการส่งมอบภารกิจ" >
                                            </div>
                                            <div class="from-inputo-file">
                                                <input class="custom-file-inputq" type="file" name="file[]" id="file">
                                            </div>
                                            <div class="from-inputo-file">
                                                <div class="button rightbt"><i class='fas fa-lock'></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bt02" id="addform" data-number="1">เพิ่มเงื่อนไงการส่งมอบ</div>
                                    <small id="quest_namehelps" class="form-text text-danger">*โปรดระบุเงื่อนไขการส่งมอบภารกิจออกเป็นข้อ ๆ ตามลําดับ เพื่อง่ายต่อการทําความเข้าใจเงืÉอนไขการส่งมอบภารกิจ ของนักผจญภัย</small>


                                    <!--  <textarea class="form-control" name="quest_condition" id="summernote2" rows="10" placeholder="โปรดระบุเงื่อนไขการส่งมอบภารกิจ ควรระบุแยกเป็นทีละหัวข้อให้ชัดเจนว่านักผจญภัยต้องผ่านเงื่อนไขได้บ้าง และเป็นไปตามมาตรฐานอย่างไร จึงจะสามารถส่งมอบภารกิจได้..."></textarea> -->
                                </div>
                                <div class="form-group mb-5">
                                    <label for="quest_reward" class="h4 text-dark mb-3">Quest Rewards | รางวัลภารกิจ</label>
                                    <div class="reward-bt">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                       <!--  <div class="allreward active" onclick="rewardsele('allreward','onereward')" id="allreward" data-st="1">ได้รับทุกรายการ</div>
                                        <div class="onereward" id="onereward" data-st="2" onclick="rewardsele('onereward','allreward')">ได้รับอย่างไดอย่างหนึ่ง</div> -->



                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="onereward" id="onereward" value="0" checked> ได้รับทุกรายการ
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="onereward" id="onereward" value="1"> ได้รับอย่างไดอย่างหนึ่ง
                                        </label>
                                    </div>
                                </div>



                                <div class="quest-reward">
                                   <div class="from-uplosdinput form-reward-quest-01">
                                    <div class="from-inputo">
                                        <h4 class="h3">รางวัลภารกิจ ลำดับที่ 1</h4>
                                    </div>
                                    <div class="from-inputo fm">
                                        <input type="text" name="rewardname[]" id="rewardname" class="input" placeholder="โปรดระบุ รางวัลภารกิจ" >
                                    </div>
                                    <div class="from-inputo-file">
                                        <input  type="text" name="location[]" placeholder="หน่วย"class="input" >
                                    </div>
                                    <div class="from-inputo-file">
                                        <div class="button rightbt "><i class='fas fa-lock'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bt02" id="addreward" data-reward="1">เพิ่มรางวัลภารกิจ</div>
                            <small id="quest_namehelps" class="form-text text-danger">*โปรดระบุรางวัลของภารกิจ ให้สอดคล้องกับรางวัลที่ผู้มอบหมายภารกิจ ต้องการมอบให้เป็นรางวัลกับนักผจญภัยจริง ๆ</small>
                            <small id="quest_namehelps" class="form-text text-danger">*“ได้รับทุกรายการ” คือนักผจญภัย “ต้องได้รับ” รางวัลทุกรายการที่ระบุไว้ใน รายการของรางวัลภารกิจ</small>
                            <small id="quest_namehelps" class="form-text text-danger">* “เลือกรับอย่างใดอย่างหนึÉง” คือ นักผจญภัย “ต้องเลือกรับ” รางวัลของภารกิจอย่างใดอย่างหนึÉง จากรายการของรางวัล
                                ทัÊงหมดที่ระบุไว้ (สามารถตัÊงรางวัลเป็นแพคเกจ ตัวเลือกทีÉ 1 2 3 ได้)
                            </small>
                            <small id="quest_namehelps" class="form-text text-danger">*สามารถตัÊงรางวัลของภารกิจเป็นของสะสมได้ โดยระบุหน่วยเป็น ชิÊน, อัน, แท่ง ฯลฯ
                            </small>
                            <small id="quest_namehelps" class="form-text text-danger">*กรณีของรางวัลเป็นเงิน กรุณาระบุ “สกุลเงิน”</small>

                        </div>
                        <div class="form-group mb-5">
                            <span class="text-dark h4" style="border-bottom: 0.2rem black solid;">
                                Sub Information | ข้อมูลเพิ่มเติม
                            </span>
                        </div>
                        <div class="form-group mb-5">
                            <label for="quest_adventure_type_1" class="h4 text-dark mb-3">Quest Boukensha | จำนวนนักผจญภัยสำหรับทำภารกิจ</label>
                            <div class="form-check border-bottom border-dark mb-3">
                                <input class="form-check-input" type="radio" name="quest_human" id="quest_adventure_type_1" value="1" checked>
                                <label class="form-check-label text-dark" for="quest_adventure_type_1">
                                    นักผจญภัย 1 คน
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="quest_human" id="quest_adventure_type_2" value="2">
                                <label class="form-check-label text-dark" for="quest_adventure_type_2">
                                    นักผจญภัยมากกว่า 1 คน
                                </label>
                                <input type="number" class="form-control mt-2 d-none" id="quest_adventure_num" name="quest_adventure_num" aria-describedby="quest_namehelps" placeholder="กรณีต้องการนักผจญภัยมากกว่า 1 คน โปรดระบุจำนวนนักผจญภัย ที่ต้องการเพื่อทำภารกิจ...">
                            </div>
                            <small id="quest_namehelps" class="form-text text-danger">*โปรดระบุจํานวนนักผจญภัยที่ต้องการเพื่อทําภารกิจ</small>

                        </div>
                        <div class="form-group mb-5">
                            <label for="quest_name" class="h4 text-dark mb-3">Quest Duration | ระยะเวลาสำหรับทำภารกิจ</label>
                            <div class="form-check border-bottom border-dark mb-1">
                                <input class="form-check-input" type="radio" name="quest_duration" id="quest_adventure_duration_1" value="1" checked>
                                <label class="form-check-label text-dark" for="quest_adventure_duration_1">
                                    ไม่จำกัดระยะเวลา
                                </label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="quest_duration" id="quest_adventure_duration_2" value="2">
                                <label class="form-check-label text-dark" for="quest_adventure_duration_2">
                                    จำกัดระยะเวลา
                                </label>
                                <div id="quest-mores" class="d-none">
                                    <input type="number" class="form-control mt-2" id="quest_duration_day" name="quest_duration_day" aria-describedby="quest_duration_dayhelps" placeholder="กรณีจำกัดระยะเวลา โปรดระบุจำนวนวันสำหรับทำภารกิจ...">

                                </div>
                            </div>
                            <small id="" class="form-text text-danger">
                                *โปรดระบุระยะเวลาที่ต้องการสําหรับใช้ทําภารกิจ
                            </small>
                            <small id="" class="form-text text-danger">
                                *ภารกิจจํากัดระยะเวลา คือภารกิจที่ผู้มอบหมายภารกิจ ต้องการให้นักผจญภัยทําให้เสร็จภายในระยะเวลาทีÉกําหนด โดยเริ่มนับเวลาหลังจากนักผจญภัยได้รับภารกิจเรียบร้อยแล้ว (หน่วย วัน)
                            </small>
                        </div>
                        <div class="form-group mb-5">
                            <label for="quest_name" class="h4 text-dark mb-3">Quest Location | สถานที่สำหรับทำภารกิจ</label>
                            <div class="form-check border-bottom border-dark mb-3">
                                <input class="form-check-input" type="radio" name="quest_location" id="quest_location_online" value="1" checked>
                                <label class="form-check-label text-dark" for="quest_location_online">
                                    ออนไลน์ (Work From Home)
                                </label>
                            </div>
                            <!-- map -->
                            <div class="form-group mt-3" id="location-on">
                                <label for="quest_local_online" class="text-dark">สถานที่ตั้ง Google Map</label>
                                <input type="search" name="quest_location_map" id="quest_local_online" placeholder="กรอกสถานที่ สถานที่ใกล้เคียง หรือกรอกละติจูด และลองจิจูด" class="form-control">
                            </div>

                            <div id="show-map"></div>
                            <!-- map end -->
                            <div class="form-check mt-3 mb-3">
                                <input class="form-check-input" type="radio" name="quest_location" id="quest_location_offline" value="2">
                                <label class="form-check-label text-dark" for="quest_location_offline">
                                    ออฟไลน์
                                </label>
                                <textarea class="form-control d-none" name="quest_adventure_location" id="quest_adventure_location" rows="3" placeholder="กรณีออฟไลน์ โปรดระบุสถานที่ เช่น ชื่อสถานที่ ตำแหน่งที่ตั้ง..."></textarea>
                            </div>
                            <div id="show-map2"></div>
                            <div class="form-group mb-5">
                                <label for="quest_title" class="text-dark h4 mb-3">QuestCategories | ประเภทของภารกิจ</label>
                                <div>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="quest_catagory" id="quest_type_online" value="1" checked> ออนไลน์
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="quest_catagory" id="quest_type_offline" value="2"> ออฟไลน์
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5" id="catagory-online">
                                <label for="quest_title" class="text-dark mb-3">ประเภทภารกิจออนไลน์</label>
                                <div class="row">
                                    <?php $sql_cate = " SELECT * FROM categories WHERE categories_status = 'Online'";
                                    $result_cate = mysqli_query($conn, $sql_cate);
                                    $no = 0;
                                    while ($rs_cat = mysqli_fetch_assoc($result_cate)) {
                                        ?>
                                        <div class="custom-control custom-radio col-md-3 mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio<?= $no ?>" name="quest_category_id" value="<?= $rs_cat['id'] ?>">
                                            <label for="customRadio<?= $no ?>" class="custom-control-label text-dark"><?= $rs_cat['categories_name'] ?></label>
                                        </div>
                                        <?php
                                        $no++;
                                    } ?>
                                    <div class="custom-control custom-radio col-md-3 mb-3">
                                        <input class="custom-control-input" type="radio" id="customRadio_other" name="quest_category_id" value="0">
                                        <label for="customRadio_other" class="custom-control-label text-dark">อื่นๆ</label>
                                        <input type="text" class="form-control" name="quest_category_note" id="off_other">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5 d-none" id="catagory-offline">
                                <label for="quest_title" class="text-dark mb-3">ประเภทภารกิจออฟไลน์</label>
                                <div class="row">
                                    <?php $sql_cate = " SELECT * FROM categories WHERE categories_status = 'Offline'";
                                    $result_cate = mysqli_query($conn, $sql_cate);
                                    $no = 0;
                                    while ($rs_cat = mysqli_fetch_assoc($result_cate)) {
                                        ?>
                                        <div class="custom-control custom-radio col-md-3 mb-3">
                                            <input class="custom-control-input" type="radio" id="customRadio2<?= $no ?>" name="quest_category_id2" value="<?= $rs_cat['id'] ?>">
                                            <label for="customRadio2<?= $no ?>" class="custom-control-label text-dark"><?= $rs_cat['categories_name'] ?></label>
                                        </div>
                                        <?php
                                        $no++;
                                    } ?>
                                    <div class="custom-control custom-radio col-md-3 mb-3">
                                        <input class="custom-control-input" type="radio" id="customRadio_other2" name="quest_category_id2" value="0">
                                        <label for="customRadio_other2" class="custom-control-label text-dark">อื่นๆ</label>
                                        <input type="text" class="form-control" name="quest_category_note2" id="off_other2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-5">
                                <span class="text-dark h4" style="border-bottom: 0.2rem black solid;">
                                    Mura Information | ข้อมูลของผู้มอบหมายภารกิจ
                                </span>
                            </div>
                            <div class="form-group mb-5">
                                <label for="quest_assignor" class="h4 text-dark mb-3">Mura Name | ชื่อผู้มอบหมายภารกิจ</label>
                                <input type="text" class="form-control" name="quest_assignor" id="quest_assignor">
                                <small id="quest_duration_dayhelps" class="form-text text-danger">
                                   *ชื่อที่ผู้มอบหมายภารกิจบันทึกลงบนกระดานภารกิจ ถือเป็นข้อมูลที่เปิดเผยต่อสาธารณะ
                               </small>
                               <small id="quest_duration_dayhelps" class="form-text text-danger">
                                   *สามารถระบุชื่อตาม Username ของผู้ใช้บริการ หรือนามแฝงอื่น ๆ เพื่อใช้ระบุชื่อของผู้ใช้บริการได้
                               </small>
                           </div>

                           <div class="form-group mb-5">
                            <label for="quest_assignor_address" class="h4 text-dark mb-3">Mura Contact | ช่องทางติดต่อผู้มอบหมายภารกิจ</label>
                            <div class="quest-contact">
                                <div class="from-uplosdinput form-contact-quest-01">
                                    <div class="from-inputo tet01">
                                        <h4 class="h3">ช่องทางติดต่อกลับ ลำดับที่ 1</h4>
                                    </div>
                                    <div class="from-inputo fm01">
                                        <input type="text" name="contactname[]" id="contactname" class="inputs" placeholder="ประเภทช่องทางการติดต่อ รางวัลภารกิจ" >
                                    </div>
                                    <div class="from-inputo fm01">
                                        <input  type="text" name="idcontact[]" id="idcontact" placeholder="โปรหระบุข้อมูลการติดต่อ"class="input" >
                                    </div>
                                    <div class="from-inputo-file bt-l">
                                        <div class="button rightbt "><i class='fas fa-lock'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bt02" id="addcontact" data-contact="1">เพิ่มช่องทางการติดต่อ</div>
                            <small id="quest_duration_dayhelps" class="form-text text-danger">
                               *ข้อมูลการติดต่อของผู้ใช้บริการจะ “ไม่” ถูกเปิดเผยต่อสาธารณะ เว้นแต่นักผจญภัยที่ประสงค์ต้องการขอรับภารกิจ หรือนักผจญภัยที่ได้รับมอบหมายภารกิจ เท่านั้น (ข้อมูลการติดต่อที่ผู้ใช้บริการระบบลงในส่วนนี้จะถูกซ่อน และเปิดเผยให้กับนักผจญภัยที่กดปุ่ม “สนใจรับภารกิจ” เท่านั้น)
                           </small>

                       </div>

                       <div class="form-group mb-5">
                        <label for="quest_assignor_address" class="h4 text-dark mb-3">Quest Mode | ประเภทของภารกิจ</label>
                        <div class="quest-Mode">
                            <div class="mode-l">
                                <div class="mode01-img">
                                    <img src="img/mode01.png" class="img">
                                </div>
                                <div class="mode01-img">
                                    <div class="form-check border-bottom border-dark mb-3">
                                        <input class="form-check-input" type="radio" name="modelgeneral" id="modelgeneral" value="0" checked>
                                        <label class="form-check-label tf" for="quest_adventure_type_1">
                                            ภารกิจทั่วไป
                                        </label>
                                        <div>
                                            ภารกิจทั่วไป คือ ภารกิจที่เปิดเผยข้อมูลการติดต่อของผู้มอบหมายภารกิจให้กับ <label style="color: #2196f3;">นักผจญภัยที่ส่งค่าขอรับภารกิจมายังเจ้าของภารกิจเท่านั้น </label>ข้อมูลของผู้มอบหมายภารกิจจะไม่ถูกเปิดเผยให้ต่อสาธาณะ
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mode-r">
                                <div class="mode01-img">
                                    <img src="img/mode02.png" class="img">
                                </div>
                                <div class="mode01-img">
                                    <div class="form-check border-bottom border-dark mb-3">
                                        <input class="form-check-input" type="radio" name="modelgeneral" id="modelgeneral" value="1" >
                                        <label class="form-check-label tf" for="quest_adventure_type_1">
                                            ภารกิจลับ
                                        </label>
                                        <div>
                                            ภารกิจลับ คือ ที่เปิดเผยข้อมูลการติดต่อของผู้มอบหมายภารกิจให้กับ <label style="color: #f21100;">นักผจญภัยจะได้รับเลือกให้ปฏิบัติภารกิจเท่านั้น </label>ข้อมูลของผู้มอบหมายภารกิจจะไม่ถูกเปิดเผยให้กับนักผจญภัยท่านอื่น

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="from-lert">
                                <small id="quest_duration_dayhelps" class="form-text text-danger">
                                    *เพื่อปกป้องความเป็นส่วนตัวของผู้ใช้บริการทั่ง “ภารกิจทั่วไป” และ “ภารกิจลับ” จะไม่เปิดเผยข้อมูลการติดต่อของ
                                    ผู้ใช้บริการสู่สาธารณะ เว้นแต่จะทําตามเงื่อนไขการปรากฏข้อมูลการติดต่อของผู้มอบหมายภารกิจข้างต้น โดย “ภารกิจทั่วไป” นัก
                                    ผจญภัยจะสามารถมองเห็นข้อมูลการติดต่อของผู้มอบหมายภารกิจเมื่อ “ส่งคําขอรับภารกิจ” และ “ภารกิจลับ” นักผจญภัยจะ
                                    สามารถมองเห็นข้อมูลการติดต่อของผู้มอบหมายภารกิจได้เมื่อ “ได้รับเลือกให้ปฏิบัติภารกิจ” นั้นเรียบร้อยแล้ว
                                </small>
                            </div>

                        </div>



                    </div>
                    <?php
                    if (!isset($_SESSION['guild_member']) && !isset($_SESSION['guild_member_login'])) {
                        ?>
                                           <!--  <div class="form-group mb-5">
                                                <label for="quest_code" class="h4 text-dark mb-3">Mura Code | ตัวเลข 6 ตัวเพื่อใช้ในการส่งมอบภารกิจกรณี IP ผู้มอบภารกิจมีการเปลี่ยนแปลง</label>
                                                <input type="text" class="form-control col-md-3" name="quest_code" id="quest_code" placeholder="กรอกตัวเลข 6 ตัว" required>
                                                <small id="quest_namehelps" class="form-text text-danger">บันทึกเลข IP Address หรือ Mura Code ของท่านเพื่อใช้ยืนยันสิทธิ์ในการยืนยันสถานะของภารกิจ (กรณีมอบหมายภารกิจโดยไม่ต้องลงทะเบียนสมัครสมาชิกเว็บไซต์)</small>
                                            </div> -->
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-12 text-center py-4">
                                        <p class="text-center text-dark">Add to Guild Board</p>
                                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response" value="">
                                        <div  class="button "  id="modelsever">บันทึกลงกระดานภารกิจ</div>
                                    </div>
                                    <div class="listDetalM"></div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 text-center"><i class="fas fa-scroll text-primary"></i>&nbsp; <a href="guild-board.php" class="text-danger font-weight-bold">กลับไปที่ Guild Board</a></div>
                            <div class="col-md-6 text-center"><i class="fas fa-dungeon text-primary"></i>&nbsp; <a href="index.php" class="text-danger font-weight-bold">กลับไปที่ Guild (หน้าหลัก)</a></div>
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

        <script src="guild_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Summernote -->
        <script src="guild_admin/plugins/summernote/summernote-bs4.min.js"></script>
        <!-- include summernote-th-TH -->
        <script src="guild_admin/plugins/summernote/lang/summernote-th-TH.min.js"></script>
        <!-- Datatable -->
        <script src="guild_admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="guild_admin/plugins/datatables/dataTables.bootstrap4.min.js"></script>
        <script src="guild_admin/plugins/datatables/data.th.js"></script>
        <!-- Sweetalert2 -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/sweetalert.min.js"></script>
        <script src="js/app.js"></script>

        <script src="//www.google.com/recaptcha/api.js?render=6LdwtpgUAAAAAHVJ3JlKJNiTEIzyUm53NNj32QXv"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdwtpgUAAAAAHVJ3JlKJNiTEIzyUm53NNj32QXv', {
                    action: 'login'
                }).then(function(token) {
                // ค่า token ที่ถูกส่งกลับมา จะถูกนำไปใช้ส่งไปตรวจสอบกับ api อีกครั้ง
                // เราเอาค่า token ไปไว้ใน input hidden ชื่อg-recaptcha-response
                document.getElementById('g-recaptcha-response').value = token;
                 // ทำฟังก์ชั่นเพิ่มเติม ถ้ามี
             });
            });

            




        </script>

    </body>

    </html>