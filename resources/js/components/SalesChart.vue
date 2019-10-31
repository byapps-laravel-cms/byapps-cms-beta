<template>
  <div>
    <div class="cal_box">
        <div class="card-title m-2">
            <i class="fi-menu"></i> 매출 통계
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
            <input type="text" id="start_date_sales" name="start_date_sales" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
            <div class="input-group-append">
              <span class="input-group-text">부터</span>
            </div>
            <input type="text" id="end_date_sales" name="end_date_sales" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
            <div class="input-group-append">
              <span class="input-group-text">까지</span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">
                <a href="javascript:void(0)" onclick="stat_salesDateTerm(7)">일주일</a>
              </span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">
                <a href="javascript:void(0)" onclick="stat_salesDateTerm(30)">1개월</a>
              </span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">
                <a href="javascript:void(0)" onclick="stat_salesDateTerm(90)">3개월</a>
              </span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">
                <a href="javascript:void(0)" onclick="stat_salesDateTerm(180)">6개월</a>
              </span>
            </div>
            <div class="input-group-append">
              <span class="input-group-text">
                <a id="getDate" href="javascript:void(0)" @click="showEntireSalesChart"><i class="entypo-chart-bar"></i> 보기</a>
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
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="salesStatsDaily">일간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="salesStatsWeekly">주간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="salesStatsMonthly">월간</button>
            <button class="btn btn-light btn-rounded btn-bordered waves-effect waves-light btn-xs" @click="salesStatsTotal">전체</button>
          </div>
            <div id="sale_stats" data-toggle="modal" data-target="#lankDetail"></div>
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
    console.log("sales chart here");
    this.drawSalesCharDefault();
  },
  methods: {
    drawSalesCharDefault() {
      var today = (new Date()).toISOString().split('T')[0];

      axios({
        method: 'POST',
        url: '/saleschart',
      }).then(
        response => {
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    showEntireSalesChart() {
      var date1 = $('#start_date_sales').val();
      var date2 = $('#end_date_sales').val();
      axios({
        method: 'POST',
        url: '/saleschart/entire_chart',
        data: {
          date1: date1,
          date2: date2,
        }
      }).then(
        response => {
          console.log(response)
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    salesStatsTotal() {
      axios({
        method: 'GET',
        url: '/saleschart/sales_total',
      }).then(
        response => {
          console.log(response)
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    salesStatsDaily() {
      var today = (new Date()).toISOString().split('T')[0];

      axios({
        method: 'POST',
        url: '/saleschart/sales_term',
        data: {
          date1: today,
          date2: today,
        }
      }).then(
        response => {
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    salesStatsWeekly() {
      var today = (new Date()).toISOString().split('T')[0];
      var newDate = new Date(today);
      newDate.setDate(newDate.getDate() - 7);
      var nday = new Date(newDate).toISOString().split('T')[0];

      axios({
        method: 'POST',
        url: '/saleschart/sales_term',
        data: {
          date1: today,
          date2: nday,
        }
      }).then(
        response => {
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
    salesStatsMonthly() {
      var today = (new Date()).toISOString().split('T')[0];
      var newDate = new Date(today);
      newDate.setDate(newDate.getDate() - 30);
      var nday = new Date(newDate).toISOString().split('T')[0];

      axios({
        method: 'POST',
        url: '/saleschart/sales_term',
        data: {
          date1: today,
          date2: nday,
        }
      }).then(
        response => {
          showSalesChart(response.data)
        },
        error => {
          console.log(error)
        }
      )
    },
  }
}

// 통계 기본
function showSalesChart(data) {
  var chart1 = bb.generate({
    // title: {
    //   text: "매출 통계"
    // },
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
  		      return 'Data ' + d;
          },
        }
      },
    bindto: "#sale_stats"
  });
}


</script>
