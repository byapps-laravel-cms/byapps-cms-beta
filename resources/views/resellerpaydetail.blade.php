@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('resellerpaydetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($resellerPaymentData != 'undefined')
                    <h4 class="header-title">{{ $resellerPaymentData->app_name }}</h2>
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

                        <input type="hidden" name="order_id" value=" {{ $resellerPaymentData->order_id }}">
                        <input type="hidden" name="reg_time" value="{{ $resellerPaymentData->reg_time }}">
                        <input type="hidden" name="app_name" value="{{ $resellerPaymentData->app_name }} ({{ $resellerPaymentData->apps_type }})">

                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">  {{ $resellerPaymentData->order_id }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제날짜</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">  {{ $resellerPaymentData->reg_time }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App 명</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $resellerPaymentData->app_name }} ({{ $resellerPaymentData->apps_type }}) </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제기간</label>
                            <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">
                                @php
                                    $arrPaytype = [ '신규', '연장', '충전', '추가', '기타' ];
                                @endphp
                                @foreach ($arrPaytype as $key => $paytype)
                                    {{ $key == $resellerPaymentData->pay_type ? $paytype : "" }}
                                @endforeach
                                , {{ $resellerPaymentData->term }}일, {{ date("Y-m-d", $resellerPaymentData->start_time) }} ~ {{ date("Y-m-d", $resellerPaymentData->end_time) }}
                                </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제금액</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <p class="input-group">
                                        <p class="form-control-static mt-1 mb-1">
                                            {{ number_format($resellerPaymentData->amount, 0) }}원
                                        </p>
                                    <p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">결제정보</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <p class="form-control-static mt-1 mb-1">
                                        @php $pay = explode('{:}', $resellerPaymentData->payment) @endphp
                                        {{ $pay[0] }} {{ !empty($pay[1]) ? "(".$pay[1].")" : "" }}<br />
                                        승인번호: {{ !empty($pay[3]) ? $pay[3] : "" }}<br />
                                        승인시간: 123456576789909
                                        <!-- <input class="btn btn-primary btn-xs" type="button" value="입금확인"> -->
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 col-xs-9 offset-md-2">
                                <!-- <button type="submit" class="btn btn-info btn-sm float-right" >업데이트</button> -->
                            </div>
                        </div>
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

</script>


@endsection
