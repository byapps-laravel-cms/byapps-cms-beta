@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('qnanonmemberlist') }}

     <table id="qnanonmemberlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>상태</th>
                 <th>업체명</th>
                 <th>담당자</th>
                 <th>이메일</th>
                 <th>연락처</th>
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
    $('#qnanonmemberlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('qnanonmemberlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'process', name: 'process' },
            { data: 'company', name: 'company' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'reg_date', name: 'reg_date' },
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
                return '<a href="/qnanonmemberdetail/'+full.idx+'">'+data+'</a>';
             }
           },
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 6, 'desc']],
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
