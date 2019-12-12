@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('adminlist') }}

     <table id="apklistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>상태</th>
                 <th>등록일</th>
                 <th>다운로드</th>
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
    $('#apklistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('apklist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'app_process', name: 'app_process' },
            { data: 'reg_time', name: 'reg_time' },
            { data: 'apk_file', name: 'apk_file' },
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
        order: [[ 4, 'desc']],
        paging: true,
        pageLength: 50,
        fixedHeader: false,
        responsive: true,
        orderClasses: false,
        stateSave: false,

        "fnDrawCallback": function () {
            $("#apklistTable tbody tr").click(function () {
              table = $('#apklistTable').dataTable();
              window.location.href = "/apkdetail/" + this.id;
            });
         },

         "rowCallback": function(row, data, index) {
           var cellValue = data['app_process'];
           $('td:eq(3)', row).addClass("align-middle text-center");
           if (cellValue == '대기') {
             $('td:eq(3)', row).html("<button class='btn btn-info btn-rounded btn-xs'>대기</button>");
           } else if (cellValue == '완료') {
             $('td:eq(3)', row).html("<button class='btn btn-success btn-rounded btn-xs'>완료</button>");
           }
         },
    });
});
</script>
@endpush
