@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('userinfodetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($userInfoData)
                    <h4 class="header-title">{{ $userInfoData->app_name }}</h2>
                    @else
                    <h4 class="header-title">Something went wrong.</h4>
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

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">RESELLER ID</label>
                            <div class="col-md-10 col-xs-9">
                              <p class="form-control-static mt-1 mb-1">
                                {{ $userInfoData->recom_id }} &nbsp&nbsp
                                <strong>{{ $resellerData->company }}
                                ({{ $resellerData->mem_name }}, {{ $resellerData->cellno }}, {{ $resellerData->phoneno }})</strong>
                              </p>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">고객 ID</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="mem_id" value="{{ $userInfoData->mem_id }}">
                                        <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원로그인" onclick="getMemberInfo({!! json_encode($userInfoData->idx)!!})">
                                        <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="주문내역">
                                        <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="결제내역">
                                        <input class="btn btn-success waves-effect btn-xs mr-1" type="button" value="앱 관리" onclick="goToAppsOrderList()">
                                        <input class="btn btn-warning waves-effect btn-xs mr-1" type="button" value="프로모션 발급">
                                        <input class="btn btn-danger waves-effect btn-xs mr-1" type="button" value="ID 변경">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">새 비밀번호</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="password" class="form-control mr-1" id="new_passwd" value="">
                                      <p class="form-control-static mt-1 mb-1">새 비밀번호 확인</p>
                                      <input type="password" class="form-control ml-1 mr-1" id="new_passwd_confirm" value="">
                                      <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="비밀번호 초기화 메일발송">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_nick" value="{{ $userInfoData->mem_nick }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">대표자명</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="ceo_name" value="{{ $userInfoData->ceo_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">담당자명</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_name" value="{{ $userInfoData->mem_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="cell_no" value="{{ $userInfoData->cell_no }}">
                                      <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">만료알림 연락처</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="phone_no" value="{{ $userInfoData->phone_no }}">
                                      <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_email" value="{{ $userInfoData->mem_email }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">로그정보</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <p class="input-group">
                                        <p class="form-control-static mt-1 mb-1">
                                            로그정보
                                        </p>
                                    <p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-md-10 col-xs-9">
                                <label for="" class="radio-inline">
                                <input type="checkbox" name="modify" value="modify">수정하기
                                </label>
                                <label for="" class="radio-inline">
                                <input type="checkbox" name="delete" value="delete">삭제하기
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 col-xs-9 offset-md-2">
                                <button type="submit" class="btn btn-info btn-sm float-left" >등록하기</button>
                                <button type="submit" class="btn btn-danger btn-sm float-left ml-1" >취소</button>
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
function getMemberInfo(idx) {
  console.log(idx);
  sidebarOpen();
}

// 앱관리 눌렀을 때 실행되는 함수 내에서 호출함
function getAddpsOrderIdx() {
  var mem_id = {!! json_encode($userInfoData->mem_id) !!};

  $.ajax({
    async: false,
    url: '{{ Route("getappsorderidx") }}',
    type: 'POST',
    data: {
      mem_id: mem_id,
      _token: "{{ csrf_token() }}"
    },
    success: function(response) {
      console.log(response['idx']);
      idx = response['idx'];
    },
  });

  return idx;
}

// 앱 관리 버튼 눌렀을 때 실행 --> 앱 접수 정보로 이동시킴
function goToAppsOrderList() {
  var idx = getAddpsOrderIdx();
  //console.log(idx);
  window.location.href = "/appsorderdetail/"+idx;
}
</script>


@endsection
