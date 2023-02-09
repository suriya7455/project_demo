<?php
require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';





$sql = "SELECT * from quest_activity_detail INNER JOIN quest on quest_activity_detail.quest_id = quest.id   WHERE quest.quest_status = 3 AND quest_activity_detail.member_id = '".$_GET['idnumber']."' ORDER BY quest_activity_detail.id DESC";

 $result = mysqli_query($conn, $sql);
   $res = mysqli_fetch_assoc($result);

   if ($res) {
   	$link = 'http://localhost/project_anime/quest-detail.php?id='.$res['id'];
   }else{

   	$link = '';
   }


   $sqlnumber = "SELECT member_username,member_type_con01,member_contact01,member_type_con02,member_contact02,member_type_con03,member_contact03 from member   WHERE id = '".$_GET['idnumber']."'";
    $resultnum = mysqli_query($conn, $sqlnumber);
   $resnum = mysqli_fetch_assoc($resultnum);


    $sqlinter = "SELECT * from quest_interested WHERE qi_id_number = '".$_GET['idnumber']."' AND qi_id_quest = '".$_GET['idquest']."'";
    $resultimter = mysqli_query($conn, $sqlinter);
   $resinter = mysqli_fetch_assoc($resultimter);

   if ($resinter) {
   	$detailsnum = $resinter['qi_details'];
   }else{
	$detailsnum  = '';
   }

?>
<style type="text/css">
	.hname{text-align: center;    margin-bottom: 15px;}
	.form-detail{width: 100%;}
	.form-name-detail{width: 100%;float: left;margin-bottom: 5px}
	.co-l{width: 100%;}
	.co-r{width: 100%;}
	.active{    background: #dadada;}
	textarea {
      width: 100%;
    height: 90px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;
        font-size: 14px;
}
input{border: 1px solid #ccc;
    border-radius: 4px;
    padding: 3px 6px;
    font-size: 15px;
    width: 100%;}
.t-alert{color: red;
    width: 90%;
    padding: 0px 10px;
    font-size: 10px;}
    .co-r-01{width: 50%;float: left;}
    .co-r-02{    width: 45%;float: left;}
    .lin{margin-bottom: 20px;}

    @media screen and (min-width: 1024px){
    	textarea {width: 90%;}
    	.co-l{width: 30%;float: left;text-align: right;}
	.co-r{width: 70%;float: right;padding: 0px 5px;}
	input{width: 90%;}
	

    }
    @media screen and (min-width: 1280px){
    	.co-l{    width: 32%;}
    .co-r{width: 67%;}
    }
</style>

<h3 class="hname">BOUKENSHA CONTRACT INFORMATION</h3>
<hr>
<h5 class="hname">ข้อมูลการติดต่อกลับนักผจญภัย</h5>
<div class="form-detail">
	<div class="form-name-detail">
		<div class="co-l">
			<label>ชื่อของนักพจญภัย : </label>
		</div>
		<div class="co-r">
			<input type="text" name="name" id="name" value="<?= $resnum['member_username'] ?>" readonly>
			<input type="hidden" name="idname" id="idname" value="<?= $_SESSION['guild_id'] ?>" readonly>
			<input type="hidden" name="idquest" id="idquest" value="<?= $_GET['idquest'] ?>" readonly>

		</div>
	</div>
	<div class="form-name-detail">
		<div class="co-l">
			<label>แนะนำตัวคร่าว ๆ : </label>
		</div>
		<div class="co-r">
			<textarea id="storynumber" placeholder="อธิบายเกี่ยวคุณสมบัติของตัวท่านคร่าวๆ เช่น อาชีพ ประสบการณืทำงาน หรือคุณสมบัติอื่นๆ ที่เกี่ยวข้องกับภารกิจ (จำกัด 350 ตัวอักษร...)"maxlength  ="350" readonly><?=$detailsnum ; ?></textarea>
			
			
		
		</div>
		
	</div>
	<div class="form-name-detail lin">
		<div class="co-l">
			<label>ลิงค์ตัวอย่างผลงาน : </label>
		</div>
		<div class="co-r">
			
			<a href="<?= $resinter['qi_link'];  ?>"><input type="text" name="linknumber" id="linknumber" placeholder="โปรดแนบลิ้งค์ เพื่อแสดงตัวอย่างผลงานของท่าน" value="<?= $resinter['qi_link'];  ?>" readonly></a>
			
			
		</div>
	</div>
	<div class="form-name-detail">
		<div class="co-l">
			<label>ช่องทางติดต่อกลับ 1 : </label>
		</div>
		<div class="co-r">

			<div class="co-r-01">
				<input type="text" name="typenumber01" id="typenumber01"placeholder="ชื่อช่องทางติดต่อกลับ..." value="<?=$resnum['member_type_con01']; ?>" >
			</div>
			<div class="co-r-02">
				<input type="text" name="numbercontact01" id="numbercontact01" placeholder="ข้อมูลการติดต่อกลับ..." value="<?=$resnum['member_contact01']; ?>" >
			</div>
		</div>
	</div>
	<div class="form-name-detail">
		<div class="co-l">
			<label>ช่องทางติดต่อกลับ 2 : </label>
		</div>
		<div class="co-r">

			<div class="co-r-01">
				<input type="text" name="typenumber02" id="typenumber02" placeholder="ชื่อช่องทางติดต่อกลับ..." value="<?=$resnum['member_type_con02']; ?>" >
			</div>
			<div class="co-r-02">
				<input type="text" name="numbercontact02" id="numbercontact02" placeholder="ข้อมูลการติดต่อกลับ..." value="<?=$resnum['member_contact02']; ?>" >
			</div>
		</div>
	</div>
	<div class="form-name-detail">
		<div class="co-l">
			<label>ช่องทางติดต่อกลับ 3 : </label>
		</div>
		<div class="co-r">

			<div class="co-r-01">
				<input type="text" name="typenumber03" placeholder="ชื่อช่องทางติดต่อกลับ..." value="<?=$resnum['member_type_con03']; ?>" id="typenumber03" >
				
			</div>
			<div class="co-r-02">
				<input type="text" name="numbercontact02" id="numbercontact03" placeholder="ข้อมูลการติดต่อกลับ..." value="<?=$resnum['member_contact03']; ?>" >
				
			</div>
		</div>
	</div>

</div>