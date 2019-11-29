@extends('layouts.default')

@section('content')

  <div class="container col-12 col-md-12">

    <div class="method">
      <div class="col-md-12 margin-5">
        {{ Breadcrumbs::render('appspaylist') }}

       <table id="appspaymentTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <col width="3%">
         <col width="33%">
         <col width="5%">
         <col width="20%">
         <col width="15%">
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

        </table>
      </div>
    </div>

  </div>
@endsection

@push('scripts')
<script type="text/javascript">
$(function() {
    var table = $('#appspaymentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appspaylist') }}",
          crossDomain: true
        },
        columns: [
            { data: 'idx', name: 'idx', className:"test" },
            { data: 'app_name', name: 'app_name' },
            { data: 'pay_type', name: 'pay_type' },
            { data: 'term', name: 'term' },
            { data: 'amount', name: 'amount' },
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
           {
             'targets': 2,
             'className': 'dt-body-center',
           }
           // {
           //   'targets': 1,
           //   'render': function ( data, type, full, meta ) {
           //      return '<a href="/appspaydetail/'+full.idx+'">'+data+'</a>';
           //   }
           // },
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
            $("#appspaymentTable tbody tr").click(function () {
              table = $('#appspaymentTable').dataTable();
              window.location.href = "/appspaydetail/" + this.id;
            });
         },
         "rowCallback": function(row, data, index) {
           var cellValue = data['pay_type'];

           $('td:eq(2)', row).addClass('align-middle text-center');
           switch (cellValue) {
                case '기타':
                $('td:eq(2)', row).html("<btn btn-pink btn-rounded btn-xs'>기타</button>");
                break;
            case '신규': 
                $('td:eq(2)', row).html("<button class='btn btn-success btn-rounded btn-xs'>신규</button>");
                break;
            case '연장':
                $('td:eq(2)', row).html("<button class='btn btn-warning btn-rounded btn-xs'>연장</button>");
                break;
            case '추가':
                $('td:eq(2)', row).html("<button class='btn btn-info btn-rounded btn-xs'>추가</button>");
                break;
            case '충전':
                $('td:eq(2)', row).html("<button class='btn btn-purple btn-rounded btn-xs'>충전</button>");
            case 'default':
                break;
            }
         },
    });
});


</script>
@endpush
