
$.request('onGetChartData', {
  success: function(data) {
    showChart(data);
  }
});

function showChart (data) {
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
    donut: {
      title: "앱 통계"
    },
    bindto: "#app_stats"
    });


  var chart = bb.generate({
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
      title: "MA 통계"
    },
    bindto: "#ma_stats"
    });


  var chart = bb.generate({

    data: {
        columns: data.bar,
        type: "bar",
        colors: {
        "신규": "#fca1b0",
        "연장": "#f9637c",
        "기타": "#d7215c"
        }
    },
    bar: {
        width: {
        ratio: 0.8
        }
    },
        bindto: "#sale_stats"
    });


}
