@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">
      {{ Breadcrumbs::render('appslist') }}

     <table id="appslistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>버전</th>
                 <th>BV</th>
                 <th>등록상태</th>
                 <th>스크립트</th>
             </tr>
         </thead>
       </table>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
var a;
$(function() {
        a = $('#appslistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appslist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'app_ver', name: 'app_ver' },
            { data: 'app_process', name: 'app_process' },
            { data: 'server_group', name: 'server_group' },
            { data: 'script_popup', name: 'script_popup' }
        ],
        columnDefs: [
           {
              'targets': 0,
              'className': 'select-checkbox',
              'searchable': false,
              'orderable': false,
              'checkboxes': {
                 'selectRow': true
              },
           },
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 0, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        stateSave: false,

        "fnDrawCallback": function () {
            $("#appslistTable tbody tr").click(function () {
              table = $('#appslistTable').dataTable();
              window.location.href = "{{ route('appsdetail','') }}/" + this.id;
            });
        },
    });
});
</script>
@endpush
