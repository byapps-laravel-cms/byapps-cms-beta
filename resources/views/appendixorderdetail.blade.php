<?
/*
	생성자 : 박현우
	생성일 : 2019-12-26
	부가서비스 접수 상세 페이지
*/
?>
@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('appendixorderdetail') }}

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
                    <h4 class="header-title">{{ $valu['app_company'] }}</h2>
                    @else
                    <h4 class="header-title">데이터가 없습니다.</h4>
                    @endif

                    <hr />

                    @if ($message = Session::get('success'))
                    <div class="row justify-content-end">
                        <div class="col-3 col-align-self-end alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>
                            toastr.success("{{ $message }}");
                            </strong>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                    <div class="col-md-12 col-xs-12 px-4">
                        <!-- form start -->
                        {!! Form::open([ 'route' => ['appendixorderupdate', $valu['idx']] ]) !!}

						<input type="hidden" name="idx" value="{{ $valu['idx'] }}">
						<input type="hidden" name="mem_id" value="{{ $valu['mem_id'] }}">
						<input type="hidden" name="service_type" value="{{ $valu['service_type'] }}">
						<input type="hidden" name="app_process" value="{{ $valu['app_process'] }}">

                        <div class="form-group row" id="appEndixOrderDetail">
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">  {{ $valu['order_id'] }} {!! $valu['btn_cancel'] !!}</p>
                            </div>
                        </div>

						<div class="form-group row" id="appEndixOrderDetail">
                            <label class="col-md-2 col-form-label ">주문일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">  {{ $valu['reg_time'] }} </p>
                            </div>
                        </div>
						
						<div class="form-group row" id="appEndixOrderDetail">
                            <label class="col-md-2 col-form-label ">Process</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">  {!! $valu['app_proc'] !!} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원ID</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <div class="input-group">
                                        <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;{{ $valu['mem_id'] }} </p>
                                        <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원정보" onclick="getMemberInfo('{!! $valu['mem_id'] !!}')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $valu['app_company'] }} </p>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">신청자명</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $valu['order_name'] }} </p>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $valu['cellno'] }} {!! $valu['btn_sms'] !!} </p>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $valu['email'] }} </p>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">결제정보</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $valu['payment'] }} </p>
                            </div>
                        </div>

						<div class="form-group row">
                        <label class="col-md-2 col-form-label">영수증정보</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5">{{ $valu['receipt'] }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 col-xs-9 offset-md-2">
                                <button type="submit" class="btn btn-info btn-sm float-right" >업데이트</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!-- form end -->
                    </div>
                    </div><!--row end-->
                </div>
                    <!-- col-md-12 -->
            </div>
                <!-- row end -->
        </div>
        <!-- cardbody end -->
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
function getMemberInfo(mem_id) {
  console.log(mem_id);
  sidebarOpen();
}
</script>


@endsection
