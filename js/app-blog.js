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

$(".blog__details__text p").removeAttr("style");
$(".blog__details__text p span").removeAttr("style");
