@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appspointlist') }}

     <table id="appspointlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
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
$(function() {
    $('#appspointlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appspointlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'mem_id', name: 'mem_id' },
            { data: 'point', name: 'point' },
            { data: 'point_title', name: 'point_title' },
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
             'targets': 1,
             'render': function ( data, type, full, meta ) {
                return '<a href="/appsDetail/'+full.idx+'">'+data+'</a>';
             }
           },
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 5, 'desc']],
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
