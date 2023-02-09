 /* Summernote */

 $(document).ready(function (){


    showbenner();
    listformfinish();
    hiseform();
    listrewerd();
    removerewardall();
    listcontact();
    hiseformcontact();
    modelsever();
    addquest();
    modelseverrepost();
    addquestinter();
    clicklistdatamenber();
    agreemenber();
});
 var lines = 'http://localhost/project_anime/';

 function clicklistdatamenber(){
  $(document).on('click','#lismenbber',function(e){
    e.stopImmediatePropagation();
    $('.detailmenber').show();
    var id = $(this).attr('data-id');
    var idq = $(this).attr('data-q');
    var name  = $(this).attr('data-nm');
    $(".recllass").removeClass("active");
    $(".mem-"+id).addClass("active");
    $('#agreemenber').attr('data-idq',idq);
    $('#agreemenber').attr('data-idmen',id);
    $('.listnamemenber').text(name);

    var link = lines+'datamenber.php?idnumber='+id+'&idquest='+idq;
    $('.listmenberin').load(link);

    

});

}

function agreemenber(){
  $(document).on('click','#agreemenber',function(e){
    e.stopImmediatePropagation();
var name =  $('#name').val();
    Swal.fire({
  title: 'ท่านตกลงให้นักผจญภัย "'+name+'" รับภารกิจนี้หรือไม่',
  showDenyButton: true,
  confirmButtonText: 'ตกลง',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire('Saved!', '', 'success')
  } 
})



    }); 
}





function addquestinter(){

    $(document).on('click','#btn_submitinter',function(e){
        e.stopImmediatePropagation();

      if ($('#agreequest-add02:checked').val() !== undefined)
        {
            var idquest = $('#idquest').val();
            var idnumber = $('#idnumber').val();
            var links = lines+'prosessquestin.php?m=confern';
            $.post(links,{'idquest':idquest,'idnumber':idnumber},function(data){
                var obj = JSON.parse(data);
                if (obj.success == '1') {
                    closeModalAuto();
                    alert("แจ้งไปยังเจ้าของภารกิจเรียบร้อบ รอการติดต่อกลับจากเจ้าของภารกิจ");

                }
                //debugger;
            });


            }
            else
            {
              
                alert("กรุณาติ๊กยินยอมเงื่อนไขการให้บริการ");
                return false;
            }
            
            });
        } 


 function modelseverrepost(){
  $(document).on('click','#interested',function(e){
    e.stopImmediatePropagation();
    var id = $(this).attr('data-id');
    var classPreview = 'listDetalMlist';
    var hasder = 'รายละเอียด';
    var linkModal = lines+'detailsuser.php?idquest='+id;
    var styModal = '';
    var bt = '';
    var TextTb = '';
    
    previewModallist(linkModal,classPreview,hasder,styModal,TextTb,bt);

});

}

 function addquest(){

    $(document).on('click','#btn_submit',function(e){
        e.stopImmediatePropagation();

        if ($('#agreequest-add:checked').val() !== undefined)
        {
            }
            else
            {
              
                swal("กรุณากรอกเงื่อนไขการส่งมอบภารกิจ");
                return false;
            }
            
            
            });
        } 

function modelsever(){
  $(document).on('click','#modelsever',function(e){
    e.stopImmediatePropagation();

    if ($('#quest_name').val() == '' || $('#quest_name').val() == 'ทดสอบ' || $('#quest_name').val() == 'test') {
        swal("กรุณากรอกชื่อภารกิจใหม่");
        return false;
    }

    if ($('#name').val() == '') {
        swal("กรุณากรอกเงื่อนไขการส่งมอบภารกิจ");
        return false;
    }
    if ($('#rewardname').val() == '') {
        swal("กรุณาระบุรางวัลภารกิจ");
        return false;
    }
    if ($('#quest_assignor').val() == '') {
        swal("กรุณาระบุชื่อผู้มอบหมายภารกิจ");
        return false;
    }

    if ($('#contactname').val() == '') {
        swal("กรุณาระบุประเภทช่องทางติดต่อผู้มอบภารกิจ");
        return false;
    }
    if ($('#idcontact').val() == '') {
        swal("กรุณาระบุช่องทางติดต่อผู้มอบภารกิจ");
        return false;
    }


    var classPreview = 'listDetalM';
    var hasder = 'รายละเอียด';
    var linkModal = lines+'sever01.php';
    var styModal = '';
    var bt = '';
    var TextTb = '';
    
    previewModal(linkModal,classPreview,hasder,styModal,TextTb,bt);

});

}

