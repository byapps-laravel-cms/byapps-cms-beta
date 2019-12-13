@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('adminlist') }}

     <table id="adminTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>IDX</th>
                 <th>이름</th>
                 <th>가입일자</th>
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
    $('#adminTable').DataTable({
        processing: true,
        serverSide: true,
        url: "{{ route('adminlist') }}",
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'mem_name', name: 'mem_name' },
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
        ],
        order: [[ 2, 'asc']],
        paging: true,
        pageLength: 50,
        fixedHeader: false,
        responsive: true,
        orderClasses: false,
        stateSave: false,
        "fnDrawCallback": function () {
            $("#adminTable tbody tr").click(function () {
              location.href = "{{ route('admindetail','') }}/" + this.id;
            });
         },
    });
});
</script>
@endpush
