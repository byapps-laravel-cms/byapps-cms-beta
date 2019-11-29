@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{-- {{ Breadcrumbs::render('appsupdatedetail') }} --}}

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
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> BA1573116381 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-2 col-form-label">주문일</label>
                                <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> 2019/11/07 [17:48:34] </p>
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Process</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> 접수 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">RESELLER ID</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> cafe24   카페24 (담당자: 강윤정, 연락처: 010-6312-2761, 02-6386-7340) </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원 ID</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;medi_camp@naver.com </p>
                                <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원정보">
                                <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="주문내역">
                                <input class="btn btn-success waves-effect btn-xs" type="button" value="앱관리">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">업체명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> 메디캠프 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">신청자명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> 김영준 </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">연락처</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;010-9847-2046</p>
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
                                <p class="form-control-static mt-1 mb-1"> <i class="fa fa-user"></i>&nbsp;&nbsp;3개월(손효연, 승인번호: 0, 승인날짜: 2019/11/07 [18:22]) </p>
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
                            <label class="col-md-2 col-form-label">App. Category</label>
                            <div class="col-md-10 col-xs-9">
                                <select name="pm_content" id="" class="form-control">
                                <option value="">기타</option>
                                </select>
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
