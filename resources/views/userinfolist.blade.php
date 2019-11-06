@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('userinfolist') }}

     <table id="userinfolistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>아이디</th>
                 <th>상태</th>
                 <th>업체명</th>
                 <th>이름</th>
                 <th>연락처</th>
                 <th>등록IP</th>
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
    $('#userinfolistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('userinfolist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'mem_id', name: 'mem_id' },
            { data: 'type', name: 'type' },
            { data: 'mem_nick', name: 'mem_nick' },
            { data: 'mem_name', name: 'mem_name' },
            { data: 'cellno', name: 'cellno' },
            { data: 'ip', name: 'ip' },
            { data: 'reg_date', name: 'reg_date' },
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
        order: [[ 7, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#userinfolistTable tbody tr").click(function () {
              table = $('#userinfolistTable').dataTable();
              window.location.href = "/userinfodetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
