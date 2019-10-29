@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('pushlist') }}

     <table id="pushlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>OS/LAN</th>
                 <th>알림내용</th>
                 <th>GCM</th>
                 <th>iOS</th>
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
    $('#pushlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pushlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'os', name: 'os' },
            { data: 'msg', name: 'msg' },
            { data: 'send_gcm', name: 'send_gcm' },
            { data: 'send_ios', name: 'send_ios' },
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
            $("#pushlistTable tbody tr").click(function () {
              table = $('#pushlistTable').dataTable();
              window.location.href = "/appsdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
