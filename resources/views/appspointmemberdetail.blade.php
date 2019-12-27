<?
/*
	생성자 : 박현우
	생성일 : 2019-12-26
	인증회원 상세 페이지
*/
?>
@extends('layouts.default')

@section('content')
<div class="container-fluid">

  {{ Breadcrumbs::render('appspointmemberdetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($valu)
                    <h4 class="header-title">{{ $valu['app_name'] }}</h2>
                    @else
                    <h4 class="header-title">Something went wrong.</h4>
                    @endif

                    <hr />

                    <div class="row" id="appsPointMemberData">
                      <div class="col-md-12 col-xs-12 px-4">
                          <div class="form-group row">
                              <label class="col-md-2 col-form-label ">회원 ID</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['mem_id'] }} ({{ $valu['app_lang'] }} / {{ $valu['app_os'] }} / ver {{ $valu['app_ver'] }} / {{ $valu['app_udid'] }})
                                </p>
                              </div>

                              <label class="col-md-2 col-form-label ">Device Info.</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['device_name'] }} ({{ $valu['device_ver'] }} / {{ $valu['push_agree'] }})</p>
                              </div>

                              <label class="col-md-2 col-form-label ">설치날짜</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['reg_time'] }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">방문통계</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['visit_cnt'] }} 회, {{ $valu['last_time'] }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">구매통계</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['order_cnt'] }} 회, 총 {{ $valu['order_amount'] }}원, {{ $valu['last_purchase_time'] }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">앱포인트</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['total_point'] }} ({{ $valu['total_payback_point'] }})</p>
                              </div>
                            </div>

                          </div><!-- col12 end-->
                      </div><!--row end-->

            </div><!--col-sm-12 end-->
          </div><!-- row end -->

        </div><!-- cardbody end -->

      </div>
      <!-- card end -->
    </div>
    <!-- col-12 end -->
  </div>
  <!-- row end -->
</div>
<!-- container-fluid end -->

@toastr_css
@toastr_js
@toastr_render

<script>

// 사이드바 열고 고객정보 보기
function getMemberInfo(idx) {
  console.log(idx);
  sidebarOpen();
}

</script>
@endsection
