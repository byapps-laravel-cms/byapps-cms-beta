@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('resellerpaymentlist') }}

     <table id="resellerpaymentlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>결제일</th>
                 <th>리셀러</th>
                 <th>앱명</th>
                 <th>구분</th>
                 <th>기간</th>
                 <th>결제금액</th>
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
    $('#resellerpaymentlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('resellerpaymentlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'reg_time', name: 'reg_time' },
            { data: 'recom_id', name: 'recom_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'pay_type', name: 'pay_type' },
            { data: 'term', name: 'term' },
            { data: 'amount', name: 'amount' },
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
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#resellerpaymentlistTable tbody tr").click(function () {
              table = $('#resellerpaymentlistTable').dataTable();
              window.location.href = "/resellerpaymentdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