function hiseformcontact(){
    $(document).on('click','#removecontact',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-id');
       // debugger;
       var nun = parseInt(number) - 1;
       $('#addcontact').attr('data-contact',nun);
       $('#removecontact').attr('data-contact',nun);
       $(".form-contact-quest-0"+number).remove();

   });
}

function listcontact(){
    $(document).on('click','#addcontact',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-contact');
        var nun = parseInt(number) + 1;
        
        $('#addcontact').attr('data-contact',nun);
        $('.quest-contact').append('<div class="from-uplosdinput form-contact-quest-0'+nun+'">'+
            '<div class="from-inputo tet01">'+
            '<h4 class="h3">ช่องทางติดต่อกลับ ลำดับที่ '+nun+'</h4></div>'+
            '<div class="from-inputo fm01"><input type="text" name="contactname[]" id="contactname" class="inputs" placeholder="ประเภทช่องทางการติดต่อ รางวัลภารกิจ" ></div>'+ 
            '<div class="from-inputo fm01"><input  type="text" name="idcontact[]" id="idcontact" placeholder="โปรหระบุข้อมูลการติดต่อ"class="input" ></div>'+            
            '<div class="from-inputo-file bt-l"><div class="button rightbt" id="removecontact" data-id="'+nun+'">x' +       
            '</div></div></div>');
    });

}


function listrewerd(){
    $(document).on('click','#addreward',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-reward');
        var nun = parseInt(number) + 1;
        
        $('#addreward').attr('data-reward',nun);
        $('.quest-reward').append('<div class="from-uplosdinput form-reward-quest-0'+nun+'">'+
            '<div class="from-inputo">'+
            '<h4 class="h3">รางวัลภารกิจ ลำดับที่ '+nun+'</h4></div>'+
            '<div class="from-inputo fm"><input type="text" name="rewardname[]" placeholder="โปรดระบุ รางวัลภารกิจ" id="rewardname" class="input"></div>'+ 
            '<div class="from-inputo-file"><input  type="text" name="location[]" placeholder="หน่วย"class="input" ></div>'+            
            '<div class="from-inputo-file"><div class="button btr" id="removereward" data-id="'+nun+'">x' +       
            '</div></div></div>');
    });

}

function listformfinish(){
    $(document).on('click','#addform',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-number');
        var nun = parseInt(number) + 1;
        
        $('#addform').attr('data-number',nun);
        $('.listquest').append('<div class="from-uplosdinput form-quest-0'+nun+'">'+
            '<div class="from-inputo">'+
            '<h4 class="h3">เงื่อนไขการส่งมอบภารกิจ ลำดับที่ '+nun+'</h4></div>'+
            '<div class="from-inputo fm"><input type="text" name="name[]" placeholder="โปรดระบุ เงื่อนไขการส่งมอบภารกิจ" id="name" class="input"></div>'+ 
            '<div class="from-inputo-file"> <input class="custom-file-inputq" type="file" name="file[]"></div>'+            
            '<div class="from-inputo-file"><div class="button rightbt btr" id="hisform" data-id="'+nun+'">x' +       
            '</div></div></div>');
    });

}


function hiseform(){
    $(document).on('click','#hisform',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-id');
        var nun = parseInt(number) - 1;
        $('#hisform').attr('data-number',nun);
        $('#addform').attr('data-number',nun);
        $(".form-quest-0"+number).remove();

    });
}

