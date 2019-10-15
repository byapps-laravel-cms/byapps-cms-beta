@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('promolist') }}

     <table id="updateTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
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
    $('#updateTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('updatelist') }}",
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
           {
             'targets': 4,
             'render': function ( data, type, full, meta ) {
                return '<a href="/updatedetail/'+full.idx+'">'+data+'</a>';
              }
           },
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 1, 'desc']],
        "paging": true,
        "pageLength": 50,
        // "info": false,
        // "autoWidth": true,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,
    });
});
</script>
@endpush
