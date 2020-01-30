@extends('layouts.default')

@section('content')

  <div class="container col-12 col-md-12">

    <div class="method">
      <div class="col-md-12 margin-5">
        {{ Breadcrumbs::render('appspaylist') }}

       <table id="appspaymentTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
         <thead>
             <tr>
                 <th>idx</th>
                 <th>앱명</th>
                 <!-- <th>구분</th> -->
                 <th>
                   <select name="pay_type_filter" id="pay_type_filter" class="form-control">
                     <option value="">구분</option>
                     @php
                      $pay_type = [
                          						'0' => "신규",
                          						'1' => "연장",
                          						'3' => "추가",
                          						'4' => "기타",
                          						'5' => "충전",
                          					  ];
                     @endphp
                     @foreach($pay_type as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                     @endforeach
                   </select>
                 </th>
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
$(document).ready(function() {

  fetch_data();

  function fetch_data(pay_type = '') {
    $('#appspaymentTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('appspaylist') }}",
          crossDomain: true,
          data: {
            pay_type: pay_type
          }
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
             'searchable': false,
             'orderable': false,
           }
        ],
        select: {
           'style': 'multi'
        },
        order: [[ 5, 'desc']],
        "paging": true,
        "pageLength": 50,
        "fixedHeader": true,
        "responsive": true,
        "orderClasses": false,
        "stateSave": false,

        "fnDrawCallback": function () {
            $("#appspaymentTable tbody tr td:not(.test)").click(function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
              //table = $('#appspaymentTable').dataTable();
              //console.log(nRow.target.parentElement.id);
              window.location.href = "/appspaydetail/" + nRow.target.parentElement.id;
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
  }

  $('#pay_type_filter').change(function() {
    var pay_type = $('#pay_type_filter').val();

    $('#appspaymentTable').DataTable().destroy();

    fetch_data(pay_type);
  });
})

</script>
@endpush
