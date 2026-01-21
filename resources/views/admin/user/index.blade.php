@extends('layouts.app', ['title' => 'Manajemen Pengguna'])

@section('page-title', 'Manajemen Pengguna')

@section('content')
    <div class="card card-primary">
        <div class="card-body">
            <div class="row mb-2 d-flex align-items-end">
                <div class="col-sm-12 col-md-3 col-lg-3 col-12 order-lg-2 order-md-2 order-sm-2 order-1">
                    <div class="searching">
                        <label for="master_salesman_search">
                            Search:
                        </label>
                        <input type="search" class="form-control" name="master_salesman_search" aria-controls="master_salesman_table">
                    </div>
                </div>

                <div class="col-sm-12 col-md-9 col-lg-9 col-12 order-lg-1 order-md-2 order-sm-2 order-1">
                    <button class="btn btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Pengguna</button>
                </div>

            </div>

            <div class="row">
                <div class="col-12">
                    {{-- <table class="table table-striped table-hover" id="master_salesman_table" style="width: 100%;" data-table-route="{{ route('datatables.master.sales-person') }}"> --}}
                    <table class="table table-striped table-hover" id="master_salesman_table">
                        <thead>
                        <tr>
                            <th style="vertical-align: middle;" width="8%">No</th>
                            <th style="vertical-align: middle;" width="25%">Nama</th>
                            <th style="vertical-align: middle;" width="25%">Username</th>
                            <th style="vertical-align: middle;" width="10%">Status</th>
                            <th style="vertical-align: middle;" width="17%">Created Date</th>
                            <th style="vertical-align: middle;" width="25%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Agus Prasetyo</td>
                                <td>Melkan 123</td>
                                <td>Active</td>
                                <td>2022-01-01</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- @include('partials.loading-spinner') --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js-custom')
    <script>
        $('#master_salesman_table').DataTable({
            dom: '<"top">rt<"bottom"' + "<'row mt-2'<'col-sm-12 col-md-6 col-12'li><'col-sm-12 col-md-6 col-12 mt-0'p>>" +
            '>',
            // autoWidth: true,
            // responsive: true,
        });

    </script>
@endpush