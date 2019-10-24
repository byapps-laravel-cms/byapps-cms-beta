@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appsstatlist') }}

     <table id="appsstatlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>전체</th>
                 <th>오늘</th>
                 <th>어제</th>
                 <th>평균</th>
                 <th>최고</th>
                 <th>기간</th>
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
    $('#appsstatlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appsstatlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'total_c', name: 'total_c' },
            { data: 'today_c', name: 'today_c' },
            { data: 'yesterday_c', name: 'yesterday_c' },
            { data: 'average', name: 'average' },
            { data: 'max_c', name: 'max_c' },
            { data: 'term', name: 'term' },
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
             'targets': 2,
             'render': function ( data, type, full, meta ) {
                return '<a href="/appsstatdetail/'+full.idx+'">'+data+'</a>';
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
    });
});
</script>
@endpush
