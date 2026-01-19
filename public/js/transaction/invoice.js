"use strict";

let table = '';
let startDate = '';
let endDate = '';

//new
let page = 1;
let baseLimit = 100;
let limitIndex = 1; // ini digunakan untuk menampilkan data sesuai dengan limit, nanti dikali per limit untuk menampilkan data
let limit = baseLimit;
let lastPage = false;
let searchKeyword = '';

$(document).ready(function() {
    $('#range-tanggal-invoice').val('')
    table = $('#invoice-table').DataTable({
        dom: '<"top">rt<"bottom"' + "<'row mt-2'<'col-sm-12 col-md-6'li><'col-sm-12 col-md-6 mt-0'p>>" +
        '>',
        scrollX: true,
        scrollCollapse: true,
        lengthMenu: [10, 25, 50, 100],
        ordering: false,
        data: [],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'InvoiceNoReckitt', name: 'm.Partner_Invoice_No' },
            { data: 'InvoiceNoBCP', name: 'mj.KodeNota' },
            { data: 'BorwitaSONumber', name: 'm.Borwita_SO_Number' },
            { data: 'Tanggal', name: 'ms.tgl',  searchable: false },
            { data: 'TglInvoiceReckitt', name: 'm.Partner_Invoice_date',  searchable: false },
            { data: 'DeliveryDate', name: 'ms.DeliveryDate' },
            { data: 'ShipTo', name: 'ms.Shipto' },
            { data: 'PartnerCustomerName', name: 'm.Partner_Customer_Name' },
            { data: 'PartnerSalesmanName', name: 'm.Partner_Salesman_Name' },
            { data: 'TotalBayar', name: 'ms.TotalBayar' },
            { data: 'Status', name: 'Status', orderable: false, searchable: false},
        ],
        order: [[1, "asc"]],
    });

    // load data table
    loadLazyData()
});

$("input[name=master_invoice_search]").on('keypress', function(e) {
    if (e.which === 13) { // 13 = Enter
        e.preventDefault();
        
        searchKeyword = $(this).val();
        tableReload(false)
    }
})

$('#range-tanggal-invoice').daterangepicker({
    autoUpdateInput: false,
    locale: {format: 'DD/MM/YYYY'},
    drops: 'down',
    opens: 'right'
},function(start, end, label) {
    // update value input secara manual saat memilih
    $('#range-tanggal-invoice').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    
    startDate = start.format('YYYY-MM-DD')
    endDate = end.format('YYYY-MM-DD')
    limitIndex = 1

    tableReload(false)
});

function loadLazyData() {
    if (lastPage) return;

    // menampilkan loading
    showTableLoading();

    $.ajax({
        url: $('#invoice-table').data('table-route'),
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
        },
        complete: function () {
            hideTableLoading()
        }
    });
}

// Event ketika halaman diganti
$('#invoice-table').on('page.dt', function () {
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

$('#invoice-table').on('length.dt', function (e, settings, len) {
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