/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

function logoutconfirmation() {
    Swal.fire({
        title: "Confirmation",
        text: "Are you sure want to logout?",
        icon: "warning",
        confirmButtonText: "Ok, Logout",
        confirmButtonColor: "#1dafed",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/logout',
                beforeSend: function(data) {
                    Swal.fire({
                        title: 'Now loading ...',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    })
                },
                success: function (data, status, xhr) {
                    localStorage.clear();
                    window.location.href = "/login"
                    
                    Swal.close()
                }
            })
        }
    });
}