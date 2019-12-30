@extends('layouts.default')

@section('style')
<style>
/* image center crop */
.img-centercrop{
	overflow:hidden;
	position:relative;
}
.img-centercrop img{
	object-fit: cover;
	width:100%;height:100%;
}
</style>
@endsection
@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('pushlist') }}

     <table id="pushlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
		 <colgroup>
			<col width="3%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
			<col width="27%">
			<col width="10%">
			<col width="10%">
			<col width="10%">
		 </colgroup>
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱아이디</th>
                 <th>앱명</th>
                 <th>OS/LAN</th>
                 <th>알림내용</th>
                 <th>GCM</th>
                 <th>iOS</th>
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
    $('#pushlistTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('pushlist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_id', name: 'app_id' },
            { data: 'app_name', name: 'app_name' },
            { data: 'os', name: 'os' },
            { data: 'msg', name: 'msg' },
            { data: 'send_gcm', name: 'send_gcm' },
            { data: 'send_ios', name: 'send_ios' },
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
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 7, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": false,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#pushlistTable tbody tr").click(function () {
              table = $('#pushlistTable').dataTable();
              //window.location.href = "/appsdetail/" + this.id;
            });
         }
    });
});
</script>
@endpush
