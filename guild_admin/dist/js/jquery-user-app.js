/* Delete images Success */
function del_imgsuccess() {
    Swal.fire({
        icon: 'success',
        title: 'ลบรูปภาพสำเร็จ',
        showConfirmButton: false,
        timer: 1000
    });
}

/* Delete images Fails */
function del_imgfails() {
    Swal.fire({
        icon: 'warning',
        title: 'ไม่สามารถลบรูปภาพได้',
        showConfirmButton: false,
        timer: 1000
    });
}

/* Edit Success */
function edit_success() {
    Swal.fire({
        icon: 'success',
        title: 'แก้ไขข้อมูลสำเร็จ',
        showConfirmButton: false,
        timer: 1000
    });
}

/* Edit Fail */
function edit_fails() {
    Swal.fire({
        icon: 'warning',
        title: 'ไม่แก้ไขข้อมูลได้',
        showConfirmButton: false,
        timer: 1000
    });
}

/* Delete Confirm Sweetalert */
function cdelte(val1, link1) {
    Swal.fire({
        title: 'คุณต้องการลบข้อมูลใช่หรือไม่?',
        text: "ยืนยันการลบ " + val1,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1000
            });
            location.href = link1;
        }
    })
}

/* Delete Confirm Delimages */
function cdelimg(val1, link1) {
    Swal.fire({
        title: 'คุณต้องการลบรูปภาพใช่หรือไม่?',
        text: "ยืนยันลบรูปภาพ " + val1,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันลบ',
        cancelButtonText: 'ยกเลิก',
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon: 'success',
                title: 'ลบข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1000
            });
            location.href = link1;
        }
    })
}

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

