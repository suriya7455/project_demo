<?php

require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
$table = 'member';
$table1 = 'quest_interested';
if ($_GET['m'] == 'add') {

	$sql = "SELECT * FROM quest_interested WHERE qi_id_quest = '".$_POST['idquest']."' AND qi_id_number = '".$_POST['idnumber']."'";
	$result = mysqli_query($conn, $sql);
    $rs = mysqli_fetch_assoc($result);



	$data =[
		'member_type_con01'=>$_POST['typenumber01'],
		'member_contact01'=>$_POST['numbercontact01'],
		'member_type_con02'=>$_POST['typenumber02'],
		'member_contact02'=>$_POST['numbercontact02'],
		'member_type_con03'=>$_POST['typenumber03'],
		'member_contact03'=>$_POST['numbercontact03'],
		
	];
	$where = 'id   ='.$_POST['idnumber'];
    update($table,$data,$where);

    if ($rs) {
    	$data1 =[
		'qi_details'=>$_POST['storynumber'],
		'qi_link'=>$_POST['linknumber'],
	 ];
	$where1 = 'qi_id ='.$rs['qi_id'];
   $id =  update($table1,$data1,$where1);
    }else{
    	$data1 =[
		'qi_id_quest'=>$_POST['idquest'],
		'qi_id_number'=>$_POST['idnumber'],
		'qi_details'=>$_POST['storynumber'],
		'qi_link'=>$_POST['linknumber'],
	 ];
	$id =  insert($table1,$data1);
    }
    
	if ($id) {
    	$data['success'] = '1';
    	$data['id_quest'] = $_POST['idquest'];
    	$data['id_number'] = $_POST['idnumber'];
    }else{
    	$data['success'] = '0';
    }
    echo json_encode($data);
    
}

if ($_GET['m'] == 'confern'){

	$data1 =[
		'qi_status_agree'=>'1'
	 ];
	$where1 = 'qi_id_quest ='.$_POST['idquest'].' AND qi_id_number = '.$_POST['idnumber'];
   $id =  update($table1,$data1,$where1);
   if ($id) {
    	$data['success'] = '1';
    }else{
    	$data['success'] = '0';
    }
    echo json_encode($data);
    

}

 ?>