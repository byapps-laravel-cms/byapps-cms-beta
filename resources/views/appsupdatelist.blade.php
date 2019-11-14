@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appsupdatelist') }}

     <table id="appsupdatelistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>신청일</th>
                 <th>진행상태</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>앱OS</th>
                 <th>버전</th>
                 <th>업데이트 내역</th>
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
    $('#appsupdatelistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appsupdatelist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'reg_time', name: 'reg_time' },
            { data: 'update_process', name: 'update_process' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'os', name: 'os' },
            { data: 'update_ver', name: 'update_ver' },
            { data: 'update_type', name: 'update_type' },
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
        order: [[ 1, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#appsupdatelistTable tbody tr").click(function () {
              table = $('#appsupdatelistTable').dataTable();
              window.location.href = "/appsupdatedetail/" + this.id;
            });
         },

         "rowCallback": function(row, data, index) {
           var cellValue = data['update_process'];

           $('td:eq(2)', row).addClass('align-middle text-center');
           switch (cellValue) {
            case '취소':
                $('td:eq(2)', row).html("<button class='btn btn-pink btn-rounded btn-xs'>취소</button>");
                break;
            case '접수': 
                $('td:eq(2)', row).html("<button class='btn btn-info btn-rounded btn-xs'>접수</button>");
                break;
            case '신청확인':
                $('td:eq(2)', row).html("<button class='btn btn-success btn-rounded btn-xs'>신청확인</button>");
                break;
            case '진행중':
                $('td:eq(2)', row).html("<button class='btn btn-warning btn-rounded btn-xs'>진행중</button>");
                break;
            case '완료':
                $('td:eq(2)', row).html("<button class='btn btn-purple btn-rounded btn-xs'>완료</button>");
                case 'default':
                break;
            }
         },
    });
});
</script>
@endpush
