@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('pushonoffstatlist') }}

     <table id="pushonoffstatlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>OS</th>
                 <th>On/Off</th>
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
    $('#pushonoffstatlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pushonoffstatlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_os', name: 'app_os' },
            { data: 'on_off', name: 'on_off' },
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
            $("#pushonoffstatlistTable tbody tr").click(function () {
              table = $('#pushonoffstatlistTable').dataTable();
              window.location.href = "/pushonoffstatdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
