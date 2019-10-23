<div class="dragbox_hover row collapse show" id="allchart">
    <!-- 앱 통계 차트 -->
    <div class="col-xs-12 col-md-3">
      <div align="center">
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="app_stats_daily(date)">일간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">주간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
        <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="app_stats_total()">전체</button>
      </div>
      <div id="app_stats"></div>
    </div>
    <!-- MA 통계 차트 -->
    <div class="col-xs-12 col-md-3">
        <div align="center">
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_stats_daily()">일간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">주간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_stats_total()">전체</button>
        </div>
        <div id="ma_stats"></div>
    </div>

    <!-- 매출 통계 차트 -->
    <div class="col-xs-12 col-md-6 pl-0 pr-5">
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
  var data = {!! json_encode($chartData) !!}
  showChart(data);
});

// 앱 통계 일간
function app_stats_daily(date) {
  console.log(date);
  $.ajax({
      url: "/chart/app_daily",
      method: "post",
      data: date,
      success: function(data) {
        showAppChart(data);
      },
      error: function(err) {
        console.log(err);
      }
  });
}

// 앱 통계 전체
function app_stats_total() {
  $.ajax({
      url: "/chart/app_total",
      method: "get",
      success: function(data) {
        showAppChart(data);
      },
      error: function(err) {
        console.log(err);
      }
  });
}

// 통계 기본
function showChart(data) {
    var chart1 = bb.generate({
      data: {
          columns: data.circle1,
          type: "donut",
          colors: {
            "무료": "#17b4dd",
            "유료": "#038db2",
            "관리": "#69bbd1"
          },
          onover: function(d) {
            //console.log("onover", d)
          }
      },
      tooltip: {
        format: {
          value: function(value) {
            return value;
          }
        }
      },
      donut: {
        title: "앱 통계",
        label: {
          format: function(value, ratio, id) {
            return value + "개\n" + (ratio * 100).toFixed(1) + "%";
          }
        }
      },
      bindto: "#app_stats"
  });

  var chart2 = bb.generate({
    data: {
      columns: data.circle2,
      type: "donut",
      colors: {
          "무료": "#f6b300",
          "유료": "#e88d00",
          "관리": "#fcca8f"
      },
    },
    donut: {
      title: "MA 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개 \n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#ma_stats"
  });

  var chart3 = bb.generate({
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

// 앱 통계
function showAppChart(data) {
    var chart = bb.generate({
    data: {
        columns: data.circle1,
        type: "donut",
        colors: {
          "무료": "#17b4dd",
          "유료": "#038db2",
          "관리": "#69bbd1"
        },
    },
    tooltip: {
      format: {
        value: function(value) {
          return value;
        }
      }
    },
    donut: {
      title: "앱 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개\n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#app_stats"
  });
}

// MA 통계
function showMaChart(data) {
  var chart2 = bb.generate({
    data: {
      columns: data.circle2,
      type: "donut",
      colors: {
          "무료": "#f6b300",
          "유료": "#e88d00",
          "관리": "#fcca8f"
      },
    },
    donut: {
      title: "MA 통계",
      label: {
        format: function(value, ratio, id) {
          return value + "개 \n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#ma_stats"
  });
}




</script>
