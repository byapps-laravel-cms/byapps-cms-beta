@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appendixorderlist') }}

     <table id="appendixorderlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>주문일</th>
                 <th>상태</th>
                 <th>주문내역</th>
                 <th>결제</th>
                 <th>영수증</th>
                 <th>주문자명</th>
                 <th>업체명</th>
                 <th>연락처</th>
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
    $('#appendixorderlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appendixorderlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'reg_time', name: 'reg_time' },
            { data: 'app_process', name: 'app_process' },
            { data: 'service_type', name: 'service_type' },
            { data: 'pay_way', name: 'pay_way' },
            { data: 'receipt', name: 'receipt' },
            { data: 'order_name', name: 'order_name' },
            { data: 'app_company', name: 'app_company' },
            { data: 'cellno', name: 'cellno' }
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
             'targets': 6,
             'render': function ( data, type, full, meta ) {
                return '<a href="/appendixorderdetail/'+full.idx+'">'+data+'</a>';
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
