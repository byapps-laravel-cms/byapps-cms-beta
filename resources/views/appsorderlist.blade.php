@extends('layouts.default')

@section('content')

<div class="container col-12 col-md-12">

  <div class="method">
    <div class="col-md-12 mt-3">

      {{ Breadcrumbs::render('appsorderlist') }}

     <table id="appsorderlistTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">

       <input id="btnGet" type="button" value="Get Selected" onclick="getSelect()">

         <thead>
             <tr>
                 <th>idx</th>
                 <th>주문일</th>
                 <!-- <th>진행상태</th> -->
                 <th>
                   <select name="app_process_filter" id="app_process_filter" class="form-control">
                     <option value="">진행상태</option>
                     @php
                      $app_process = [
                          						'0' => "주문취소",
                          						'1' => "접수",
                          						'2' => "주문확인",
                          						'3' => "개발진행",
                          						'4' => "앱등록",
                          						'5' => "서비스중지",
                          						'6' => "서비스해지",
                          						'8' => "취소요청",
                          						'9' => "완료"
                          					  ];
                     @endphp
                     @foreach($app_process as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                     @endforeach
                   </select>
                 </th>
                 <th>결제</th>
                 <th>영수증</th>
                 <th>주문자명</th>
                 <th>업체명</th>
                 <th>연락처</th>
                 <th>앱명</th>
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
$(document).ready(function() {

  fetch_data();

  function fetch_data(app_process = '') {
      $('#appsorderlistTable').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('appsorderlist') }}",
            crossDomain: true,
            data: {
              app_process: app_process
            }
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
             {
                'targets': 2,
                'searchable': false,
                'orderable': false,
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
              $("#appsorderlistTable tbody tr td:not(.select-checkbox)").click(function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                // table = $('#appsorderlistTable').dataTable();
                // window.location.href = "/appsorderdetail/" + this.id;
                window.location.href = "/appsorderdetail/" + nRow.target.parentElement.id;
              });
           },
           "rowCallback": function(row, data, index) {
             var cellValue = data['app_process'];

             $('td:eq(2)', row).addClass('align-middle text-center');
             switch (cellValue) {
              case '접수대기':
                  $('td:eq(2)', row).html("<button class='btn btn-purple btn-rounded btn-xs'>접수대기</button>");
                  break;
              case '접수':
                  $('td:eq(2)', row).html("<button class='btn btn-primary btn-rounded btn-xs'>접수</button>");
                  break;
              case '주문확인':
                  $('td:eq(2)', row).html("<button class='btn btn-success btn-rounded btn-xs'>주문확인</button>");
                  break;
              case '개발진행':
                  $('td:eq(2)', row).html("<button class='btn btn-danger btn-rounded btn-xs'>개발진행</button>");
                  break;
              case '주문취소':
                  $('td:eq(2)', row).html("<button class='btn btn-light btn-rounded btn-xs'>주문취소</button>");
                  break;
              case '앱등록':
                  $('td:eq(2)', row).html("<button class='btn btn-inverse btn-rounded btn-xs'>앱등록</button>");
                  break;
                  case 'default':
                  break;
              }
           },
      });
  }

  $('#app_process_filter').change(function() {
    var app_process = $('#app_process_filter').val();

    $('#appsorderlistTable').DataTable().destroy();

    fetch_data(app_process);
  });

  function getSelect() {
    var selectedRows = $('#appsorderlistTable').DataTable().rows({ selected:true }).data.toArray();
    console.log("Here", selectedRows);
  }

})

</script>
@endpush
