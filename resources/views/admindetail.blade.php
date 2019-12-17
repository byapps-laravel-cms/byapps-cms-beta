@extends('layouts.default')

@section('content')

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                {{-- <div class="col-sm-12">
                    <h4>
                        <strong>{{ $appData->app_name }}</strong>
                    </h4>
                    <hr/>
                </div> --}}
                <div id="app_noti" class="row" >

                    <div class="col-12" style="overflow:auto;" >
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-myinfo-tab" data-toggle="tab" href="#nav-myinfo" role="tab" aria-controls="nav-myinfo" aria-selected="true">개인정보 변경</a>
                                <a class="nav-item nav-link" id="nav-app-company-tab" data-toggle="tab" href="#nav-app-company" role="tab" aria-controls="nav-app-company" aria-selected="false">지정업체 수정</a>
                                <a class="nav-item nav-link" id="nav-manager-tab" data-toggle="tab" href="#nav-manager-info" role="tab" aria-controls="nav-manager-info" aria-selected="false">관리자 권한 수정</a>
                            </div>
                        </nav>

                        <!-- tab content-->
                        <div class="tab-content">
                            <!-- #nav-myinfo -->
                            <div class="tab-pane px-3 active" id="nav-myinfo" role="tabpanel" aria-labelledby="nav-myinfo-tab">
                                <div class="row">
                                    <div class="col-md-12 pl-5">
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">ID</label>
                                            <strong class="form-control-static">sm7104</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">관리자명</label>
                                            <strong class="form-control-static">임성미</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">연락처</label>
                                            <input type="text" name="phone" class="col-4" value="010-9804-8898">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">이메일</label>
                                            <input type="text" name="email" class="col-4" value="byapps01@naver.com">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">비밀번호</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">새 비밀번호</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">비밀번호 확인</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">비밀번호 확인</label>
                                            <input type="password" name="check_pw" class="col-4" value="">
                                        </div>

                                        <button type="button" class="btn btn-sm btn-inverse waves-effect w-md waves-light text-center"> <i class="mdi mdi-account"></i> <span>회원정보 수정</span> </button>
                                    </div>
                                    <!--//col-md-12-->
                                </div>
                                <!--//row-->
                            </div>
                            <!-- //#nav-myinfo -->

                            <!-- #nav-company-info -->
                            <div class="tab-pane fade px-3 text-black" id="nav-app-company" role="tabpanel" aria-labelledby="nav-app-company-tab">
                                <div class="row">
                                    <div class="col-md-12 pl-5">
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">업체상태</label>
                                            <strong class="form-control-static">색상</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">주요관리</label>
                                            <input type="text" class="colorpicker-default form-control" value="#8fff00">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">부가서비스</label>
                                            <div class="col-md-7 col-xs-12 px-0">
                                                <div class="checkbox checkbox-warning">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        푸쉬자동화
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-warning">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        웹푸쉬
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="checkbox checkbox-pink">
                                                    <label>
                                                        <input type="checkbox" value="android" >
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        MA통합
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-purple">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        리타겟팅
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-purple">
                                                    <label>
                                                        <input type="checkbox" value="android" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        MA
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">이용기간</label>
                                            <div class="input-daterange input-group col-md-7 col-xs-12" id="date-range">
                                                <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                                <input type="text" class="form-control col-md-2 col-xs-2" name="count-day" value="">일
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12control-label">APP OS</label>
                                            <div class="checkbox checkbox-success m-t-0">
                                                <label>
                                                    <input type="checkbox" value="android" checked="">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                    android
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info ml-3">
                                                <label>
                                                    <input type="checkbox" value="iphone" checked="">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                    ios
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6 col-xs-12 control-label">이용기간</label>

                                        <div class="form-inline">
                                            <div class="input-daterange input-group row" id="date-range">
                                                <input type="date" class="col-md-3 col-xs-3" name="start">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-custom text-white b-0">to</span>
                                                </div>
                                                <input type="date" class="col-md-3 col-xs-3" name="end">
                                                <input type="text" class="col-md-2 col-xs-2" name="count-day" value="">일
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- //#nav-company-info -->

                            <div class="tab-pane fade px-3 text-black" id="nav-manager-info" role="tabpanel" aria-labelledby="nav-manager-tab">
                                <ul id="permission">
                                @foreach($pageList as $name => $data)
                                    <li>
                                        <span>{{ $data['name'] }}</span>
                                        <select name="{{ $name }}">
                                            <option value="nothing">없음</option>
                                        @foreach($data['permission'] as $key => $val)
                                        @if($per == 'all')
                                            <option value="{{ $key }}" selected>{{ $val }}</option>
                                        @else
                                            <option value="{{ $key }}"{{ strpos($per,$name.$key) ? ' selected' : '' }}>{{ $val }}</option>
                                        @endif
                                        @endforeach
                                        </select>
                                    </li>
                                @endforeach
                                </ul>
                                <input type="button" onclick="send()" value="저장"> 
                            </div>

                        </div><!-- //tab content-->
                    </div> 
            </div>
            <!--// row -->
        </div>
        <!--// card-body-->
    </div>
    <!--//card-->
    </div>
    <!--//col-dm-12-->
</div>   
<!--// row-->         
@endsection
@push('scripts')
<script>
    function send(){
        var permission = [];
        for(var temp of $('#permission select')){
            var item = $(temp)
            if(item.val() == 'nothing') continue;
            for(var temp1 of item.find('option')){
                var option = $(temp1);
                if(option.val() == 'nothing') continue;
                permission.push(`${item.attr('name')}${option.val()}`);
                if(option.val() == item.val()) break;
            }
        }
        $.ajax({
            url : location.href,
            type : 'POST',
            data : {'permission':permission},
            error : function(jqXHR, textStatus, error) {

            },
            success : function(data, jqXHR, textStatus) {

            }
        });
        return false;
    }
</script>
@endpush
