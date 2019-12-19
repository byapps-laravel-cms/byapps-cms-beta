@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('resellerinfodetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($resellerInfoData)
                    <h4 class="header-title">{{ $resellerInfoData->company }}</h2>
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
                      {!! Form::open([ 'route' => ['resellerinfoupdate', $resellerInfoData->idx] ]) !!}

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">ID</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="mem_id" name="mem_id" value="{{ $resellerInfoData->mem_id }}">
                                        <p>&nbsp;(영문/숫자 20자 이내)</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">새 비밀번호</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="password" class="form-control mr-1" id="new_passwd" name="new_passwd" value="">
                                      <p class="form-control-static mt-1 mb-1">새 비밀번호 확인</p>
                                      <input type="password" class="form-control ml-1 mr-1" id="new_passwd_confirm" name="new_passwd_confirm" value="">
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
                                      <input type="text" class="form-control" id="company" name="company" value="{{ $resellerInfoData->company }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">대표자명</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="company_owner" name="company_owner"  value="{{ $resellerInfoData->company_owner }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">담당자명</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_name" name="mem_name" value="{{ $resellerInfoData->mem_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="email" class="form-control" id="mem_email" name="mem_email" value="{{ $resellerInfoData->mem_email }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                    <p class="form-control-static mt-1 mb-1">
                                      전화 <input type="text" class="form-control" id="phoneno" name="phoneno" value="{{ $resellerInfoData->phoneno }}">
                                      휴대폰 <input type="text" class="form-control" id="cellno" name="cellno" value="{{ $resellerInfoData->cellno }}">
                                      <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="SMS 보내기">
                                     <p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">사업자번호</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="company_no" name="company_no" value="{{ $resellerInfoData->company_no }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">주소지</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="address" name="address" value="{{ $resellerInfoData->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">입금정보</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <p class="input-group">
                                        <p class="form-control-static mt-1 mb-1">
                                            은행 <input type="text" class="form-control" id="company_bank0" name="company_bank0" value="{{ explode('|', $resellerInfoData->company_bank)[0] }}">
                                            계좌번호 <input type="text" class="form-control" id="company_bank1" name="company_bank1" value="{{ explode('|', $resellerInfoData->company_bank)[1] }}">
                                            예금주 <input type="text" class="form-control" id="company_bank2" name="company_bank2" value="{{ explode('|', $resellerInfoData->company_bank)[2] }}">
                                        </p>
                                    <p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">수익률</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <p class="form-control-static mt-1 mb-1">
                                        <input type="text" class="form-control" id="returns_percent" name="returns_percent" value="{{ $resellerInfoData->returns_percent }}">%
                                        @if ($resellerInfoData->mem_lv != 1)
                                          <input class="btn btn-info waves-effect btn-xs ml-1" type="button" value="승인처리" onclick="updateMemlv()">
                                        @endif
                                      </p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-md-10 col-xs-9">
                                <label for="" class="radio-inline" id="radio-inline">
                                  <input type="checkbox" name="radios" id="modify" value="modify">수정하기
                                  <input type="checkbox" name="radios" id="delete" value="delete">삭제하기
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 col-xs-9 offset-md-2">
                                <button type="submit" class="btn btn-info btn-sm float-center" >등록하기</button>
                                <button type="submit" class="btn btn-danger btn-sm float-center ml-1" >취소</button>
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

@push('scripts')
<script>
$(document).ready(function() {

checkRadiobutton();

// radio button 눌렸는지 체크
function checkRadiobutton() {
  var update_select = function (){
    if ($('#modify').is(':checked')) {
      $('#delete').attr('disabled', "disabled");
    }
    else if ($('#delete').is(':checked')){
      $("#delete").removeAttr("disabled");
      $('#modify').attr('disabled', "disabled");
    } else {
      $("#modify").removeAttr("disabled");
      $("#delete").removeAttr("disabled");
    }
  };

  $(update_select);
  $('#radio-inline').change(update_select);
}

});

function updateMemlv(idx) {
  var idx = {!! json_encode($resellerInfoData->idx) !!};

  $.ajax({
    async: false,
    url: '{{ Route("updatememlv") }}',
    type: 'POST',
    data: {
      idx: idx,
      _token: "{{ csrf_token() }}"
    },
    success: function(response) {
      //console.log(response);
    },
  });
}

</script>
@endpush

@endsection
