@extends('layouts.default')

@section('content')

<div class="container">

    {{ Breadcrumbs::render('appspaydetail') }}

 <div class="row">
   <div class="col-sm-12">
     <div class="card">
       <div class="card-body">
         <div class="row">
           <div class="col-sm-12">

                  @if ($appsPaymentData)
                  <h4 class="header-title">{{ $appsPaymentData->app_name }}</h2>
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
                    <div class="col-xl-8">

                        {!! Form::open([ 'route' => ['appspayupdate', $appsPaymentData->idx] ]) !!}

                        <div class="form-group row" id="paymentData">
                          <label class="col-md-2 col-form-label ">주문번호</label>
                          <div class="col-md-8 col-xs-10">
                            <input type="text" class="form-control" name="order_id" value=" {{ $appsPaymentData->order_id }}" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-md-2 col-form-label">결제날짜</label>
                           <div class="col-md-8 col-xs-10">
                                 <input type="text" class="form-control" name="reg_time" value="{{ $appsPaymentData->reg_time }}" readonly>
                           </div>
                        </div>

                        <div class="form-group row">

                           <label class="col-md-2 col-form-label">회원ID</label>
                           <div class="col-md-8 col-xs-10">
                               <div class="form-inline">
                                   <div class="input-group">

                                      <div class="input-group-prepend">
                                         <span class="input-group-text">
                                           <i class="fa fa-user"></i>
                                         </span>

                                         <input type="text" class="form-control" value="{{ $appsPaymentData->mem_id }}" readonly>

                                         <input class="btn btn-primary waves-effect wave-light btn-xs ml-1 mr-1" type="button" value="회원정보">
                                         <input class="btn btn-info waves-effect btn-xs mr-1" type="button" value="주문내역">
                                         <input class="btn btn-success waves-effect btn-xs" type="button" value="앱관리">
                                      </div>

                                    </div>
                               </div>
                           </div>
                        </div>

                        <div class="form-group row">
                          <label class="col-md-2 col-form-label">App 명</label>
                          <div class="col-md-8 col-xs-10">
                              <input type="text" class="form-control" name="app_name" value="{{ $appsPaymentData->app_name }} ({{ $appsPaymentData->apps_type }})" readonly>
                          </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-md-2 col-form-label">결제기간</label>
                           <div class="col-md-8 col-xs-10">
                               <div class="form-control">
                               @php
                                  $arrPaytype = [ '신규', '연장', '충전', '추가', '기타' ];
                               @endphp
                               @foreach ($arrPaytype as $key => $paytype)
                                  {{ $key == $appsPaymentData->pay_type ? $paytype : "" }}
                               @endforeach
                               , {{ $appsPaymentData->term }}일, {{ date("Y-m-d", $appsPaymentData->start_time) }} ~ {{ date("Y-m-d", $appsPaymentData->end_time) }}
                               </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-md-2 col-form-label">결제금액</label>
                           <div class="col-md-8 col-xs-10">
                             <div class="form-inline">
                               <div class="input-group">

                                   <div class="form-control">
                                     {{ number_format($appsPaymentData->amount, 0) }}원
                                   </div>

                                   <input class="btn btn-danger btn-xs ml-1 mr-1" type="button" value="결제취소">
                                   <input class="btn btn-danger btn-xs" type="button" value="무료처리">

                                </div>
                             </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-md-2 col-form-label">결제정보</label>
                           <div class="col-md-8 col-xs-10">
                             <div class="form-inline">

                               <div class="input-group">
                                   <div class="form-control">
                                     @php $pay = explode('{:}', $appsPaymentData->payment) @endphp
                                      {{ $pay[0] }} {{ !empty($pay[1]) ? "(".$pay[1].")" : "" }}

                                      승인번호: {{ !empty($pay[3]) ? $pay[3] : "" }}

                                      승인시간: 123456576789909</div>

                                    <input class="btn btn-primary btn-xs" type="button" value="입금확인">
                                </div>
                              </div>

                           </div>
                        </div>

                        <div class="form-group row">
                           <label class="col-md-2 col-form-label">영수증정보</label>
                           <div class="col-md-8 col-xs-10">
                              <textarea id="receipt" name="receipt" class="form-control" style="height:200px;">{{ $appsPaymentData->receipt != '' ? $appsPaymentData->receipt : "미발행" }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-8 col-xs-10 offset-md-2">
                        <button type="submit" class="btn btn-info btn-sm" style="float:right;">업데이트</button>
                      </div>
                      </div>
                      {!! Form::close() !!}

                    </div>
                    <!-- col-xl-6 end -->
                </div>
                <!-- row end -->
            </div>
            <!-- col-sm-12 end -->
          </div>
          <!-- row end -->
        </div>
        <!-- card-body end -->
      </div>
      <!-- card end -->
    </div>
    <!-- col end -->
  </div>
  <!-- row end -->
</div>
<!-- container end -->

@toastr_css
@toastr_js
@toastr_render

@endsection