function removerewardall(){
    $(document).on('click','#removereward',function(e){
        e.stopImmediatePropagation();
        var number = $(this).attr('data-id');
        var nun = parseInt(number) - 1;
        $('#addreward').attr('data-reward',nun);
        $('#removereward').attr('data-reward',nun);
        $(".form-reward-quest-0"+number).remove();

    });
}


function showbenner(){
    $(document).on('click','#showbanner',function(e){
        e.stopImmediatePropagation();
        url = $(this).attr('data-href');
        window.open(url, '_blank');
       // debugger;

   });


}

function rewardsele(csi,uncs){

    $('.'+csi).addClass("active");
    $('.'+uncs).removeClass("active");
       // debugger;




   }




   $(document).ready(function () {
    $('#summernote1').summernote({
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    // $.upload(files[i]);
                    file = files[i];
                    let out = new FormData();
                    out.append('file', file, file.name);

                    $.ajax({
                        method: 'POST',
                        url: 'upload.php',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: out,
                        success: function (img) {
                            $('#summernote1').summernote('insertImage', img);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error(textStatus + " " + errorThrown);
                        }
                    });
                }
            }
        },
        lang: 'th-TH', // default: 'en-US'
        height: 250
    });
});

   /* Summernote Testing */
   $(document).ready(function () {
    $('#summernote2').summernote({
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    // $.upload(files[i]);
                    file = files[i];
                    let out = new FormData();
                    out.append('file', file, file.name);

                    $.ajax({
                        method: 'POST',
                        url: 'upload.php',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: out,
                        success: function (img) {
                            $('#summernote2').summernote('insertImage', img);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error(textStatus + " " + errorThrown);
                        }
                    });
                }
            },
            onMediaDelete : function(target) {
                // alert(target[0].src) 
                deleteFile(target[0].src);
            }
        },
        lang: 'th-TH', // default: 'en-US'
        height: 400
    });
});

   function deleteFile(src) {

    $.ajax({
        data: {src : src},
        type: "POST",
        url: base_url+"dropzone/delete_file", // replace with your url
        cache: false,
        success: function(resp) {
            console.log(resp);
        }
    });
}

/* Summernote Testing */
$(document).ready(function () {
    $('#summernote3').summernote({
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    // $.upload(files[i]);
                    file = files[i];
                    let out = new FormData();
                    out.append('file', file, file.name);

                    $.ajax({
                        method: 'POST',
                        url: 'upload.php',
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: out,
                        success: function (img) {
                            $('#summernote3').summernote('insertImage', img);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error(textStatus + " " + errorThrown);
                        }
                    });
                }
            }
        },
        lang: 'th-TH', // default: 'en-US'
        height: 400
    });
});

/* Adventure 1 or more */
$('#quest_adventure_type_1').on('change', function () {
 $("#quest_adventure_num").addClass("d-none");
 $("#quest_adventure_num").val('');
});
$('#quest_adventure_type_2').on('change', function () {
 $("#quest_adventure_num").removeClass("d-none");
});

/* Time 1 or more */
$('#quest_adventure_duration_1').on('change', function () {
 $("#quest-mores").addClass("d-none");
 $("#quest_duration_day").val('');
});
$('#quest_adventure_duration_2').on('change', function () {
 $("#quest-mores").removeClass("d-none");
});

/* Map online / Offline */
$('#quest_location_online').on('change', function () {
 $("#quest_adventure_location").addClass("d-none");
 $("#quest_adventure_location").val('');
 $("#show-map2").html('');
 $("#location-on").removeClass("d-none");
});
$('#quest_location_offline').on('change', function () {
 $("#quest_adventure_location").removeClass("d-none");
 $("#location-on").addClass("d-none");
 $("#show-map").html('');
 $("#quest_local_online").val('');
});

 // Choose Duration
 $('#quest_type_online').on('change', function () {
     $("#catagory-offline").addClass("d-none");
     $("#catagory-online").removeClass("d-none");
     $("#catagory-offline input").prop('checked', false);
     $("#off_other2").val('');
 });
 $('#quest_type_offline').on('change', function () {
     $("#catagory-online").addClass("d-none");
     $("#catagory-offline").removeClass("d-none");
     $("#catagory-online input").prop('checked', false);
     $("#off_other").val('');
 });

 // lat long map 
 $('#quest_local_online').on('keyup', function () {
     var page_name = $('#quest_local_online').val();
     if (page_name) {
         var page_change = "#show-map";
         $(page_change).html();
         $.get("api/map.php", {
             cate: page_name,
         }, function (data) {
             $(page_change).html(data);
         });
     }
 });

 // lat long map 2
 $('#quest_adventure_location').on('keyup', function () {
    var page_name = $('#quest_adventure_location').val();
    if (page_name) {
        var page_change = "#show-map2";
        $(page_change).html();
        $.get("api/map.php", {
            cate: page_name,
        }, function (data) {
            $(page_change).html(data);
        });
    }
});

