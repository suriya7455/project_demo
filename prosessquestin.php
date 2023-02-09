<?php

require 'config/connect.php';
require 'config/function.php';
require 'config/stat.php';
$table = 'member';
$table1 = 'quest_interested';
$table2 = 'quest';
$table3 = 'quest_activity_detail';

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


if ($_GET['m'] == 'putRequest'){

	$sqlin = "SELECT * FROM quest_interested WHERE qi_id_quest  = '".$_POST['idq']."' and qi_status = 1";
	$resultin = mysqli_query($conn, $sqlin);
	$rowcount = mysqli_num_rows($resultin);


	$sql = "SELECT * FROM quest WHERE id = '".$_POST['idq']."'";
	$result = mysqli_query($conn, $sql);
	$rs = mysqli_fetch_assoc($result);

	if ($rs['quest_human'] == 'นักผจญภัย 1 คน') {
		$nummenber = 1;
	}else{
		$nummenber = $rs['quest_human_more'];
	}
     //echo $rowcount.'-'.$rowcount; die;
	if ($nummenber > $rowcount) {

		$nummenber = $nummenber - 1;
		if ($nummenber == '0') {
			$data1 =[
				'quest_status'=>2
			];
			$where1 = 'id  ='.$_POST['idq'];
			update($table2,$data1,$where1);
		}
		$sql_ac = "INSERT INTO quest_activity_detail SET
		id = NUll,
		quest_id = '".$_POST['idq']."',
		member_id = '".$_POST['idn']."',
		guest_name = '".$_POST['name']."',
		guest_password = '',
		guest_ip = '',
		activety_status = 2,
		quest_atv_created = CURRENT_TIMESTAMP
		";
		$result_ac = mysqli_query($conn, $sql_ac);

		$data2 =[
			'qi_status'=>'1'
		];
		$where2 = 'qi_id_quest ='.$_POST['idq'].' AND qi_id_number = '.$_POST['idn'];
		$id =  update($table1,$data2,$where2);
		if ($id) {
			$data['success'] = '1';
			$data['num'] = $rowcount +1 ;
		}else{
			$data['success'] = '0';
		}




	}else{
		$data['success'] = '2';

	}

	echo json_encode($data);
}


if ($_GET['m'] == 'cancenRequest'){

	$sqlin = "SELECT * FROM quest_interested WHERE qi_id_quest  = '".$_POST['idq']."' and qi_status = 1";
	$resultin = mysqli_query($conn, $sqlin);
	$rowcount = mysqli_num_rows($resultin);


	$sql = "SELECT * FROM quest WHERE id = '".$_POST['idq']."'";
	$result = mysqli_query($conn, $sql);
	$rs = mysqli_fetch_assoc($result);

	if ($rs['quest_human'] == 'นักผจญภัย 1 คน') {
		$nummenber = 1;
	}else{
		$nummenber = $rs['quest_human_more'];
	}

	$data1 =[
		'quest_status'=>1
	];
	$where1 = 'id  ='.$_POST['idq'];
	update($table2,$data1,$where1);

	$where3 = 'quest_id  ='.$_POST['idq'].'&member_id='.$_POST['idn'];
	delete($table3, $where3);
	$data2 =[
		'qi_status'=>'0'
	];
	$where2 = 'qi_id_quest ='.$_POST['idq'].' AND qi_id_number = '.$_POST['idn'];
	$id =  update($table1,$data2,$where2);
	if ($id) {
		$data['success'] = '1';
		$data['num'] = $rowcount -1 ;
	}else{
		$data['success'] = '0';
	}

	echo json_encode($data);
}

if ($_GET['m'] == 'missionRequest'){

	$data1 =[
		'quest_status'=>3
	];
	$where1 = 'id  ='.$_POST['idq'];
	update($table2,$data1,$where1);

	$data2 =[
		'qi_mission'=>'1'
	];
	$where2 = 'qi_id_quest ='.$_POST['idq'].' AND qi_id_number = '.$_POST['idn'];
	$id =  update($table1,$data2,$where2);
	if ($id) {
		$data['success'] = '1';
		//$data['num'] = $rowcount -1 ;
	}else{
		$data['success'] = '0';
	}
	echo json_encode($data);


}

?>