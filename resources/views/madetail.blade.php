@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('madetail') }}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">

                        <h4><strong>{{ isset($maData) ? $maData->app_name : '데이터가 없습니다' }}</strong></h4>
                        <hr />

                    </div>

                    <div class="col-md-12 col-xs-12 px-4">
                        <form method="POST" onsubmit="return modify(this)">
                            @csrf
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label ">Process</label>
                                <div class="col-md-6 col-xs-9">
                                    <select name="app_process" class="form-control input-sm">
                                        <option value="" >선택해 주세요</option>
                                        <option value="1"{!! $maData->app_process == 1 ? ' selected' : '' !!}> SDK설치중</option>
                                        <option value="2"{!! $maData->app_process == 2 ? ' selected' : '' !!}> 등록대기</option>
                                        <option value="3"{!! $maData->app_process == 3 ? ' selected' : '' !!}> 등록완료</option>
                                        <option value="4"{!! $maData->app_process == 4 ? ' selected' : '' !!}> 서비스중지</option>
                                        <option value="5"{!! $maData->app_process == 5 ? ' selected' : '' !!}> 기간만료</option>
                                        <option value="6"{!! $maData->app_process == 6 ? ' selected' : '' !!}> 서비스유효</option>
                                    </select>
                                </div>
                                <button class="btn btn-info waves-effect btn-xs mr-1" onclick="copyScript()" type="button">SDK 설치 스크립트</button>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label ">등록일</label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static mt-1 mb-1"> {{ $maData->reg_time->format('Y-m-d [h:i:d]') }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">회원 ID</label>
                                <div class="col-md-10 col-xs-9">
                                    <span class="form-control-static mt-1 mb-1 d-p-inline"> <i class="fa fa-user"></i>&nbsp;&nbsp; {{ $maData->mem_id }} </span>
                                    <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" onclick="getMemData('{!! $maData->mem_id !!}')">회원정보</button>
                                    <button class="btn btn-info waves-effect btn-xs mr-1" type="button" >Transfer</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label ">MA ID</label>
                                <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $maData->ma_id }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label ">그룹</label>
                                <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $maData->server_group }}그룹 </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Byapps ver</label>
                                <div class="col-md-1 col-xs-9">
                                    <input type="text" class="form-control input-sm" name="ma_ver" value="{!! $maData->ma_ver !!}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">업체명</label>
                                <div class="col-md-10 col-xs-9">
                                    <p class="form-control-static mt-1 mb-1"> {{ $maData->member->mem_nick }} </p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Service Type	</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="auto_push" value="Y"{!! $maData->auto_push  == 'Y' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;자동화푸쉬
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="service_ma" value="Y">
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;MA통합
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="service_type[]" value="retarget"{!! $maData->service_type == 'retarget' || $maData->service_type == 'both' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;리타겟팅
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="service_type[]" value="ma"{!! $maData->service_type == 'ma' || $maData->service_type == 'both' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;마케팅오토메이션
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">사용기간</label>
                                <div class="col-md-6 col-xs-9 form-inline" style="padding-left:0;">
                                    <div class="col-md-3 col-xs-9">
                                        <input type="text" class="form-control input-sm" name="start_time" value="{!! $maData->start_time->format('Y-m-d') !!}" style="width: 100%;">
                                    </div>
                                    ~
                                    <div class="col-md-3 col-xs-9">
                                        <input type="text" class="form-control input-sm" name="end_time" value="{!! $maData->end_time->format('Y-m-d') !!}" style="width: 100%;">
                                    </div>
                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-inverse" style="height: 30px;">MA 기본설정</button>&nbsp;
                                    <button type="button" class="btn btn-sm waves-effect waves-light btn-inverse" style="height: 30px;">리타겟 기본설정</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">홈페이지 URL</label>
                                <div class="col-md-8 col-xs-9">
                                    <div class="input-group">
                                        <input type="text" name="home_url" class="form-control input-sm" value="{!! $maData->home_url !!}">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-sm waves-effect waves-light btn-inverse" onclick="goLink(this)">홈페이지 이동</button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">안드로이드 패키지</label>
                                <div class="col-md-3 col-xs-9">
                                    <input type="text" name="pn" class="form-control input-sm" value="{!! $maData->pn !!}" >
                                </div>
                                <button class="btn btn-info waves-effect btn-inverse mr-1" onclick="getInfo()" type="button">앱설치정보 가져오기</button>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">아이폰 앱아이디</label>
                                <div class="col-md-3 col-xs-9">
                                    <input type="text" name="aid" class="form-control input-sm" value="{!! $maData->aid !!}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">앱스키마</label>
                                <div class="col-md-3 col-xs-9">
                                    <input type="text" name="schm" class="form-control input-sm" value="{!! $maData->schm !!}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Web Push Center</label>
                                <div class="col-md-3 col-xs-9">
                                    <input type="text" name="push_center" class="form-control input-sm" value="{!! $maData->push_center !!}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Charset</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="radio radio-success mr-2">
                                        <label>
                                            <input type="radio" name="txtencode" value="utf-8"{!! $maData->txtencode == 'utf-8' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;UTF-8
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="txtencode" value="euc-kr"{!! $maData->txtencode == 'euc-kr' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;EUC-KR
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Hosting Com.</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="radio radio-primary mr-2">
                                        <label>
                                            <input type="radio" name="host_name" value="cafe24"{!! $maData->host_name == 'cafe24' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;카페24
                                        </label>
                                    </div>
                                    <div class="radio radio-warning mr-2">
                                        <label>
                                            <input type="radio" name="host_name" value="makeshop"{!! $maData->host_name == 'makeshop' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;메이크샵
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="host_name" value="godo"{!! $maData->host_name == 'godo' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;고도몰
                                        </label>
                                    </div>
                                    <div class="radio radio-inverse mr-2">
                                        <label>
                                            <input type="radio" name="host_name" value="wisa"{!! $maData->host_name == 'wisa' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;위사
                                        </label>
                                    </div>
                                    <div class="radio radio-inverse mr-2">
                                        <label>
                                            <input type="radio" name="host_name" value="etc"{!! $maData->host_name == 'etc' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;기타
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">Lang</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="ko" {!! in_array('ko',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;한국어
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="en" {!! in_array('en',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;영어
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="zh" {!! in_array('zh',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;중국어
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="tw" {!! in_array('tw',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;대만어
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="ja" {!! in_array('ja',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;일본어
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="app_lang[]" value="vi" {!! in_array('vi',$appLang) ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;베트남어
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">직간접매출</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="radio radio-success mr-2">
                                        <label>
                                            <input type="radio" name="opt_sst" value="N"{!! $maData->opt_sst == 'N' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;표시안함
                                        </label>
                                    </div>
                                    <div class="radio radio-info mr-2">
                                        <label>
                                            <input type="radio" name="opt_sst" value="Y"{!! $maData->opt_sst == 'Y' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            &nbsp;표시함
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">추가지원업체</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2 no-drag">
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" name="is_cherrypicker" value="ko" {!! $maData->is_cherrypicker == 'Y' ? ' checked' : '' !!}>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;추가무료지원업체
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label ">관리업체지정</label>
                                <div class="col-md-6 col-xs-9">
                                    <select name="vip_check" class="form-control input-sm">
                                        <option value="">지정안함</option>
                                        <option value="#000|#ffff00">주요관리</option>
                                        <option value="#fff|#ff0000">신규연장 가능업체</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label">앱소개</label>
                                <div class="col-md-10 col-xs-9">
                                    <textarea id="info" name="info" class="form-control" rows="7">{{ $maData->info }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 text-center">
                                <button type="submit" class="btn btn-info mx-auto">변경하기</button>
                            </div>
                        </form>
                    </div>
                </div><!--row end-->
            </div>
            <!-- col-md-12 -->

            </div>
            <!-- card end -->
        </div>
        <!-- cardbody end -->
    </div>
    <!-- row end -->
</div>
<!-- container-fluid end -->
@endsection
@section('style')
    <style>
        .no-drag {-ms-user-select: none; -moz-user-select: -moz-none; -webkit-user-select: none; -khtml-user-select: none; user-select:none;}
    </style>
@endsection
@section('script')
<script>
    function goLink(obj){
        obj = $(obj)
        var url = obj.parent().parent().find('input[type=text]').val()
        if(!url) return;
        window.open(url, "_blank");
    }
    function modify(obj){
        var request = new FormData(obj);
        $.ajax({
            url : location.href,
            type : 'POST',
            data : request,
            cache : false,
            contentType: false,
            processData: false,
            error : function(jqXHR, textStatus, error) {
                $(`[name=${jqXHR.responseJSON.col}]`).focus();
                alert(jqXHR.responseJSON.message)
            },
            success : function(data, jqXHR, textStatus) {
                alert('처리되었습니다');
            }
        });
        return false;
    }
    function copyScript(){
        if(!$('[name=schm]').val()){
            alert('앱 스키마를 입력해주세요');
            return false;
        }else if(!$('[name=pn]').val()){
            alert('패키지를 입력해주세요');
            return false;
        }
        copyToClipboard(
`<!-- Byapps MA script start -->
<script type="text/javascript">
(function(b,a,r,s){
b[s]=b[s]||function(c,d){b[s][c]=d};
var aa=a.createElement(r);aa.type='text/javascript';aa.async=true;aa.defer=true;aa.charset='utf-8';aa.src='//s3.ap-northeast-2.amazonaws.com/byapps-api/v4.5/2/byapps_MA_sdk.min.js';
var bb=a.getElementsByTagName(r)[0];bb.parentNode.insertBefore(aa,bb);})(window,document,'script','barsQ');
barsQ('caid','room301');
barsQ('cdid','mobile');
barsQ('host','cafe24');
barsQ('appi','${$('[name=pn]').val()}|${$('[name=aid]').val()}|${$('[name=schm]').val()}');
</script\>
<!-- //Byapps MA script end -->`
        );
    }
    function copyToClipboard(val) {
        var t = document.createElement("textarea");
        document.body.appendChild(t);
        t.value = val;
        t.select();
        document.execCommand('copy');
        document.body.removeChild(t);
    }
    function getInfo(memId){
        var request = {
            mode : 'get_info'
        }
        $.ajax({
            url : location.href,
            type : 'POST',
            data : request,
            error : function(jqXHR, textStatus, error) {
                alert(jqXHR.responseJSON.message)
            },
            success : function(data, jqXHR, textStatus) {
                for(var key in data){
                    $(`[name=${key}]`).val(data[key]);
                }
            }
        });
    }
</script>
@endsection
