@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 margin-5">
      {{ Breadcrumbs::render('promo') }}

     <table id="promotionTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <col width="5%">
         <col width="35%">
         <col width="10%">
         <col width="10%">
         <col width="15%">
         <col width="15%">
         <col width="10%">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>프로모션명</th>
                 <th>회원</th>
                 <th>사용</th>
                 <th>적용대상</th>
                 <th>적용내용</th>
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
    $('#promotionTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('promolist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'pm_title', name: 'pm_title' },
            { data: 'mem_name', name: 'mem_name' },
            { data: 'pm_used', name: 'pm_used' },
            { data: 'pm_target', name: 'pm_target' },
            { data: 'pm_comment', name: 'pm_comment' },
            { data: 'reg_time', name: 'reg_time' }
        ],
        columnDefs: [
           {
              'targets': 0,
              //'width': '5%',
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
                return '<a href="/promodetail/'+full.idx+'">'+data+'</a>';
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