//  $(".blog__details__item__text p").removeAttr("style");
//  $(".blog__details__item__text p").addClass("text-dark");
//  $(".blog__details__item__text p span").removeAttr("style");
//  $(".blog__details__item__text p span").addClass("text-dark");

 // logout
 /* Logout Confirm Sweetalert */
 function logouts(link1) {
     Swal.fire({
         title: 'ยืนยันออกจากระบบใช่หรือไม่?',
         text: "ออกจากระบบ Boukensha Guild",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'ยืนยัน',
         cancelButtonText: 'ยกเลิก',
     }).then((result) => {
         if (result.isConfirmed) {
             Swal.fire({
                 icon: 'success',
                 title: 'ออกจากระบบสำเร็จ',
                 showConfirmButton: false,
                 timer: 1000
             });
             location.href = link1;
         }
     })
 }

 // Old Password
 $('#button-addon1').on('click', function () {
     if ($('#old_password').attr('type') == 'text') {
         $('#old_password').attr('type', 'password');
     } else {
         $('#old_password').attr('type', 'text');
     }
 });
 // New Password
 $('#button-addon2').on('click', function () {
     if ($('#new_password').attr('type') == 'text') {
         $('#new_password').attr('type', 'password');
     } else {
         $('#new_password').attr('type', 'text');
     }
 });
 // Confirm Password
 $('#button-addon3').on('click', function () {
     if ($('#new_password2').attr('type') == 'text') {
         $('#new_password2').attr('type', 'password');
     } else {
         $('#new_password2').attr('type', 'text');
     }
 });

 $('#quest_code').keyup(function (e) {
     if (/\D/g.test(this.value)) {
         // Filter non-digits from input value.
         this.value = this.value.replace(/\D/g, '');
     }
 });

 $('#quest_3').on('click', function () {
     login1 = $('#quest_id').val();
     Swal.fire({
         title: 'กรอกรหัสยืนยัน 6 หลัก',
         input: 'text',
         inputAttributes: {
             autocapitalize: 'off',
             maxlength: 6
         },
         showCancelButton: true,
         confirmButtonText: 'ส่งมอบภารกิจ',
         cancelButtonText: 'ปิด',
         showLoaderOnConfirm: true,
         preConfirm: (login) => {
             return fetch(`api/quest_confirm.php?id=${login1}&p=${login}`)
             .then(response => {
                 if (!response.ok) {
                     throw new Error(response.statusText)
                 }
                 return response.json()
             })
             .catch(error => {
                 Swal.showValidationMessage(
                     `Request failed: ${error}`
                     )
             })
         },
         allowOutsideClick: () => !Swal.isLoading()
     }).then((result) => {
         if (result.isConfirmed) {
             Swal.fire({
                 title: result.value.message
             })
             if (result.value.message == 'ส่งมอบภารกิจสำเร็จ') {
                 location.href = `quest-detail.php?id=${login1}`;
             }
         }
     })
 });

 // quest active
 $(document).ready(function () {
     $('#quest-active-table').DataTable({
         columnDefs: [{
             targets: 0,
             className: 'text-center'
         },
         {
             targets: 2,
             className: 'text-center'
         },
         {
             targets: 3,
             className: 'text-center'
         },
         {
             targets: 4,
             className: 'text-center'
         },
         {
             targets: 5,
             className: 'text-center'
         }
         ],
         "oLanguage": {
             "sEmptyTable": "ไม่มีข้อมูลในตาราง",
             "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
             "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
             "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
             "sInfoPostFix": "",
             "sInfoThousands": ",",
             "sLengthMenu": "แสดง _MENU_ แถว",
             "sLoadingRecords": "กำลังโหลดข้อมูล...",
             "sProcessing": "กำลังดำเนินการ...",
             "sSearch": "ค้นหา: ",
             "sZeroRecords": "ไม่พบข้อมูล",
             "oPaginate": {
                 "sFirst": "หน้าแรก",
                 "sPrevious": "ก่อนหน้า",
                 "sNext": "ถัดไป",
                 "sLast": "หน้าสุดท้าย"
             },
             "oAria": {
                 "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                 "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
             }
         }
     });
     $('#quest-active-table2').DataTable({
         columnDefs: [{
             targets: 0,
             className: 'text-center'
         },
         {
             targets: 2,
             className: 'text-center'
         },
         {
             targets: 3,
             className: 'text-center'
         },
         {
             targets: 4,
             className: 'text-center'
         },
         {
             targets: 5,
             className: 'text-center'
         }
         ],
         "oLanguage": {
             "sEmptyTable": "ไม่มีข้อมูลในตาราง",
             "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
             "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
             "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
             "sInfoPostFix": "",
             "sInfoThousands": ",",
             "sLengthMenu": "แสดง _MENU_ แถว",
             "sLoadingRecords": "กำลังโหลดข้อมูล...",
             "sProcessing": "กำลังดำเนินการ...",
             "sSearch": "ค้นหา: ",
             "sZeroRecords": "ไม่พบข้อมูล",
             "oPaginate": {
                 "sFirst": "หน้าแรก",
                 "sPrevious": "ก่อนหน้า",
                 "sNext": "ถัดไป",
                 "sLast": "หน้าสุดท้าย"
             },
             "oAria": {
                 "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                 "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
             }
         }
     });
 });

 // create
 $(document).ready(function () {
    $('#quest-create-table').DataTable({
        columnDefs: [{
            targets: 0,
            className: 'text-center'
        },
        {
            targets: 2,
            className: 'text-center'
        },
        {
            targets: 3,
            className: 'text-center'
        },
        {
            targets: 4,
            className: 'text-center'
        },
        {
            targets: 5,
            className: 'text-center'
        }
        ],
        "oLanguage": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา: ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});

 // Select 2
 //  $('.select2').select2()

 //  $('.select2bs4').select2({
 //      theme: 'bootstrap4'
 //  })

 $(document).ready(function () {
     oTable = $('#dataTable2').DataTable({
         "paging": true,
         dom: 'Blfrtip',
         "ordering": false,
         "searching": true,
         "info": false,
         "oLanguage": {
             "sEmptyTable": "ไม่มีข้อมูลในตาราง",
             "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
             "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
             "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
             "sInfoPostFix": "",
             "sInfoThousands": ",",
             "sLengthMenu": "แสดง _MENU_ แถว",
             "sLoadingRecords": "กำลังโหลดข้อมูล...",
             "sProcessing": "กำลังดำเนินการ...",
             "sSearch": "ค้นหา: ",
             "sZeroRecords": "ไม่พบข้อมูล",
             "oPaginate": {
                 "sFirst": "หน้าแรก",
                 "sPrevious": "ก่อนหน้า",
                 "sNext": "ถัดไป",
                 "sLast": "หน้าสุดท้าย"
             },
             "oAria": {
                 "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                 "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
             }
         }
     });
 });

 // Offline , Online Categories
 $('#q_offline').on('click', function () {
     $("#cc_2").addClass("d-none");
     $("#cc_1").removeClass("d-none");
 });
 $('#q_online').on('click', function () {
     $("#cc_1").addClass("d-none");
     $("#cc_2").removeClass("d-none");
 });

 // Search Keyword
 $('#search').keyup(function () {
     oTable.search($(this).val()).draw();
 })

 // Search Filter Categories From Select
 $('#categories_id').on('change', function () {
     oTable.search($(this).val()).draw();
 })
 // Search filter Categories
 var $select = $('#categories_id');
 $('a[href="#categories"]').click(function () {
     $select.val($(this).data('select'));
     oTable.search($(this).data('select')).draw();
 });




 /*  Data Table Category Ajax */
 $(document).ready(function () {
     $('#new-quest-grid').dataTable({
         "processing": true,
         "serverSide": true,
         "ajax": {
             "url": "api/new-ajax.php",
             "type": "POST"
         },

         "oLanguage": {
             "sEmptyTable": "ไม่มีข้อมูลในตาราง",
             "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
             "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
             "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
             "sInfoPostFix": "",
             "sInfoThousands": ",",
             "sLengthMenu": "แสดง _MENU_ แถว",
             "sLoadingRecords": "กำลังโหลดข้อมูล...",
             "sProcessing": "กำลังดำเนินการ...",
             "sSearch": "ค้นหา: ",
             "sZeroRecords": "ไม่พบข้อมูล",
             "oPaginate": {
                 "sFirst": "หน้าแรก",
                 "sPrevious": "ก่อนหน้า",
                 "sNext": "ถัดไป",
                 "sLast": "หน้าสุดท้าย"
             },
             "oAria": {
                 "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                 "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
             }
         }
        /// debugger;
    });
 });

 $('#search').on('keyup click', function () {
   // debugger;
   $('#new-quest-grid').DataTable().search(
     $('#search').val()
     ).draw();
});

 // Search Filter Categories From Select
 $('#categories_id').on('change', function () {
     //oTable2.search($(this).val()).draw();
     $('#new-quest-grid').DataTable().search(
         $('#categories_id').val()
         ).draw();
 })
 // Search filter Categories
 var $select = $('#categories_id');
 $('a[href="#categories"]').click(function () {
     $select.val($(this).data('select'));
     $('#new-quest-grid').DataTable().search($(this).data('select')).draw();
 });


// Completed Quest
$(document).ready(function () {
    $('#complete-quest-grid').dataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "api/complete-ajax.php",
            "type": "POST"
        },
        // Thai lang
        "oLanguage": {
            "sEmptyTable": "ไม่มีข้อมูลในตาราง",
            "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
            "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
            "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
            "sInfoPostFix": "",
            "sInfoThousands": ",",
            "sLengthMenu": "แสดง _MENU_ แถว",
            "sLoadingRecords": "กำลังโหลดข้อมูล...",
            "sProcessing": "กำลังดำเนินการ...",
            "sSearch": "ค้นหา: ",
            "sZeroRecords": "ไม่พบข้อมูล",
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
            "oAria": {
                "sSortAscending": ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
                "sSortDescending": ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
            }
        }
    });
});

// Search 
$('#search').on('keyup click', function () {
    $('#complete-quest-grid').DataTable().search(
        $('#search').val()
        ).draw();
});

// Search Filter Categories From Select
$('#categories_id').on('change', function () {
    //oTable2.search($(this).val()).draw();
    $('#complete-quest-grid').DataTable().search(
        $('#categories_id').val()
        ).draw();
})
// Search filter Categories
var $select = $('#categories_id');
$('a[href="#categories"]').click(function () {
    $select.val($(this).data('select'));
    $('#complete-quest-grid').DataTable().search($(this).data('select')).draw();
});

// autofocus


// $(".blog__details__text p").removeAttr("style");
// $(".blog__details__text p span").removeAttr("style");





// auto refresh banner
/* Refresh  Dashboard_welcome */
function refresh_banner() {
    jQuery.ajax({
        url: 'ads-ajax.php',
        type: 'GET',
        success: function (results) {
            jQuery("#ads-random-15").html(results);
        }
    });
}
//refresh_dash1 = setInterval(refresh_banner, 900000); // 1000msec * 60sec * 15min
refresh_dash1 = setInterval(refresh_banner, 10000); // 1000msec * 60sec * 15min







