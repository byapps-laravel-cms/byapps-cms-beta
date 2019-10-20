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
            <a href="javascript:void(0)" onclick="showEntireTable(day1, day2)"><i class="entypo-chart-bar"></i> 보기</a>
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
            <td> </td> <td></td> <td></td>
            <td> </td> <td></td> <td></td>
            <td> </td> <td></td> <td></td>
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
