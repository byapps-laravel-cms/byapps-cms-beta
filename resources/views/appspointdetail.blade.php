<?
/*
	생성자 : 박현우
	생성일 : 2019-12-26
	앱포인트 상세 페이지
*/
?>
@extends('layouts.default')

@section('content')
<div class="container-fluid">

  {{ Breadcrumbs::render('appspointdetail') }}

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

                    <div class="row" id="appsPointData">
                      <div class="col-md-12 col-xs-12 px-4">
						<!-- form start -->
						{!! Form::open([ 'route' => ['appspointtransfter', $valu['idx']] ]) !!}
						<input type="hidden" name="op" value="point_transfer">
	  					<input type="hidden" name="idx" value="{{ $valu['idx'] }}">
						<input type="hidden" name="app_id" value="{{ $valu['app_id'] }}">
						<input type="hidden" name="app_mid" value="{{ $valu['mem_id'] }}">
						<input type="hidden" name="app_token" value="{{ $valu['app_udid'] }}">
						<input type="hidden" name="app_name" value="{{ $valu['app_name'] }}">
						<input type="hidden" name="app_os" value="{{ $valu['app_os'] }}">
						<input type="hidden" name="app_ver" value="{{ [$valu['app_ver'] }}">	
                          <div class="form-group row">
                              <label class="col-md-2 col-form-label ">앱 아이디</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['app_id'] }}
                                </p>
                              </div>
								
							  <label class="col-md-2 col-form-label ">앱 버전</label>
							  <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['app_ver'] }}
                                </p>
                              </div>

                              <label class="col-md-2 col-form-label ">회원정보</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['mem_id'] }} / {{ $valu['app_os'] }} / {{ $valu['app_lang'] }} / {{ $valu['app_udid'] }}</p>
                              </div>

							  <label class="col-md-2 col-form-label ">적립내역</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['point_title'] }}({{ $valu['point_id'] }}) / {{ $valu['point'] }} / {{ $valu['reg_time'] }} => {{ $valu['msg'] }} 
								<input type="button" class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" value="전환" onclick="if(confirm('정말로 전환하시겠습니까?')){this.form.op.value='point_back';this.form.submit()}" class="nbutton3"></p>
                              </div>

                              <label class="col-md-2 col-form-label ">포인트</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['total_point'] }}({{ $valu['chk'] }}) / {{ $valu['total_payback_point'] }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">비고</label>
                              <div class="col-md-10 col-xs-9 text-danger" style="font-weight: bold">
                                <p class="form-control-static mt-1 mb-1">{{ $valu['err'] }}</p>
                              </div>

                              <div class="col-md-10 col-xs-9">
								{!! $valu['btn_act'] !!}
                              </div>
                            </div>
                          </div><!-- col12 end-->
						{!! Form::close() !!}
                        <!-- form end -->
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
