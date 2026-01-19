"use strict";

let table = ''
let startDate = '';
let endDate = '';

//new
let page = 1;
let baseLimit = 100;
let limitIndex = 1; // ini digunakan untuk menampilkan data sesuai dengan limit, nanti dikali per limit untuk menampilkan data
let limit = baseLimit;
let lastPage = false;
let searchKeyword = '';

$(document).ready(function () {
    table = $('#credit-note-return-table').DataTable({
        dom: '<"top">rt<"bottom"' + "<'row mt-2'<'col-sm-12 col-md-6'li><'col-sm-12 col-md-6 mt-0'p>>" +
            '>',
        columnDefs: [
            {
                targets: [0],
                orderable: false,
                searchable: false,
            },
        ],
        ordering: false,
        order: [[1, 'asc']],
        scrollCollapse: true,
        scrollX: true,
        paging: true,
        lengthMenu: [10, 25, 50, 100],
        fixedColumns: {
            left: 1
        },
        data: [],
        columns: [
            { data: 'InputCheckbox', name: 'InputCheckbox', orderable: false, searchable: false, className: 'align-middle' },
            { data: 'KodeNota', name: 'KodeNota', className: 'align-middle' },
            { data: 'KodeInvoiceReckitt', name: 'KodeInvoiceReckitt', className: 'align-middle' },
            { data: 'Tanggal', name: 'Tanggal', className: 'align-middle' },
            { data: 'KodePelangganBCP', name: 'KodePelangganBCP', className: 'align-middle' },
            { data: 'Perusahaan', name: 'Perusahaan', className: 'align-middle' },
            { data: 'NamaSales', name: 'NamaSales', className: 'align-middle' },
            { data: 'Total', name: 'Total', className: 'align-middle' },
            { data: 'Alasan', name: 'Alasan', className: 'align-middle' },
            { data: 'Status', name: 'Status', orderable: false, searchable: false, className: 'align-middle' },
        ],
    })

    // Load awal
    loadLazyData();
})

$("input[name=credit_note_search]").on('keypress', function (e) {
    if (e.which === 13) { // 13 = Enter
        e.preventDefault();

        searchKeyword = $(this).val();
        tableReload(false)
    }
})

$('#range-tanggal-creditnote-return').daterangepicker({
    autoUpdateInput: false,
    locale: { format: 'DD/MM/YYYY' },
    drops: 'down',
    opens: 'right',
}, function (start, end, label) {
    // update value input secara manual saat memilih
    $('#range-tanggal-creditnote-return').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

    startDate = start.format('YYYY-MM-DD')
    endDate = end.format('YYYY-MM-DD')
    limitIndex = 1
    
    tableReload(false)
})

function loadLazyData() {
    if (lastPage) return;

    // Tampilkan overlay
    showTableLoading();

    $.ajax({
        url: $('#credit-note-return-table').data('table-route'),
        method: 'GET',
        data: {
            page: page,
            limit: limit,
            startDate: startDate,
            endDate: endDate,
            search: searchKeyword
        },
        success: function (res) {
            if (res.data.length > 0) {
                table.rows.add(res.data).draw(false);
                page++;
            } else {
                lastPage = true;
            }

            // if ((res.data.length == table.page.info().end) && (res.data.length == 0)) {
                // console.log('ini terakhir');
            // }
        },
        complete: function () {
            hideTableLoading();
        }
    });
}

// Event ketika halaman diganti
$('#credit-note-return-table').on('page.dt', function () {
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

$('#credit-note-return-table').on('length.dt', function (e, settings, len) {
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

// Tombol kirim ke reckitt berdasarkan data yang dipilih
$(document).on('click', '.send-to-reckitt', function () {
    Swal.fire({
        title: "Confirmation",
        text: "Are you sure you want to send this data to Reckitt ?",
        icon: "warning",
        confirmButtonText: "Send data",
        confirmButtonColor: "#1dafed",
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    kodeNota: $(this).data('kode-nota'),
                    creditNoteType: 'return'
                },
                type: "POST",
                url: $('#credit-note-return-table').data('send-to-reckitt-route'),
                beforeSend: function (data) {
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
                    Swal.close()

                    if (data.data.failed == 0) {
                        Swal.fire({
                            icon: "success",
                            title: "Information",
                            text: data.message,
                            allowOutsideClick: false
                        }).then((result1) => {
                            if (result1.isConfirmed) {
                                tableReload()
                            }
                        });

                    } else if (data.data.failed == 1) {
                        Swal.fire({
                            title: "Information",
                            text: data.message,
                            icon: "warning",
                        });

                        tableReload(false)
                    }
                }, error: function (xhr) {
                    Swal.close()

                    Swal.fire({
                        icon: "error",
                        title: "Information",
                        text: xhr.responseJSON.message,
                    });
                }
            })
        }
    });
})