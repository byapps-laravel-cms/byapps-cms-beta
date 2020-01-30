@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appspointmemberlist') }}

     <table id="appspointmemberTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>회원아이디</th>
                 <th>포인트</th>
                 <th>앱OS</th>
                 <th>버전</th>
                 <th>등록일</th>
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
    $('#appspointmemberTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appspointmemberlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'mem_id', name: 'mem_id' },
            { data: 'total_point', name: 'total_point' },
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
            $("#appspointmemberTable tbody tr td:not(.select-checkbox)").click(function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              // table = $('#appspointmemberTable').dataTable();
              // window.location.href = "/appspointmemberdetail/" + this.id;
              window.location.href = "/appspointmemberdetail/" + nRow.target.parentElement.id;
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
