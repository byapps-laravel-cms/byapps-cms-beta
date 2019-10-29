@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appsorderlist') }}

     <table id="appsorderlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>주문일</th>
                 <th>진행상태</th>
                 <th>결제</th>
                 <th>영수증</th>
                 <th>주문자명</th>
                 <th>업체명</th>
                 <th>연락처</th>
                 <th>앱명</th>
                 <th>카테고리</th>
                 <th>개발OS</th>
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
    $('#appsorderlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appsorderlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'reg_time', name: 'reg_time' },
            { data: 'app_process', name: 'app_process' },
            { data: 'pay_way', name: 'pay_way' },
            { data: 'receipt', name: 'receipt' },
            { data: 'order_name', name: 'order_name' },
            { data: 'app_company', name: 'app_company' },
            { data: 'cellno', name: 'cellno' },
            { data: 'app_name', name: 'app_name' },
            { data: 'app_cate', name: 'app_cate' },
            { data: 'apps_type', name: 'apps_type' },
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
        order: [[ 1, 'desc']],
        paging: true,
        pageLength: 50,
        fixedHeader: false,
        responsive: true,
        orderClasses: false,
        stateSave: false,

        "fnDrawCallback": function () {
            $("#appsorderlistTable tbody tr").click(function () {
              table = $('#appsorderlistTable').dataTable();
              window.location.href = "/appsorderdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
