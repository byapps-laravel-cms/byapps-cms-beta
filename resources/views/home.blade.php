@extends('layouts.default')

@section('content')
<style>
.input-group-text {
  font-size: 11px;
}
</style>

@if (Auth::user())
<div class="container-fluid">

<div class="sortable">

      @foreach ($home_layouts as $layout)
        @if ($layout == 'layout1')
        <li class="ui-state-default one card" id="layout1">
            <div class="cal_box">
                <div class="card-title m-2">
                    <i class="fi-menu"></i> 주문요청현황
                    <button class="btn float-right" type="button" data-toggle="collapse" data-target="#salesList" aria-expanded="true" aria-controls="salesList"><i class="dripicons-chevron-down"></i></button>
                </div>
            </div>

            @include('components.status')
        </li>

      @elseif ($layout == 'layout2')
      <li class="ui-state-default card" id="layout2">
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

          @include('components.chart')
        </li>

      @elseif ($layout == 'layout3')
      <li class="ui-state-default card" id="layout3">

          @include('components.sales')

      </li>

      @elseif ($layout == 'layout4')
      <li class="ui-state-default one card" id="layout4">
          <div class="cal_box">
              <div class="card-title m-2">
                  <i class="fi-menu"></i> 만료예정업체
                  <button class="btn float-right" type="button" data-toggle="collapse" data-target="#endList" aria-expanded="true" aria-controls="endList">
                    <i class="dripicons-chevron-down"></i>
                  </button>
              </div>
          </div>

          @include('components.expiredlist')

      </li>
      @endif
  @endforeach
</div>

<!-- Pages -->

</div>
@endif
@endsection
