@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 margin-5">

     <table id="paymentTable" class="table table-striped mb-3" style="width:100%;">
         <col width="40%">
         <col width="5%">
         <col width="30%">
         <col width="10%">
         <col width="15%">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱명</th>
                 <th>구분</th>
                 <th>기간</th>
                 <th>결제금액</th>
                 <th>결제일</th>
             </tr>
         </thead>

      </div>
  </div>
</div>
@stop

@push('scripts')
<script type="text/javascript">
$(function() {
    $('#paymentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('paylist.data') }}",
        columns: [
            { data: 'idx', name: 'idx' },
            { data: 'app_name', name: 'app_name' },
            { data: 'pay_type', name: 'pay_type' },
            { data: 'term', name: 'term' },
            { data: 'amount', name: 'amount' },
            { data: 'reg_time', name: 'reg_time' }
        ]
    });
});
</script>

@endpush
