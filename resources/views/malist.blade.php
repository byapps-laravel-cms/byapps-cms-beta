@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('malist') }}

     <table id="malistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>MA 아이디</th>
                 <th>업체명</th>
                 <th>MA 버전</th>
                 <th>서비스</th>
                 <th>서버 그룹</th>
                 <th>등록상태</th>
                 <th>서비스 기간</th>
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
    $('#malistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('malist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'ma_id', name: 'ma_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'ma_ver', name: 'ma_ver' },
            { data: 'service_type', name: 'service_type' },
            { data: 'server_group', name: 'server_group' },
            { data: 'app_process', name: 'app_process' },
            { data: 'start_time', name: 'start_time' },
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
             'targets': 2,
             'render': function ( data, type, full, meta ) {
                return '<a href="/madetail/'+full.idx+'">'+data+'</a>';
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
