@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('cafe24tokenlist') }}

     <table id="cafe24tokenlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>설치일</th>
                 <th>토큰갱신</th>
                 <th>삭제일</th>
                 <th>몰아이디</th>
                 <th>구분</th>
                 <th>앱아이디</th>
                 <th>회원아이디</th>
                 <!-- <th>주문번호</th> -->
                 <!-- <th>API</th> -->
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
    $('#cafe24tokenlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('cafe24tokenlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'issued_date', name: 'issued_date' },
            { data: 'refresh_date', name: 'refresh_date' },
            { data: 'refresh_date', name: 'refresh_date' },
            { data: 'mall_id', name: 'mall_id' },
            { data: 'shop_no', name: 'shop_no' },
            { data: 'app_id', name: 'app_id' },
            { data: 'mem_id', name: 'mem_id' },
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
        order: [[ 4, 'desc']],
        paging: true,
        pageLength: 50,
        fixedHeader: false,
        responsive: true,
        orderClasses: false,
        stateSave: false,

        "fnDrawCallback": function () {
            $("#cafe24tokenlistTable tbody tr td:not(.select-checkbox)").click(function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              // table = $('#cafe24tokenlistTable').dataTable();
              // window.location.href = "/cafe24tokendetail/" + this.id;
              window.location.href = "/cafe24tokendetail/" + nRow.target.parentElement.id;
            });
         }
    });
});
</script>
@endpush
