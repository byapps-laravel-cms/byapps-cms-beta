<template>
  <div>

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

  <div class="dragbox_hover row collapse show" id="app">

      <!-- 앱 통계 차트 -->
      <div class="col-xs-12 col-md-4">
        <div align="center">
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="appStatsDaily">일간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="appStatsWeekly">주간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
          <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="app_stats_total()">전체</button>
        </div>
        <div id="app_stats"></div>
      </div>

      <!-- MA 통계 차트 -->
      <div class="col-xs-12 col-md-4">
          <div align="center">
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_stats_daily()">일간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">주간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_stats_total()">전체</button>
          </div>
          <div id="ma_stats"></div>
      </div>

      <!-- MA 통합 차트 -->
      <div class="col-xs-12 col-md-4">
          <div align="center">
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_integ_stats_daily()">일간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">주간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs">월간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" onclick="ma_integ_stats_total()">전체</button>
          </div>
          <div id="ma_integ_stats"></div>
      </div>

  </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data: function() {
    return {
    }
  },
  mounted() {
    console.log("charts here");
    this.drawCharDefault();
  },
  methods: {
    drawCharDefault() {
      var today = (new Date()).toISOString().split('T')[0];
      axios({
        method: 'POST',
        url: '/chart',
        data: {
          date: today
        }
      }).then(
        response => {
          showChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    appStatsDaily() {
      var today = (new Date()).toISOString().split('T')[0];
      console.log(today);
      axios({
        method: 'POST',
        url: '/chart/app_daily',
        data: {
          //date: $('#start_date_chart').val(),
          date: today,
        }
      }).then(
        response => {
          console.log(response)
          showAppChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    appStatsWeekly() {
      var today = (new Date()).toISOString().split('T')[0];
      console.log(today);
      axios({
        method: 'POST',
        url: '/chart/app_weekly',
        data: {
          date: today,
        }
      }).then(
        response => {
          console.log(response)
          showAppChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
  }
}

function showChart (data) {
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
        title: "앱 서비스 통계",
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
    data: {
      columns: data.circle3,
      type: "donut",
      colors: {
        "무료": "#009634",
        "유료": "#35ba62",
        "관리": "#95dbac"
      },
    },
    donut: {
      title: "MA 통합",
      label: {
        format: function(value, ratio, id) {
          return value + "개 \n" + (ratio * 100).toFixed(1) + "%";
        }
      }
    },
    bindto: "#ma_integ_stats"
  });
}

function showAppChart (data) {
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

</script>
