@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('pushtesterlist') }}

     <table id="pushtesterlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>UDID / DEVICE ID</th>
                 <th>LANG</th>
                 <th>앱OS</th>
                 <th>버전</th>
                 <th>등록일</th>
                 <th>PUSH</th>
                 <th>삭제</th>
             </tr>
         </thead>
       </table>
      </div>
  </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    $('#pushtesterlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pushtesterlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'app_udid', name: 'app_udid' },
            { data: 'app_lang', name: 'app_lang' },
            { data: 'app_os', name: 'app_os' },
            { data: 'app_ver', name: 'app_ver' },
            { data: 'reg_time', name: 'reg_time' }
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
           {
             'targets': 8,
             'render': function ( data, type, full, meta ) {
                return '<a href="/pushtesterdetail/'+full.idx+'">PUSH</a>';
             }
           },
           {
             'targets': 9,
             'render': function ( data, type, full, meta ) {
                return '<a href="/pushtesterdetail/'+full.idx+'">삭제</a>';
             }
           },
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 5, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#pushtesterlistTable tbody tr").click(function () {
              table = $('#pushtesterlistTable').dataTable();
			  sidebarOpen();
              //window.location.href = "/pushtesterdetail/" + this.id;
            });
         },
         "rowCallback": function(row, data, index) {
           var cellValue = data['app_os'];

           $('td:eq(5)', row).addClass('align-middle text-center');
           switch (cellValue) {
            case 'ios':
                $('td:eq(5)', row).html("<button class='btn btn-info btn-rounded btn-xs'>ios</button>");
                break;
            case 'android': 
                $('td:eq(5)', row).html("<button class='btn btn-success btn-rounded btn-xs'>android</button>");
                break;
            case 'default':
                break;
            }
         },
    });
});
</script>
@endpush
