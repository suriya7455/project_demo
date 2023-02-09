// การเรียกใช้ function previewModal 
// linkModal = ไฟล์หน้าที่ต้องการแสดงข้อมูลใน modal  
//classPreview = class ที่แสดงไฟล์ modal
// hasder = หัวข้อที่ต้องการแสดงใน modal
// styModal = เลือกขนาดของ modal

function previewModal(linkModal,classPreview,hasder,styModal,Texttb,tb){

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
		'<input type="checkbox" id="agreequest-add" name="agreequest-add" value="1"> <label for="css"> ข้าพเจ้าได้อ่านทำความเข้าใจในเงื่อนไขการให้บริการของทางเว็บไซต์ Boukensha และตกลงยอมรับเงื่อนไขให้บริการแล้วครับ</label>'+
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
	var linkModal = 'http://localhost/project_anime/pdpasever.php';
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy" id="back">< ย้อนกลับ</div><button type="submit" class="button1"  name="submit" id="btn_submit">มอบหมายภารกิจ</button>');
	});
makeaction();
	back();
}

function makeaction() {

	if (document.getElementById('btn_submit') != null) {
                document.getElementById('btn_submit').disabled = false;
            }
            }
function back(){
$(document).on('click','#back',function(){
	var linkModal = 'http://localhost/project_anime/sever01.php';
	$('.modal-body-detilw').load(linkModal);
	$('.bt-form').html('<div class="button1 wy closet">ยกเลิก</div><div class="button1" id="next">ถัดไป >></div>');
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