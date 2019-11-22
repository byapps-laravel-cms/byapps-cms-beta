@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{-- {{ Breadcrumbs::render('appsorderdetail') }}수정필요 영역 --}}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-sm-12">
                        @if ($promotionData)
                        <h4>
                        <strong>{{ $promotionData->mem_name }}</strong>
                        </h4>
                        @else
                        <h4>
                        <strong>Something went wrong.</strong>
                        </h4>
                        @endif
                        <hr />
                    </div> --}}



                    <div class="col-md-12 col-xs-12 px-4">
                        <form method="POST" action="">
                        <input type="hidden" name="idx" value="1"/>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">Process</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="pm_content" id="" class="form-control input-sm">
                                <option value="">등록대기</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">등록일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> 2019/11/21 [10:59:21] </p>
                            </div>
                        </div>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> BA1573116381 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원 ID</label>
                            <div class="col-md-10 col-xs-9">
                                <span class="form-control-static mt-1 mb-1 d-p-inline"> <i class="fa fa-user"></i>&nbsp;&nbsp;medi_camp@naver.com </span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" >회원정보</button>
                                <button class="btn btn-info waves-effect btn-xs mr-1" type="button" >Transfer</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">CAFE24 App</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> - </p>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">APP ID</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> peoplen </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Service Type</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="radio radio-success mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="basic" checked>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;일반
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;라이트
                                    </label>
                                </div>
                                <div class="radio radio-warning mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="tester" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;테스터
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App OS</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="checkbox checkbox-success mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;안드로이드
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info mr-2">
                                    <label>
                                        <input type="checkbox" value="" >
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;아이폰
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Byapps ver</label>
                            <div class="col-md-1 col-xs-9">
                                <input type="text" class="form-control input-sm" value="5.5" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> 메디캠프 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">android</label>
                            <div class="col-md-6 col-xs-9 form-inline">
                                ver - 
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="1.1" > 
                                </div>
                                build - 
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="3" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">IOS</label>
                            <div class="col-md-6 col-xs-9 form-inline">
                                ver -
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="1.1" > 
                                </div>
                                build - 
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="3" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. Category</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="pm_content" id="" class="form-control">
                                <option value="">기타</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱설치통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> 전체: 3,926 /오늘: 2 /어제: 38 /평균: 21 /최고: 96 /기간: 192 (2019-05-14~2019/11/22)
                                    <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">버전별 설치 통계</button>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱이용통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">전체: 4,017 /오늘: 10 /어제: 54 /평균: 21 /최고: 120 /기간: 192 (2019-05-14~2019/11/22) 
                                    <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">주간통계재발송</button>
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱매출통계</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">전체: 0(0) /오늘: 0(0) /어제: 0(0) /평균: 0(0) /최고: 0(0) /기간: 192 (2019-05-14~2019/11/22)</p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Group</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> 1그룹 </p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" value="AIzaSyAqF-hoCqmGAGEcD1UigdSoQJKCKALFYFw" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Number</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" value="566138366797" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Project Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" value="byapps-peoplen-20191121" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google App Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" value="b39a2c50324496adaa6504" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Api Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control input-sm" value="AIzaSyAPMKcByNVvKfwEs9BVaCKkLChs6VaqNxE" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">아이폰 인증서 .pem</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="file" class="filestyle" data-buttonname="btn-secondary">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">아이폰 인증서 정보</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                비밀번호 : 
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="8933">
                                </div>
                                인증서 만료일 : 
                                <div class="col-md-2 col-xs-9">                                    
                                    <input type="text" class="form-control input-sm" value="2020-01-01">
                                </div>
                                개발자 만료일 :
                                <div class="col-md-2 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="2020-01-01">
                                </div>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9 mt-1">
                                <span class="form-control-static"> <i class="fa fa-user"></i>&nbsp;&nbsp;010-9847-2046</span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" >sms보내기</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">이메일</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> medi_camp@naver.com </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제정보</label>
                            <div class="col-md-10 col-xs-9 mt-1">
                                <span class="form-control-static"> <i class="fa fa-user"></i>&nbsp;&nbsp;3개월(손효연, 승인번호: 0, 승인날짜: 2019/11/07 [18:22]) </span>
                                <button class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button">결제내역</button>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청경로</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">전화영업 </p>
                            </div>
                        </div>

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">Push Server</label>
                            <div class="col-md-6 col-xs-9">
                                <select name="push_server" class="form-control input-sm">
                                    <option value="default">default</option>
                                    <option value="http://byapps.cafe24app.com/">http://byapps.cafe24app.com/</option>
                                    <option value="http://push1.cafe24app.com/">http://push1.cafe24app.com/</option>
                                    <option value="http://byappspush2.cafe24app.com/">http://byappspush2.cafe24app.com/</option>
                                    <option value="http://byappspush3.cafe24app.com/" selected="">http://byappspush3.cafe24app.com/</option>
                                    <option value="http://byappspush4.cafe24app.com/">http://byappspush4.cafe24app.com/</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Push Token</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="pushtoken" class="form-control input-sm" >
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-warning">토큰생성</button>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">플랫폼 사용기간</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                <div class="col-md-2 col-xs-9 pl-0">
                                    <input type="text" class="form-control input-sm" value="2019-08-23">
                                </div>
                                ~
                                <div class="col-md-2 col-xs-9">                                    
                                    <input type="text" class="form-control input-sm" value="2020-01-01">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="android_url" class="form-control input-sm" value="http://play.google.com/store/apps/details?id=com.envin2.byapps">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-success">Play Store</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">IOS URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="ios_url" class="form-control input-sm" value="http://itunes.apple.com/kr/app/id1464489128?l=ko&ls=1&mt=8">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-light">App Store</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Mobile URL</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="pushtoken" class="form-control input-sm" value="http://www.envin.co.kr/m/index.html?">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-inverse">Mobile Home</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">PackageName</label>
                            <div class="col-md-10 col-xs-9 form-inline">
                                <div class="input-group col-md-5 col-xs-9 px-0">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-success"><i class="fa fa-android"></i> </button>
                                    </span>
                                    <input type="text" name="androi_pk" class="form-control input-sm" value="co.kr.byapps.dev">
                                </div>
                                <div class="input-group col-md-5 col-xs-9 px-0">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm waves-effect waves-light btn-light"><i class="fa fa-apple"></i></button>
                                    </span>
                                    <input type="text" name="ios_pk" class="form-control input-sm" value="co.kr.byapps.dev">
                                </div>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android-Vender</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="android_vendor" class="form-control input-sm" placeholder="안드로이드 무결성 검증" value="com.android.vending">
                                    <p class="mt-1 ml-1 mb-0">(예 - com.android.vending)</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Android-Hash</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="android_hash" class="form-control input-sm" placeholder="안드로이드 무결성 검증" value="">    
                                    <p class="mt-1 ml-1 mb-0">(자동인증: byapps_cert // 키스토어 SHA-1: keytool -printcert -file META_INF/CERT.RSA)</p>                              
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Ios-Hash</label>
                            <div class="col-md-8 col-xs-9">
                                <div class="input-group">
                                    <input type="text" name="android_hash" class="form-control input-sm" placeholder="IOS 무결성 검증" value="">
                                    <p class="mt-1 ml-1 mb-0">IOS 무결성 검증(sc:pl:id)</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Cafe24 Mall Id</label>
                            <div class="col-md-3 col-xs-9">
                                <input type="text" name="android_hash" class="form-control input-sm" placeholder="카페24 몰아이디" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Charset</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="radio radio-success mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="basic" checked>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;UTF-8
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;EUC-KR
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Hosting Com.</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="radio radio-primary mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="basic" checked>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;카페24
                                    </label>
                                </div>
                                <div class="radio radio-warning mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;메이크샵  
                                    </label>
                                </div>
                                <div class="radio radio-info mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="basic" checked>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;고도몰4
                                    </label>
                                </div>
                                <div class="radio radio-danger mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;고도몰5  
                                    </label>
                                </div>
                                <div class="radio radio-inverse mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;위사  
                                    </label>
                                </div>
                                <div class="radio radio-inverse mr-2">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        &nbsp;기타  
                                    </label>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App OS</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;한국어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;영어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;중국어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;대만어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;일본어
                                    </label>
                                </div>
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;베트남어
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">자동로그인</label>
                            <div class="col-md-10 col-xs-9 form-inline mt-2">
                                <div class="checkbox checkbox-inverse mr-2">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        &nbsp;자동로그인 허용
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                                <label class="col-md-2 col-form-label">포인트</label>
                                <div class="col-md-10 col-xs-9 form-inline mt-2">
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;출석체크
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;푸쉬체크
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;앱설치
                                        </label>
                                    </div>
                                    <div class="checkbox checkbox-inverse mr-2">
                                        <label>
                                            <input type="checkbox" value="" checked>
                                            <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                            &nbsp;앱 포인트 수동전환
                                        </label>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group row">
                                <label class="col-md-2 col-form-label">Google App Id</label>
                                <div class="col-md-6 col-xs-9">
                                    <input type="text" class="form-control input-sm" value="b39a2c50324496adaa6504" >
                                </div>
                            </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청경로</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">전화영업 </p>
                            </div>
                        </div>    

                        <div class="form-group row" id="paymentData">
                                <label class="col-md-2 col-form-label ">Process</label>
                                <div class="col-md-8 col-xs-9">
                                    <select name="pm_content" id="" class="form-control">
                                    <option value="">등록대기</option>
                                    </select>
                                </div>
                            </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Push Server</label>
                            <div class="col-md-10 col-xs-9 mt-1">
                            <label class="radio-inline">
                                <input type="radio" class=" mt-1 mb-1" name="option_ilban" checked="" value="">
                                일반
                            </label>
                            &nbsp;
                            <label class="radio-inline">
                                <input type="radio" class=" mt-1 mb-1" name="option_lite" value="">
                                라이트
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. OS</label>
                            <div class="col-md-10 col-xs-9">
                            <label class="radio-inline mt-1 mb-1">
                                <input type="radio" name="android" checked="" value="">
                                안드로이드
                            </label>
                            &nbsp;
                            <label class="radio-inline mt-1 mb-1">
                                <input type="radio" name="ios" checked="" value="">
                                아이폰
                            </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. Name</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="메디캠프">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. URL</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="m.medicamp.co.kr">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App. URL</label>
                            <div class="col-md-10 col-xs-9">
                                <a href="javascript:void(0);">앱아이콘</a>,
                                <a href="javascript:void(0);">스플래쉬</a>,
                                <a href="javascript:void(0);">탭메뉴</a>,
                                <a href="javascript:void(0);">로고</a>,
                                <a href="javascript:void(0);">그래픽</a>
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="변경등록">
                                <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="android변환">
                                <input class="btn btn-success waves-effect btn-xs" type="button" value="ios변환">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">고객센터</label>
                            <div class="col-md-10 col-xs-9">
                                <input type="text" class="form-control" value="070-7124-8911">
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">영수증정보</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5">미발행</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">앱소개</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5"></textarea>
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
