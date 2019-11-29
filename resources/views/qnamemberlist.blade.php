@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('qnamemberlist') }}

     <table id="qnamemberlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>상태</th>
                 <th>제목</th>
                 <th>업체명</th>
                 <th>이메일</th>
                 <th>연락처</th>
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
    $('#qnamemberlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('qnamemberlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'process', name: 'process' },
            { data: 'subject', name: 'subject' },
            { data: 'mem_name', name: 'mem_name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'reg_time', name: 'reg_time' },
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
        "stateSave": true,

        "fnDrawCallback": function () {
            $("#qnamemberlistTable tbody tr").click(function () {
              table = $('#qnamemberlistTable').dataTable();
              window.location.href = "/qnamemberdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
