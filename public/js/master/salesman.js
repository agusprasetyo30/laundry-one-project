"use strict";

let table = '';

//new
let page = 1;
let baseLimit = 100;
let limitIndex = 1; // ini digunakan untuk menampilkan data sesuai dengan limit, nanti dikali per limit untuk menampilkan data
let limit = baseLimit;
let lastPage = false;
let searchKeyword = '';

$(document).ready(function() {
    table = $('#master_salesman_table').DataTable({
        dom: '<"top">rt<"bottom"' + "<'row mt-2'<'col-sm-12 col-md-6 col-12'li><'col-sm-12 col-md-6 col-12 mt-0'p>>" +
        '>',
        ordering: false,
        scrollX: true,
        lengthMenu: [10, 25, 50, 100],
        data: [],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'Kode', name: 's.Kode' },
            { data: 'AliasKodeSales', name: 's.AliasKodeSales' },
            { data: 'Nama', name: 's.Nama' },
            { data: 'KodeSupervisor', name: 's.Supervisor' },
            { data: 'NamaSupervisor', name: 's1.Nama' },
            { data: 'Aktif', name: 'c.Aktif' },
            { data: 'Actions', name: 'Actions', orderable: false, searchable: false}
        ],
        order: [[1, "asc"]],
    });

    // Load lazyload Tabel
    loadLazyData();
});

$("input[name=master_salesman_search]").on('keypress', function(e) {
    if (e.which === 13) { // 13 = Enter
        e.preventDefault();

        searchKeyword = $(this).val();
        tableReload(false)
    }
})

$('#show-mapping-data').change(function() {
    tableReload(false)
})

$(document).on('click', '.update-kode-reckitt', function () {
    // delete validation class
    $('#input-kode-reckitt').removeClass('is-invalid')
    $('#input-kode-reckitt-text').text('')

    $('#input-kode-reckitt').val($(this).data('kode-reckitt-current'))
    $('#modal-update-kode-reckitt').find('#kode-bcp').val($(this).data('kode'))
    $('#modal-update-kode-reckitt').appendTo('body').modal('show');
})

$('#btn-update-data-kode-reckitt').on('click', function() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            kodeBCP: $('#kode-bcp').val(),
            inputKodeReckitt: $('#input-kode-reckitt').val()
        },
        type: "PUT",
        url: $(this).data('route-update'),
        beforeSend: function() {
            $('#btn-update-data-kode-reckitt').addClass('disabled btn-progress')
        },
        success: function (data, status, xhr) {
            if (data.data.failed == 0) {
                tableReload();

                $('#input-kode-reckitt').val('')
                $('#modal-update-kode-reckitt').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Information",
                    text: data.message,
                });
            } else if (data.data.failed == 1) {
                Swal.fire({
                    title: "Information",
                    text: data.message,
                    icon: "warning",
                });
            }

            $('#input-kode-reckitt').val('')
            $('#modal-update-kode-reckitt').modal('hide');
        }, error(xhr) {
            if (xhr.status === 422) {
                let errors = xhr.responseJSON.data;

                if (errors.inputKodeReckitt) {
                    $('#input-kode-reckitt').addClass('is-invalid')
                    $('#input-kode-reckitt-text').text('* ' + errors.inputKodeReckitt[0])
                }
            }
        }, complete() {
            $('#btn-update-data-kode-reckitt').removeClass('disabled btn-progress')
        }
    })
})

function loadLazyData() {
    if (lastPage) return;

    // Tampilkan overlay
    showTableLoading();

    $.ajax({
        url: $('#master_salesman_table').data('table-route'),
        method: 'GET',
        data: { 
            page: page, 
            limit: limit,
            kode_reckitt_filled : $('#show-mapping-data').is(':checked') ? 1 : 0,
            search: searchKeyword
        },
        success: function (res) {
            if (res.data.length > 0) {
                table.rows.add(res.data).draw(false);
                page++;
            } else {
                lastPage = true;
            }
        },
        complete: function () {
            hideTableLoading()
        }
    });
}

// Event ketika halaman diganti
$('#master_salesman_table').on('page.dt', function () {
    const info = table.page.info();

    // Jika sudah dekat akhir dan belum semua data dimuat
    if ((info.page + 1) * info.length >= table.rows().count()) {
        // ini digunakan untuk pengecekan jumlah length menu sama seperti limit
        if ((limit - baseLimit) != table.page.len()) {
            limit = limit - baseLimit;
        }

        limitIndex = limitIndex + 1; // digunakan untuk menambahkan limitIndex untuk konfigurasi jumlah limit yang tampil
        tableReload()
    }
});

$('#master_salesman_table').on('length.dt', function (e, settings, len) {
    if (table.page.len() == limit) {
        limitIndex = limitIndex + 1; // digunakan untuk menambahkan limitIndex untuk konfigurasi jumlah limit yang tampil
    }
    
    tableReload(false)
});

// Digunakan untuk reload tabel dengan loading
function tableReload(dataState = true, lastPageInput = false) {
    page = 1;
    limit = baseLimit * limitIndex
    lastPage = lastPageInput;
    
    // Ini adalah keadaan ketika harus kembali ke index awal atau tetap
    // jadi dari sini dibuat dinamis, dengan default true untuk tidak kembali ke index 0
    if (dataState) {
        table.page(table.page.info().page).draw('page');
        table.clear().draw(false);
    } else {
        table.clear().draw();
    }

    loadLazyData();
}

function showTableLoading() {
    $('#datatable-overlay').fadeIn(150);
}

function hideTableLoading() {
    $('#datatable-overlay').fadeOut(150);
}