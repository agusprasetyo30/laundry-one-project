@extends('layouts.app', ['title' => 'Template Datatables'])

@section('page-title', 'Template Datatables')

@section('content')
   <div class="card card-primary">
      <div class="card-body">
         <div class="row mb-2 d-flex align-items-end">
            <div class="row">
               <div class="col-12">
                  {{-- <table class="table table-striped table-hover" id="master_salesman_table" style="width: 100%;" data-table-route="{{ route('datatables.master.sales-person') }}"> --}}
                  <table class="table table-striped table-hover" id="master_salesman_table" style="width: 100%;">
                     <thead>
                        <tr>
                           <th style="vertical-align: middle;">No</th>
                           <th style="vertical-align: middle;">Nama</th>
                           <th style="vertical-align: middle;">Status</th>
                           <th style="vertical-align: middle;">Created Date</th>
                        </tr>
                     </thead>
                  </table>
                  {{-- @include('partials.loading-spinner') --}}
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
