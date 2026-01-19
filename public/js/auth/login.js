"use strict";

let timer = ''
let toast = ''

$(document).ready(function() {
    toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timerProgressBar: true,
        timer: 3000
    });
})

$('#kode-cabang').on('change', function() {
    let selectedOption = $(this).find(':selected')

    $('#username').prop('readonly', false)
    $('#username').focus()
    $('input[name=kode_cabang]').val(selectedOption.val())
    $('input[name=cabang_name]').val(selectedOption.text())
    $('input[name=db_name]').val(selectedOption.data('dbname'))
})

$('#refresh-qrcode').on('click', function() {
    show_code()
})

$('#username').on('input', function () {
    this.value = this.value.toUpperCase();
});

$('#username').on('keydown', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault(); // Cegah submit form
        
        if ($('#username').val() != '' && $('input[name=kode_cabang]').val() != '') {
            checkAllowUsePasswordStaff().then(result => {
                if (result === null || result == 0) {
                    show_code()
                } else {
                    $("#token_hasil").val('AllowPassword');
                }
            }).catch(err => {
                console.log("Something wrong :", err);
            });
            
            // Styling input & button
            $('#kode-cabang').prop('disabled', true)
            $('#kode-cabang').css('cursor', 'not-allowed')
            $('#username').prop('readonly', true)
            $('#token').prop('readonly', false)

            $('#refresh-qrcode').prop('hidden', false)
            $('#token').focus()

        } else {
            toast.fire({
                icon: 'error',
                title: 'Harap mengisi data dengan benar'
            })
        }
    }
});

$('#token').on('keypress', function (e) {

    // cek ketika tombol enter ditekan
    if (e.keyCode == 13) {
        this.form.submit();
    }
});

$('.img-placholder').on('click', function() {
    if ($('#username').val() != '' && $('input[name=kode_cabang]').val() != '') {
        show_code()
            
        // Styling input & button
        $('#kode-cabang').prop('disabled', true)
        $('#kode-cabang').css('cursor', 'not-allowed')
        $('#username').prop('readonly', true)
        $('#token').prop('readonly', false)
    
        $('#refresh-qrcode').prop('hidden', false)
        $('#token').focus()
    } else {
        toast.fire({
            icon: 'error',
            title: 'Harap mengisi data dengan benar'
        })
    }
})

function checkAllowUsePasswordStaff() {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "/proxy/check-allow-use-password-staff",
            data: {
                db_name: $('input[name=db_name]').val(),
                kode_cabang: $('input[name=kode_cabang]').val(),
                username: $('input[name=username]').val()
            },
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                if (data == 0 || data == 1) {
                    resolve(data)
                } else {
                    resolve(null)
                }
            }, 
            error: function(data) {
                console.log(data);
                reject(data);
            }
        })
    })
}

function show_code() {
    let sec = 60;
    clearInterval(timer);

    $('#countdown').html('');
    $("#img-token").html('');
    $('#index').val('1');

    let username = $('#username').val();

    $.ajax({
        url: "/proxy/generate-qrcode",
        data: {
            username: username
        },
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            $('#img-token').html('');
            
            $('#img-token').qrcode({
                text: data.data.token,
                width: 170,
                height: 170,
            })

            $("#token_hasil").val(data.data.token);
            $('#generate').prop("disabled", false);
            $("#countdown").css("display", "block");

            console.log(data.data.token);
            
            $('.qr-text').removeClass('d-none')
            $('.qr-text-description').addClass('d-none')
            $('#img-token').removeClass('mt-4')

            $('#qr-countdown').html('Kedaluwarsa dalam <span>60</span> detik');
            $("#token_hasil").val(data.data.token);

            timer = setInterval(function() {
                $('#qr-countdown span').text(--sec);
                $('#timer').val(sec);
                if (sec == 0) {
                    $('#qr-countdown').text("");
                    $('#img-token').html('<img src="'+ $('#img-token').data('img-placeholder') +'" width="170" height="170" class="img-fluid" style="user-select:none;" alt=""/>');
                    $('#qr-countdown').text("Token Expired ! Harap refresh QR Code");
                    clearInterval(timer);
                }
            }, 1000);
        },
        error: function(xhr) {
            console.log(xhr);
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.data;
                let message = Object.values(errors).flat().join(', ');

                Swal.fire("Validasi Gagal", message, "warning");
            } else {
                Swal.fire("Gagal", xhr.responseJSON.message || "Terjadi error", "error");
            }
        }
    });
}