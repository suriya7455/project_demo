<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boukensha Guild</title>

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
    <style>
        .bg-guilboard {
            background: url('images/bg_anime/bg_guilboard.jpg') no-repeat top center;
            -webkit-background-size: 100% 100%;
            -moz-background-size: 100% 100%;
            -o-background-size: 100% 100%;
            background-size: 100% 100%;
        }

        .text-guild {
            color: #050BD8;
        }
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
    <!-- Product Section Begin -->
    <section class="product spad" style="margin-bottom:0;padding-bottom:0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h3 class="text-center">พื้นที่โฆษณา</h3>
                        </div>
                        <p class="text-justify">เพื่อช่วยเหลือผู้ประกอบการ SME จากผลกระทบอันเนื่องมาจากภาวะ Covid-19 และเป็นการหารายได้ เพื่อใช้เป็นค่าดูแลรักษาระบบของเว็บไซต์ทาง Boukensha ขอสงวนพื้นที่โฆษณาให้กับผู้ประกอบการรายย่อยเท่านั้น ผู้ประกอบการท่านใดสนใจลงโฆษณาสามารถติดต่อได้ที่ Contract ของ Guild Master โดยทุก 1 Banner คิดค่าบริการเพียงวันละ 10 บาท (คิดค่าบริการเป็นรายเดือน) และลำดับการแสดง Banner จะถูกสุ่มการเรียงลำดับทุก 15 นาที ตลอด 24 ชม.

                            *หมายเหตุ ทางเว็บไซต์ขออนุญาติงดลงโฆษณาจาก เว็บพนัน เว็บที่มีเนื้อหาละเมิดลิขสิทธิ์ และเว็บไซต์ที่มีเนื้อหาอนาจารทุกรูปแบบ เพื่อรักษาบรรยากาศของการให้บริการ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Hero Section Begin -->
    <section class="hero"> 
        <div class="container">
            <div class="col-lg-12 text-right mb-3">
                <a class="font-weight-bold text-light" href="banner.php">โฆษณาทั้งหมด</a>
            </div>
            <div class="hero__slider owl-carousel">
                <?php
                $sql_banner_slider = " SELECT * FROM banner WHERE banner_status = 'เปิด' ORDER BY rand() LIMIT 0,5 ";
                $result_banner_slider = mysqli_query($conn, $sql_banner_slider);
                $num_i = 0;
                while ($rs_banner_slider = mysqli_fetch_assoc($result_banner_slider)) {
                    $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                    WHERE id = " . $rs_banner_slider['id'];
                    mysqli_query($conn, $sql_view);
                    $_SESSION['sess_ran_id'][$num_i] = $rs_banner_slider['id'];
                ?>
                    <div class="hero__items set-bg" data-setbg="images/banner/<?= $rs_banner_slider['banner_image'] ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="hero__text">
                                    <h2>&nbsp;</h2>
                                    <p>&nbsp;</p>
                                    <a href="banner.php" target="_blank"><span>ดูเพิ่มเติม</span> <i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $num_i++;
                } ?>
            </div>
        </div>
        <div class="col-lg-12 mb-6 mt-5">&nbsp;</div>
    </section>
    <!-- Hero Section End -->

    <!-- Guild Board Begin-->
         <section class="hero">
        <div class="container">
           <!--  <div class="col-lg-12 text-right mb-3">
                <a class="font-weight-bold text-light" href="banner.php">โฆษณาทั้งหมด</a>
            </div> -->
            <div class="hero__slider owl-carousel lo01" >
                    <?php
            $data = [];
            $sql_quest_limit7 = " SELECT * FROM quest WHERE quest_status = 'อยู่ระหว่างตามหานักผจญภัย' OR quest_status = 'นักผจญภัยรับภารกิจ' ORDER BY quest_created DESC LIMIT 0,10";
            $result_quest_limit7 = mysqli_query($conn, $sql_quest_limit7);
            $i = 1;
        $sql_quest_complete = " SELECT * FROM quest WHERE quest_status = 'ส่งมอบภารกิจ' ORDER BY quest_created DESC LIMIT 0,10";
        $result_quest_complete = mysqli_query($conn, $sql_quest_complete);
        $num_complete = mysqli_num_rows($result_quest_complete);

             ?>
            <div class="" data-setbg="">
                        <div class="lo01">
            <h3 class="Board-01">Guild Board</h3>
              <h4 class="text-center text-guild font-weight-bold t4" ><a href="new-quest.php" class="text-guild">New Quest</a></h4>
              <div class="from-table">
              <table id="customers">
                <tr class="text-nowrap">
                     <th class="text-center">Quest Name</th>
                     <th class="text-center">Quest Assignor</th>
                     <th class="text-center">Rewards</th>
                     <th class="text-center">Status</th>
                </tr>
                <?php while ($rs_quest_limit7 = mysqli_fetch_assoc($result_quest_limit7)) { ?>
                 <tr>
                     <td>
                        <div class="t-a01">
                        <a class="text-guild" href="quest-detail.php?id=<?= $rs_quest_limit7['id'] ?>"><?= questnameIndex2($rs_quest_limit7['quest_name']) ?></a>
                        </div>
                    </td>
                      <td class="text-center"><?= $rs_quest_limit7['quest_assignor'] ?></td>
                      <td class="text-center"><?= $rs_quest_limit7['quest_reward'] ?></td>
                      <td class="text-center"><?= quest_sta($rs_quest_limit7['quest_status']) ?></td>
                    </tr>
                 <?php  } ?>
            </table>
            <div class="listallouest">
                <a href="new-quest.php" class="text-guild">ดูรายการเควสทั้งหมด</a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                                <a href="quest-add.php" class="btn btn-lg btn-success">มอบหมายภารกิจ</a>
                            </div>
            </div>
            </div>
        </div>

    <!-- ------------------------------------------------ -->

    <div class="" data-setbg="">
                        <div class="lo01">
            <h3 class="Board-01">Guild Board</h3>
              <h4 class="text-center text-guild font-weight-bold t4" ><a href="new-quest.php" class="text-guild">Last Complete Quest</a></h4>
              <div class="from-table">
              <table id="customers">
                <tr class="text-nowrap">
                   <th class="text-center">Quest Name</th>
                   <th class="text-center">Boukensha</th>
                   <th class="text-center">Rewards</th>
                   <th class="text-center">Status</th>
                                            </tr>
            <?php if ($num_complete > 0) {
            while ($rs_quest_complete = mysqli_fetch_assoc($result_quest_complete)) { ?>
                  <tr>
        <td><a class="text-guild" href="quest-detail.php?id=<?= $rs_quest_complete['id'] ?>"><?= questnameIndex2($rs_quest_complete['quest_name']) ?></a></td>
        <td class="text-center"><?= $rs_quest_complete['quest_assignor'] ?></td>
       <td class="text-center"><?= $rs_quest_complete['quest_reward'] ?></td>
        <td class="text-center"><?= quest_sta($rs_quest_complete['quest_status']) ?></td>
        </tr>
        <?php }
        } else { ?>
             <tr>
        <td colspan="4" class="text-center">ยังไม่มีนักผจญภัยรับภารกิจทำภารกิจสำเร็จ</td>
        </tr>
     <?php } ?>
            </table>
            <div class="listallouest">
                <a href="new-quest.php" class="text-guild">ดูรายการเควสทั้งหมด</a>
            </div>
            <div class="col-md-12 mt-5 text-center">
                <a href="quest-add.php" class="btn btn-lg btn-success">มอบหมายภารกิจ</a>
            </div>
            </div>
            </div>
        </div>
                
            </div>
        </div>
        <div class="col-lg-12 mb-6 mt-5">&nbsp;</div>
    </section>
    <!-- Guild Board End-->

    <!-- Guild Quest Location Begin-->
    <section class="product spad" style="margin-bottom:0;padding-bottom:0; margin-bottom:4rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="anime__details__text">
                        <div class="anime__details__title">
                            <h2 class="text-center text-white font-weight-bold">Quest Location</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <?php
                    $sql_random_map = " SELECT quest_location_map FROM quest WHERE quest_status = 'อยู่ระหว่างตามหานักผจญภัย' AND quest_location = 'Online' ORDER BY RAND() LIMIT 0,1 ";
                    $result_random_map = mysqli_query($conn, $sql_random_map);
                    $rs_random_map = mysqli_fetch_assoc($result_random_map);

                    $map = $rs_random_map['quest_location_map'];
                    if ($map != "") {
                        $array_date = explode(')', $map);
                        $msg1 = $array_date[0];
                        $msg2 = $array_date[1];

                        $key = str_replace("(", "", $msg1);
                        $latlong = str_replace(" ", "", $key);
                    ?>
                        <iframe width="100%" height="500px" style="border:0;" allowfullscreen="" loading="lazy" src="https://maps.google.com/maps?q=<?= $latlong ?>&hl=th;z=14&amp;output=embed"></iframe>
                    <?php  } else { ?>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62029.81938578727!2d100.58150065810763!3d13.66605004307632!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e2a00bb218f43d%3A0x30100b25de25070!2z4LmB4LiC4Lin4LiHIOC4muC4suC4h-C4meC4siDguYDguILguJXguJrguLLguIfguJnguLIg4LiB4Lij4Li44LiH4LmA4LiX4Lie4Lih4Lir4Liy4LiZ4LiE4Lij!5e0!3m2!1sth!2sth!4v1644934835380!5m2!1sth!2sth" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <?php } ?>
                </div>
                <div class="col-md-12" style="margin-top: 3rem;">
                    <p class="text-center text-light">ขณะนี้พวกเราอยู่ใน</p>
                    <h3 class="text-center text-light">Origin Phase</h3>
                    <p class="text-left text-light">ฟังก์ชั่นที่มีอยู่ในขณะนี้</p>
                    <div class="mb-2 text-light p-1">
                        <i class="far fa-circle text-primary" style="font-size: 0.5rem;"></i> &nbsp; มอบหมายภารกิจ และประกาศหานักผจญภัยบน Guild Board ของ Boukensha Guild
                    </div>
                    <div class="mb-2 text-light p-1"> <i class="far fa-circle text-primary" style="font-size: 0.5rem;"></i> &nbsp; ติดต่อรับภารกิจในฐานะ "นักผจญภัย"</div>
                    <div class="mb-2 text-light p-1"> <i class="far fa-circle text-primary" style="font-size: 0.5rem;"></i> &nbsp; ส่งมอบภารกิจ และรับรางวัลจากผู้ว่าจ้าง</div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <h3 class="mt-3 text-light text-center mb-3">แนวคิดของ Boukensha Guild</h3>
                            <h4 class="text-light">เปลี่ยนวิธีการสร้างรายได้ให้เข้ากับ "ยุคสมัยใหม่"</h4>
                            <p class="text-justify text-light">
                                Boukensha Guild มีความหมายว่า กิลด์นักผจญภัย สถานที่แห่งนี้จัดตั้งขึ้นเพื่อเป็นสถานที่ให้กับบุคคลทั่วไปที่มีความต้องการอยากว่าจ้างนักผจญภัยเพื่อทำภารกิจ (Quest) โดยไม่จำกัดขอบเขตว่าจะเป็นเรื่องเล็กน้อยเพียงใด ตราบที่มีนักผจญภัยสนใจรับภารกิจแล้วละก็ ไม่ว่าจะเป็นภารกิจแบบไหนย่อมสามารถลงประกาศว่าจ้างนักผจญภัยบน Guild Board ของ Boukensha Guild แห่งนี้ได้อย่างอิสระ
                            </p>
                            <h4 class="text-light">กิลด์นักผจญภัยแห่งนี้จะเติบโตไปพร้อมกับความทะเยอทะยานของการสร้างรายได้</h4>
                            <p class="text-justify text-light">
                                ขยายนิยามของการว่าจ้างและการรับงาน ฉีกข้อจำกัดเดิม ๆ ของการหารายได้จากการทำงานให้เปิดกว้าง ที่แห่งนี้อนุญาติให้ทุกคนสามารถมอบหมายภารกิจ (Quest) ในฐานะ “ผู้ว่าจ้าง” และสามารถรับภารกิจจากผู้ว่าจ้างคนอื่นในฐานะ “นักผจญภัย” (Boukensha) ได้อย่างอิสระ อีกทั้งทุกคนย่อมสามารถเป็นได้ทั้งผู้ว่าจ้างและนักผจญภัยในคนเดียวกัน

                                ภารกิจที่ฝากไว้บนกระดานของ Boukensha Guild ผู้ว่าจ้างทุกคนสามารถเลือกที่จะว่าจ้างอะไรก็ได้ ตามนิยามการว่าจ้างภารกิจของ Boukensha Guild รวมถึงมีสิทธิที่จะสามารถกำหนดเงินรางวัลให้กับภารกิจของตนเองได้ตามความพึงพอใจ อย่างไรก็ดีอย่าลืมตั้งรางวัลภารกิจ (Rewards) เหล่านั้นให้มีความ “ยุติธรรม” พอที่จะดึงดูดเหล่านักผจญภัยให้เข้ามาทำภารกิจได้ โดยรางวัลภารกิจไม่ได้หมายถึงเพียงแค่เงินเท่านั้น ผู้ว่าจ้างมีสิทธิที่จะว่าจ้างด้วยสิ่งอื่นแทนได้ อาทิ ไอเทมในเกม ของสะสม ภาพNFT หรือสินทรัพย์ดิจิตอล หรือสามารถตั้งรางวัลของภารกิจโดยให้นักผจญภัยมีสิทธิที่จะเลือกของรางวัลที่ตนเองจะได้รับด้วยเช่นกัน
                            </p>
                            <h4 class="text-light">เป็นสถานที่ที่ดีสำหรับการจัดกิจกรรม</h4>
                            <p class="text-justify text-light">
                                ผู้จัดงานหรือกิจกรรมต่าง ๆ สามารถนำกิจกรรมของท่านมาติดประกาศไว้บนกระดานของ Boukensha Guild เพื่อแสดงของรางวัลกิจกรรมของท่านให้เห็นเด่นชัด และดึงดูดเหล่านักผจญภัยให้เข้าร่วมกิจกรรม อีกทั้งยังสามารถช่วยสร้างความตื่นเต้นให้กิจกรรมได้ด้วยเช่นกัน </p>
                            <h4 class="text-light">“วิธีการจ้างงานย่อมเปลี่ยนไปเพื่อให้เข้ากับยุคสมัย”</h4>
                            <p class="text-justify text-light">
                                มันไม่ง่ายเลยที่ทุกคนจะสามารถทำงานได้เหมือนเดิมในยุคสมัยที่ไม่มีอะไรเหมือนเดิมอีกต่อไป ผลกระทบจากการทรุดตัวของเศรษฐกิจกำลังคุกคามคุณภาพชีวิตของทั้งฝั่งลูกจ้างและผู้ประกอบการ แน่นอนว่าการจ้างงานตามความต้องการพื้นฐานในโครงสร้างของระบบเศรษฐกิจเดิมที่ทำงานกันแบบ Offline ยังมีความจำเป็นอยู่ แต่ดังที่ได้กล่าวไปแล้วว่า เศรษฐกิจกำลังทรุดตัว ข้อเท็จจริงนี้เป็นปรากฏการที่เกิดขึ้นในเกือบทุกมิติของระบบเศรษฐกิจทั่วโลก

                                ในยุคสมัยที่โลกภายนอกไม่ได้เป็นมิตรกับชีวิตมนุษย์เราเท่าเมื่อหลายปีก่อน ประกอบกับการเติบโตทางด้านเทคโนโลยีเครือข่ายดิจิตอลที่ปรับตัวขึ้นอย่างก้าวกระโดด ช่วงเวลานี้จึงนับว่าเป็นโอกาสอันเหมาะสมที่จะปรับเปลี่ยนมุมมองในการหารายได้ใหม่ให้สอดคล้องกับสถานการณ์ปัจจุบัน

                                Boukensha Guild จัดตั้งขึ้นเพื่อนำเสนอแนวคิดในการหารายได้โดยไม่จำเป็นต้องยึดติดกับรูปแบบการสร้างรายได้แบบเดิม ๆ ไม่จำเป็นต้องผูกมัดเงินและงานอีกต่อไป (Money &Work) แต่เปลี่ยนเป็นเงินและไลฟ์สไตล์ (Money &Lifestyle) ซึ่งหมายถึงการสร้างรายได้ตามไลฟ์สไตล์ของตนเอง

                                ทาง Boukensha Guild ก่อตั้งขึ้นด้วยวิสัยทิศน์ที่ว่ามนุษย์เราควรมีอิสระ อิสระที่จะมีความสุขกับการทำสิ่งที่ตนต้องการและ ควรมีอิสระที่จะละทิ้งสิ่งเหล่านั้นได้ทันที หากวันหนึ่งเขาได้ทดลองทำบางอย่างแล้วพบว่าเขาไม่ได้มีความสุขในการทำมันอีกต่อไป และย่อมมีอิสระที่จะกลับมาทำสิ่งเหล่านั้นได้อีกขอเพียงแค่เขาปรารถนาจะทำมันอีกครั้งเพียงเท่านั้น การสร้างงานและหารายได้ทั้งหมดบน Boukensha Guild เป็นเพียงก้าวเล็ก ๆ ที่จะนำพาผู้ใช้บริการก้าวไปยังเส้นทาง ที่สามารถหารายได้อย่างมีอิสระภาพ เมื่อมนุษย์เราสามารถทำสิ่งที่ตนเองชอบหรือถนัดได้โดยไม่จำเป็นต้องพะว้าพะวงว่าวันพรุ่งนี้จะกินอะไร หรือจะหาเงินที่ไหนมาใช้หนี้ บางทีมนุษย์เราอาจแสดงศักยภาพออกมาได้ดีกว่าอย่างเทียบไม่ได้เมื่อเขาได้ทำในสิ่งที่พวกเขารัก เพราะทุกการกระทำไม่ได้สำเร็จด้วยเพียงหยาดเหงื่อและแรงกาย แต่ยังรวมถึง “หัวใจ” ของพวกเขาด้วยเช่นกัน
                            </p>
                        </div>
                        <div class="col-md-2">
                            <div class="overflow-auto" style="height:55rem; width:100%" id="ads-random-15">
                                <?php
                                $b_id1 = $_SESSION['sess_ran_id'][0];
                                $b_id2 = $_SESSION['sess_ran_id'][1];
                                $b_id3 = $_SESSION['sess_ran_id'][2];
                                $b_id4 = $_SESSION['sess_ran_id'][3];
                                $b_id5 = $_SESSION['sess_ran_id'][4];
                                $sql_banner1 = " SELECT * FROM banner WHERE banner_status = 'เปิด' AND id <> '$b_id1' AND id <> '$b_id2' AND id <> '$b_id3' AND id <> '$b_id4' AND id <> '$b_id5' ORDER BY RAND () LIMIT 15 ";
                                $result_banner1 = mysqli_query($conn, $sql_banner1);
                                while ($rs_banner1 = mysqli_fetch_assoc($result_banner1)) {
                                    $sql_view = " UPDATE banner SET banner_num = banner_num+1 
                                    WHERE id = " . $rs_banner1['id'];
                                    mysqli_query($conn, $sql_view);
                                ?>
                                    <div class="col-md-12">
                                        <a href="ads-link.php?b_id=<?= $rs_banner1['id'] ?>" target="_blank"><img src="images/banner/<?= $rs_banner1['banner_image'] ?>" class="img-fluid rounded mt-1 mb-1" alt="<?= $rs_banner1['banner_title'] ?>"></a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
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
    <script src="js/jquery-3.3.1.min.js"></script>
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

    <!-- Summernote -->
    <script src="guild_admin/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- include summernote-th-TH -->
    <script src="guild_admin/plugins/summernote/lang/summernote-th-TH.min.js"></script>

    <!-- fancybox -->
    <script src="guild_admin/plugins/fancybox/fancybox.umd.js"></script>

    <!-- Sweetalert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="js/app.js"></script>
    <script>
        // auto refresh banner
        /* Refresh  Dashboard_welcome */
        function refresh_banner2() {
            window.location.reload();
        }
        refresh_dash2 = setInterval(refresh_banner2, 900000);
    </script>
</body>

</html>