/* Summernote */
$(document).ready(function () {
    $('#summernote').summernote({
        callbacks: {
            onImageUpload: function (files) {
                for (let i = 0; i < files.length; i++) {
                    //$.upload(files[i]);
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
                            $('#summernote').summernote('insertImage', img);
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

/* Summernote */
$(document).ready(function () {
    $('.summernote').summernote({
        lang: 'th-TH', // default: 'en-US'
        height: 250
    });
});

/* Summernote Testing */
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
            }
        },
        lang: 'th-TH', // default: 'en-US'
        height: 400
    });
});


$.upload = function (file) {
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
};

/* Before Upload */
$(".file-3").fileinput({
    'theme': 'explorer-fas',
    language: 'th',
    showUpload: false,
    overwriteInitial: false,
    initialPreviewAsData: true,
});

/*  Data Table Blog Type Ajax */
$(document).ready(function () {
    $('#blog_type-grid').dataTable({
        columnDefs: [{
                targets: 0,
                className: 'text-left'
            },
            {
                targets: 2,
                className: 'text-center'
            },
            {
                targets: 3,
                className: 'text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_blog_type/blog_type_ajax.php",
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

/*  Data Table TAGS Ajax */
$(document).ready(function () {
    $('#tags-grid').dataTable({
        columnDefs: [{
                targets: 0,
                className: 'text-left'
            },
            {
                targets: 2,
                className: 'text-center'
            },
            {
                targets: 3,
                className: 'text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_tags/tags_ajax.php",
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

/*  Data Table Provinces Ajax */
$(document).ready(function () {
    $('#provinces-grid').dataTable({
        columnDefs: [{
                targets: 0,
                className: 'text-center'
            },
            {
                targets: 1,
                className: 'text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_location/provinces_ajax.php",
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

/*  Data Table Districts Ajax */
$(document).ready(function () {
    $('#districts-grid').dataTable({
        columnDefs: [{
                targets: 0,
                className: 'text-center'
            },
            {
                targets: 1,
                className: 'text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_location/districts_ajax.php",
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

/*  Data Table Subdistricts Ajax */
$(document).ready(function () {
    $('#subdistricts-grid').dataTable({
        columnDefs: [{
                targets: 0,
                className: 'text-center'
            },
            {
                targets: 1,
                className: 'text-center'
            },
            {
                targets: 4,
                className: 'text-center'
            },
            {
                targets: 5,
                className: 'text-center'
            },
            {
                targets: 6,
                className: 'text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_location/subdistricts_ajax.php",
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

/*  Data Table Contact Ajax */
$(document).ready(function () {
    $('#contact-grid').dataTable({
        "order": [
            [4, "desc"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center align-middle'
            },
            {
                targets: 1,
                className: 'align-middle'
            },
            {
                targets: 2,
                className: 'text-center align-middle'
            },
            {
                targets: 3,
                className: 'text-center align-middle'
            },
            {
                targets: 4,
                className: 'text-center align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_contact/contact_ajax.php",
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

// Select 2
$('.select2').select2()

$('.select2bs4').select2({
    theme: 'bootstrap4'
})

/*  Data Table Subdistricts Ajax */
$(document).ready(function () {
    $('#blog-grid').dataTable({
        "order": [
            [4, "desc"]
        ],
        columnDefs: [{
                targets: 0,
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
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_blog/blog_ajax.php",
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
/*  Data Table Subdistricts Ajax */
$(document).ready(function () {
    $('#quest-grid').dataTable({
        "order": [
            [1, "asc"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'align-middle text-center'
            },
            {
                targets: 1,
                className: 'align-middle'
            },
            {
                targets: 2,
                className: 'align-middle'
            },
            {
                targets: 3,
                className: 'align-middle text-center'
            },
            {
                targets: 4,
                className: ' align-middle text-center'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_quest/quest_ajax.php",
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

/*  Data Table Author Ajax */
$(document).ready(function () {
    $('#author_type-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
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
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_author/author_ajax.php",
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

/*  Data Table Category Ajax */
$(document).ready(function () {
    $('#category-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center'
            },
            {
                targets: 1,
                className: 'text-center'
            },
            {
                targets: 2,
                className: 'text-left'
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
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_category/category_ajax.php",
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

/*  Data Table Product Ajax */
$(document).ready(function () {
    $('#product-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
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
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_product/product_ajax.php",
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


/*  Data Table categories Ajax */
$(document).ready(function () {
    $('#categories_type-grid').dataTable({
        "order": [
            [1, "desc"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'align-middle text-center'
            },
            {
                targets: 1,
                className: 'align-middle text-center'
            },
            {
                targets: 2,
                className: 'align-middle text-left'
            },
            {
                targets: 3,
                className: 'align-middle text-center'
            },
            {
                targets: 4,
                className: 'align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_categories/categories_ajax.php",
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

// Choose Adventurer 
$('#quest_adventure_type_1').on('change', function () {
    $("#advmore-1").addClass("d-none");
    $("input#quest_adventure_num").prop('disabled', true);
});
$('#quest_adventure_type_2').on('change', function () {
    $("#advmore-1").removeClass("d-none");
    $("input#quest_adventure_num").prop('disabled', false);
});

// Choose Duration
$('#quest_adventure_duration_1').on('change', function () {
    $("#qavd-1").addClass("d-none");
    $("input#quest_adventure_duration_day").prop('disabled', true);
});
$('#quest_adventure_duration_2').on('change', function () {
    $("#qavd-1").removeClass("d-none");
    $("input#quest_adventure_duration_day").prop('disabled', false);
});

// Choose Offline Online
$('#quest_location_online').on('change', function () {
    $("#location-off").addClass("d-none");
    $("input#quest_adventure_location").prop('disabled', true);
    // show
    $("#location-on").removeClass("d-none");
    $("#show-map").removeClass("d-none");
    $("#quest_local_online").prop('disabled', false);
});
$('#quest_location_offline').on('change', function () {
    $("#location-off").removeClass("d-none");
    $("input#quest_adventure_location").prop('disabled', false);

    // hidden map
    $("#location-on").addClass("d-none");
    $("#show-map").addClass("d-none");
    $("#quest_local_online").prop('disabled', true);
});


// lat long map 
$('#quest_local_online').on('keyup', function () {
    var page_name = $('#quest_local_online').val();
    if (page_name) {
        var page_change = "#show-map";
        $(page_change).html();
        $.get("admin_quest/quest_map.php", {
            cate: page_name,
        }, function (data) {
            $(page_change).html(data);
        });
    }
});

// Choose Duration
$('#quest_type_online').on('change', function () {
    $("#catagory-offline").addClass("d-none");
    $("#catagory-online").removeClass("d-none");
    $("#catagory-offline input").prop('checked', false);
});
$('#quest_type_offline').on('change', function () {
    $("#catagory-online").addClass("d-none");
    $("#catagory-offline").removeClass("d-none");
    $("#catagory-online input").prop('checked', false);
});

// ADS Link detail
$('#banner_type_link').on('change', function () {
    $("#ads-detail").addClass("d-none");
    $('.summernote').summernote('reset');
});
$('#banner_type_detail').on('change', function () {
    $("#ads-detail").removeClass("d-none");
});

// ADSider Link detail
$('#banner_type_link').on('change', function () {
    $("#adslider-detail").addClass("d-none");
    $('.summernote').summernote('reset');
});
$('#banner_type_detail').on('change', function () {
    $("#adslider-detail").removeClass("d-none");
});


/*  Data Table Category Ajax */
$(document).ready(function () {
    $('#ads-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center align-middle'
            },
            {
                targets: 1,
                className: 'text-center align-middle'
            },
            {
                targets: 2,
                className: 'align-middle'
            },
            {
                targets: 3,
                className: 'text-center align-middle'
            },
            {
                targets: 4,
                className: 'text-center align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_ads/ads_ajax.php",
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

/*  Data Table Banner Ajax */
$(document).ready(function () {
    $('#banner-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center align-middle'
            },
            {
                targets: 1,
                className: 'text-center align-middle'
            },
            {
                targets: 2,
                className: 'align-middle'
            },
            {
                targets: 3,
                className: 'text-center align-middle'
            },
            {
                targets: 4,
                className: 'text-center align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_banner/banner_ajax.php",
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

/*  Data Table Category Ajax */
$(document).ready(function () {
    $('#adslider-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center align-middle'
            },
            {
                targets: 1,
                className: 'text-center align-middle'
            },
            {
                targets: 2,
                className: 'align-middle'
            },
            {
                targets: 3,
                className: 'text-center align-middle'
            },
            {
                targets: 4,
                className: 'text-center align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_adslider/adslider_ajax.php",
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

/*  Data Table Category Ajax */
$(document).ready(function () {
    $('#member-grid').dataTable({
        "order": [
            [0, "ASC"]
        ],
        columnDefs: [{
                targets: 0,
                className: 'text-center align-middle'
            },
            {
                targets: 1,
                className: 'text-center align-middle'
            },
            {
                targets: 2,
                className: 'align-middle'
            },
            {
                targets: 3,
                className: 'text-center align-middle'
            },
            {
                targets: 4,
                className: 'text-center align-middle'
            },
            {
                targets: 5,
                className: 'text-center align-middle'
            }
        ],
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "admin_member/member_ajax.php",
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