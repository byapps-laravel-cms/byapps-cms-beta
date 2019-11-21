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
                                <select name="pm_content" id="" class="form-control">
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
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원정보">
                                <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="Transfer">
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
                            <div class="col-md-10 col-xs-9">
                                <div class="radio radio-success m-0 d-p-inline">
                                    <label>
                                        <input type="radio" name="servicetype" value="basic" checked>
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                            일반
                                    </label>
                                </div>
                                <div class="radio radio-info m-0 d-p-inline">
                                    <label>
                                        <input type="radio" name="servicetype" value="lite" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        라이트
                                    </label>
                                </div>
                                <div class="radio radio-warning m-0 d-p-inline">
                                    <label>
                                        <input type="radio" name="servicetype" value="tester" >
                                        <span class="cr"><i class="cr-icon mdi mdi-checkbox-blank-circle"></i></span>
                                        테스터
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App OS</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="checkbox checkbox-success m-t-0">
                                    <label>
                                        <input type="checkbox" value="" checked>
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        안드로이드
                                    </label>
                                </div>
                                <div class="checkbox checkbox-info m-t-0">
                                    <label>
                                        <input type="checkbox" value="" >
                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                        아이폰
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Byapps ver</label>
                            <div class="col-md-1 col-xs-9">
                                <input type="text" class="form-control" value="5.5" >
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
                            <div class="col-md-1 col-xs-9">
                                <label class="form-label">ver - </label><input type="text" class="form-control" value="1.1" > 
                            </div>
                            <div class="col-md-1 col-xs-9">
                                <label class="form-label">build - </label><input type="text" class="form-control" value="3" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">IOS</label>
                            <div class="col-md-1 col-xs-9">
                                <label class="form-label">ver - </label><input type="text" class="form-control" value="1.1" > 
                            </div>
                            <div class="col-md-1 col-xs-9">
                                <label class="form-label">build - </label><input type="text" class="form-control" value="3" >
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
                            <label class="col-md-2 col-form-label">Group</label>
                            <div class="col-md-8 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> 1그룹 </p>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control" value="AIzaSyAqF-hoCqmGAGEcD1UigdSoQJKCKALFYFw" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">GCM Number</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control" value="566138366797" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Project Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control" value="byapps-peoplen-20191121" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google App Id</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control" value="b39a2c50324496adaa6504" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Google Api Key</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="text" class="form-control" value="AIzaSyAPMKcByNVvKfwEs9BVaCKkLChs6VaqNxE" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">아이폰 인증서 .pem</label>
                            <div class="col-md-6 col-xs-9">
                                <input type="file" class="filestyle" data-buttonname="btn-secondary">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                                <span class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;010-9847-2046</span>
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="sms보내기">
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
                            <div class="col-md-10 col-xs-9">
                                <span class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;3개월(손효연, 승인번호: 0, 승인날짜: 2019/11/07 [18:22]) </span>
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="결제내역">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청경로</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;전화영업 </p>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Service Type</label>
                            <div class="col-md-10 col-xs-9">
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
