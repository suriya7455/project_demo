// การเรียกใช้ function previewModal 
// linkModal = ไฟล์หน้าที่ต้องการแสดงข้อมูลใน modal  
//classPreview = class ที่แสดงไฟล์ modal
// hasder = หัวข้อที่ต้องการแสดงใน modal
// styModal = เลือกขนาดของ modal
var link = 'http://localhost/project_anime/';

function previewModallist(linkModal,classPreview,hasder,styModal,Texttb,tb){

	if (styModal == 'mini') {

		var modalmini = 'modal-content-mini';
	}else{

		var modalmini = 'modal-content';
	}
	
	if (tb != "") {
		var btt = '<div class="modal-footer"><div class="tbA" id="'+tb+'">'+Texttb+'</div></div>';
	}else{
		var btt = '';

	}


	$('.'+classPreview).html('<div id="myModal" class="modal"><div class="'+modalmini+'"><div class="modal-headeryT"><div class="modal-headerss"><img src="plugin/myModal/02.jpg" class="imgmodel">'+
		'</div><div class="modal-bodyss"><div class="modal-body-detilw"></div><hr><div class="modal-agree">'+
		'<div class="serveral"></div>'+
		'<div class="bt-form"><div class="button1 wy closet">ยกเลิก</div><div class="button1" id="next">ถัดไป >></div></div></div></div><div>'+btt);

	$('.modal-body-detilw').load(linkModal);
	closeModal();
	next();

}

function closeModal(){
var modal = document.getElementById("myModal");
	$(document).on('click','.closet',function(){

		$('#myModal').hide();
		$('#myModal').html('');
		$('.modal-body').html('');

	});
	window.onclick = function(event) {

  if (event.target == modal) {
    $('#myModal').hide();
    $('#myModal').html('');
    $('.modal-body').html('');
  }
}

}

function next(){
$(document).on('click','#next',function(){

	var idnumber = $('#idname').val();
	var storynumber = $('#storynumber').val();
	var linknumber = $('#linknumber').val();
	var typenumber01 = $('#typenumber01').val();
	var numbercontact01 = $('#numbercontact01').val();
	var typenumber02 = $('#typenumber02').val();
	var numbercontact02 = $('#numbercontact02').val();
	var typenumber03 = $('#typenumber03').val();
	var numbercontact03 = $('#numbercontact03').val();
	var idquest = $('#idquest').val();
	
    var links = link+'prosessquestin.php?m=add';
    $.post(links,{'idnumber':idnumber,'storynumber':storynumber,'linknumber':linknumber,'typenumber01':typenumber01,
	'numbercontact01':numbercontact01,'typenumber02':typenumber02,'numbercontact02':numbercontact02,'typenumber03':typenumber03,'numbercontact03':numbercontact03,'idquest':idquest},function(data){
		var obj = JSON.parse(data);
		if (obj.success == '1'){
			makeaction();
	back();
	next2();
	
	var linkModal = link+'sever01.php?idquest='+obj.id_quest+'&idnumber='+obj.id_number;
	$(".modal-body-detilw").css("height", "395px");
	$(".modal-body-detilw").css("overflow", "scroll");
	$('.serveral').html('<input type="checkbox" id="agreequest-add" name="agreequest-add" value="1"> <label for="css"> ข้าพเจ้าได้อ่านทำความเข้าใจในเงื่อนไขการให้บริการของทางเว็บไซต์ Boukensha และตกลงยอมรับเงื่อนไขให้บริการแล้วครับ</label>');
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy" id="back">< ย้อนกลับ</div><button type="submit" class="button1"  name="submit" id="next02">>> ถัดไป</button>');

		}
	});

	});

}


function next2(){
$(document).on('click','#next02',function(){
	if( $('#agreequest-add').is(':checked') ) {
		var idquest = $('#idquest').val();
		var idnumber = $('#idnumber').val();
		var linkModal = link+'pdpasever.php?idquest='+idquest+'&idnumber='+idnumber;
	$('.serveral').html('<input type="checkbox" id="agreequest-add02" name="agreequest-add02" value="1"> <label for="css"> ข้าพเจ้าได้อ่านทำความเข้าใจในเงื่อนไขการให้บริการของทางเว็บไซต์ Boukensha และตกลงยอมรับเงื่อนไขให้บริการแล้วครับ</label>');
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy" id="back01">< ย้อนกลับ</div><button type="submit" class="button1"  name="submit" id="btn_submitinter">ขอรับภารกิจ</button>');
	}else{
		alert("กรุณาติ๊กยินยอม จึงสามารถทำรายการถัดไปได้");
        return false;
	}
	
	});
makeaction();
	back();
	back02();
}

function makeaction() {

	if (document.getElementById('btn_submit') != null) {
                document.getElementById('btn_submit').disabled = false;
            }
            }
function back(){
$(document).on('click','#back',function(){
	var idquest = $('#idquest').val();
	var idnumber = $('#idnumber').val();
	var linkModal = link+'detailsuser.php?idquest='+idquest+'&idnumber='+idnumber;
	$(".modal-body-detilw").css("height", "450px");
	$(".modal-body-detilw").css("overflow", "unset");
	$('.serveral').html('');
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy closet">ยกเลิก</div><div class="button1" id="next">ถัดไป >></div>');
	});


}

function back02(){
$(document).on('click','#back01',function(){
	var idquest = $('#idquest').val();
	var idnumber = $('#idnumber').val();
	var linkModal = link+'sever01.php?idquest='+idquest+'&idnumber='+idnumber;
	$(".modal-body-detilw").css("height", "395px");
	$(".modal-body-detilw").css("overflow", "scroll");
	$('.serveral').html('<input type="checkbox" id="agreequest-add" name="agreequest-add" value="1"> <label for="css"> ข้าพเจ้าได้อ่านทำความเข้าใจในเงื่อนไขการให้บริการของทางเว็บไซต์ Boukensha และตกลงยอมรับเงื่อนไขให้บริการแล้วครับ</label>');
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy" id="back">< ย้อนกลับ</div><button type="submit" class="button1"  name="submit" id="next02">>> ถัดไป</button>');

	});


}

function closeModalAuto(){

	$('#myModal').hide();
	$('#myModal').html('');
	$('.modal-body').html('');
}
///-----------------------------------------------modalmini

function previewModalmini(linkModal,classPreview,hasder,styModal,Texttb,tb){

	if (styModal == 'full') {

		var modalmini = 'modal-contents-full';
	}else{

		var modalmini = 'modal-contents';
	}
	
	if (tb != "") {
		var btt = '<div class="modal-footers"><div class="tbA" id="'+tb+'">'+Texttb+'</div></div>';
	}else{
		var btt = '';

	}

	$('.'+classPreview).html('<div id="myModals" class="modals"><div class="'+modalmini+'"><div class="modal-header"><span class="closes">&times;</span><h2>'+hasder+'</h2>'+
		'</div><div class="modal-bodys"></div>'+btt);

	$('.modal-bodys').load(linkModal);
	closeModals();

}

function closeModals(){
var modal = document.getElementById("myModals");
	$(document).on('click','.closes',function(){

		$('#myModals').hide();
		$('#myModals').html('');
		$('.modal-bodys').html('');

	});
	window.onclick = function(event) {

  if (event.target == modal) {
    $('#myModals').hide();
    $('#myModals').html('');
    $('.modal-bodys').html('');
  }
}

}

function closeModalAutos(){

	$('#myModals').hide();
	$('#myModals').html('');
	$('.modal-bodys').html('');
}