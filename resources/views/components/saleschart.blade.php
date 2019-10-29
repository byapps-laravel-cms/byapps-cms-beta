<div class="cal_box">
    <div class="card-title m-2">
        <i class="fi-menu"></i> 통계
        <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allchart" aria-expanded="true" aria-controls="allchart">
          <i class="dripicons-chevron-down"></i>
        </button>
    </div>
</div>

<!-- 기간조회 -->
<div class="card-title">
  <div class="row justify-content-md-center mb-5">

    <div class="col-md-9">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">통계기간</span>
        </div>
        <input type="text" id="start_date_chart" name="start_date_chart" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
        <div class="input-group-append">
          <span class="input-group-text">부터</span>
        </div>
        <input type="text" id="end_date_chart" name="end_date_chart" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
        <div class="input-group-append">
          <span class="input-group-text">까지</span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_chartDateTerm(7)">일주일</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_chartDateTerm(30)">1개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_chartDateTerm(90)">3개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_chartDateTerm(180)">6개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a id="getDate" href="javascript:void(0)" onclick="showEntireChart($('#start_date_chart').val(), $('#end_date_chart').val())"><i class="entypo-chart-bar"></i> 보기</a>
          </span>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- 기간조회 End -->

<div class="dragbox_hover row collapse show" id="allchart">

    <!-- 매출 통계 차트 -->
    <div class="col-xs-12 col-md-12 pl-0 pr-5">
      <div align="center">
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="sales_stats_daily()">일간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">주간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="sales_stats_total()">전체</button>
      </div>
        <div id="sale_stats" data-toggle="modal" data-target="#lankDetail"></div>
    </div>

</div>

<script>
$(document).ready(function() {
  var data = {!! json_encode($salesChartData) !!}
  showSalesChart(data);
});

// 매출 통계 일간
function sales_stats_daily(date) {
  console.log(date);
  $.ajax({
      url: "/saleschart/sales_daily",
      method: "post",
      data: date,
      success: function(data) {
        //showAppChart(data);
      },
      error: function(err) {
        console.log(err);
      }
  });
}

// 매출 통계 전체
function sales_stats_total() {
  $.ajax({
      url: "/saleschart/sales_total",
      method: "get",
      success: function(data) {
        showSalesChart(data);
      },
      error: function(err) {
        console.log(err);
      }
  });
}

// 통계 기본
function showSalesChart(data) {
  var chart1 = bb.generate({
    title: {
      text: "매출 통계"
    },
    data: {
        columns: data.bar,
        type: "bar",
        colors: {
          "전체": "#97215c",
          "신규": "#fca1b0",
          "연장": "#f9637c",
          "기타": "#d7215c"
        },
        labels: {
          centered: true,
          format: function(x) {
              return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
          }
        }
    },
    bar: {
        width: {
          ratio: 0.8
        }
    },
    tooltip: {
      format: {
        title: function(d) {
           // console.log(d);
  		      return 'Data ' + d;
          },
        }
      },
    bindto: "#sale_stats"
  });
}


</script>
