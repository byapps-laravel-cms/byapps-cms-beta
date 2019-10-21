<div class="cal_box">
    <div class="card-title m-2">
        <i class="fi-menu"></i> 매출 통계표
        <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allLank" aria-expanded="true" aria-controls="allLank">
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
        <input type="text" id="start_date_table" name="start_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
        <div class="input-group-append">
          <span class="input-group-text">부터</span>
        </div>
        <input type="text" id="end_date_table" name="end_date_table" value="" maxlength="10" class="form-control datepicker" placeholder="날짜입력" autocomplete="false">
        <div class="input-group-append">
          <span class="input-group-text">까지</span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_tableDateTerm(7)">일주일</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_tableDateTerm(30)">1개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_tableDateTerm(90)">3개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <a href="javascript:void(0)" onclick="stat_tableDateTerm(180)">6개월</a>
          </span>
        </div>
        <div class="input-group-append">
          <span class="input-group-text">
            <!-- <a href="javascript:void(0)" onclick="showEntireTable(day1, day2)"><i class="entypo-chart-bar"></i>보기</a> -->
            <a href="javascript:void(0)" onclick="platformData()"><i class="entypo-chart-bar"></i>보기</a>
          </span>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- 기간조회 End -->

<div class="dragbox_hover collapse show p-3" id="allLank">
    <!-- 매출 통계 표 -->
    <div class="table-responsive">
      <table class="table table-bordered">
      <thead>
        <tr>
            <th colspan="2" rowspan="2">구분</th>
            <th colspan="3">이번주</th> <th colspan="3">지난주</th> <th colspan="3">증감수</th>
        </tr>
        <tr>
            <th>전체</th> <th>유료</th> <th>무료</th>
            <th>전체</th> <th>유료</th> <th>무료</th>
            <th>전체</th> <th>유료</th> <th>무료</th>
        </tr>
        <tr>
            <th rowspan="2">이용수</th>
            <th>플랫폼</th>
            <td id="thisWeekTotal"></td> <td id="thisWeekPaid"></td> <td id="thisWeekFree"></td>
            <td id="lastWeekTotal"></td> <td id="lastWeekPaid"></td> <td id="lastWeekFree"></td>
            <td id="variTotal"></td>     <td id="variPaid"></td>     <td id="variFree"></td>
        </tr>
        <tr>
            <th>MA</th>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
    </div>
</div>

<script>
$(document).ready(function() {
  platformData();
});

function platformData() {
  var startdate = '';
  var enddate = '';

  var thisWeekTotal = '';
  var thisWeekPaid = '';
  var thisWeekFree = '';

  var lastWeekTotal = '';
  var lastWeekPaid = '';
  var lastWeekFree = '';

  var variTotal = '';
  var variPaid = '';
  var variFree = '';

  setTimeout(function() {
    startdate = $('#start_date_table').val();
    enddate = $('#end_date_table').val();

  $.ajax({
      url: "/sales",
      method: "post",
      data: {
        start: startdate,
        end: enddate
      },
      success: function(data) {
        console.log(data);
        thisWeekTotal = data[0]['thisTotal'];
        thisWeekPaid = data[0]['thisPaid'];
        thisWeekFree = data[0]['thisFree'];

        lastWeekTotal = data[1]['lastTotal'];
        lastWeekPaid = data[1]['lastPaid'];
        lastWeekFree = data[1]['lastFree'];

        variTotal = variation(thisWeekTotal, lastWeekTotal);
        variPaid = variation(thisWeekPaid, lastWeekPaid);
        variFree = variation(thisWeekFree, lastWeekFree);

        $('#thisWeekTotal').html(thisWeekTotal);
        $('#thisWeekPaid').html(thisWeekPaid);
        $('#thisWeekFree').html(thisWeekFree);

        $('#lastWeekTotal').html(lastWeekTotal);
        $('#lastWeekPaid').html(lastWeekPaid);
        $('#lastWeekFree').html(lastWeekFree);

        $('#variTotal').html(variTotal);
        $('#variPaid').html(variPaid);
        $('#variFree').html(variFree);

      },
      error: function(err) {
        console.log(err);
      }
    });

  }, 10);
}

// 증감수 계산
function variation(val1, val2) {
  return val1 - val2;
}
</script>
