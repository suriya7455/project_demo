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
refresh_dash1 = setInterval(refresh_banner, 900000); // 1000msec * 60sec * 15min
