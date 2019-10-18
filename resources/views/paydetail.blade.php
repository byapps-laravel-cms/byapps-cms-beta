@extends('layouts.default')

@section('content')

<div class="container">

    {{ Breadcrumbs::render('paydetail') }}

    <!-- <paydetail :payment-data="{{ $paymentData }}"></paydetail> -->

    <div class="alert alert-info">
          @if ($paymentData)
          <h4>
            <strong>{{ $paymentData->app_name }}</strong>
          </h4>
          @else
          <h4>
            <strong>Something went wrong.</strong>
          </h4>
          @endif
    </div>

    <hr />

    @if ($message = Session::get('success'))
    <div class="row justify-content-end">
      <div class="col-3 col-align-self-end alert alert-success alert-block">
      	<button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
      </div>
    </div>
    @endif

    <div class="method">
      <div class="col-md-12 margin-0">

        {!! Form::open([ 'route' => ['payupdate', $paymentData->idx] ]) !!}

          <div class="row1">

            <div class="form-group row" id="paymentData">

               <label class="col-md-4 control-label propertyname th_style_1">주문번호</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                     <input type="text" class="form-control" name="order_id" value=" {{ $paymentData->order_id }}" disabled>
                 </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">결제날짜</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                     <input type="text" class="form-control" name="reg_time" value="{{ $paymentData->reg_time }}" disabled>
                 </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">회원ID</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                   <div class="cell">
                       <div class="description td_style_1">
                         <input type="text" value="{{ $paymentData->mem_id }}" disabled>
                         <input class="btn nbutton3 btn-xs" type="button" value="회원정보">
                         <input class="btn nbutton3 btn-xs" type="button" value="주문내역">
                         <input class="btn nbutton3 btn-xs" type="button" value="앱관리">
                      </div>
                    </div>
                 </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">App 명</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                     <input type="text" class="form-control" name="app_name" value="{{ $paymentData->app_name }} ({{ $paymentData->apps_type }})" disabled>
                 </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">결제기간</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                   <div class="cell">
                       <div class="description td_style_1">
                       @php
                          $arrPaytype = [ '신규', '연장', '충전', '추가', '기타' ];
                       @endphp
                       @foreach ($arrPaytype as $key => $paytype)
                          {{ $key == $paymentData->pay_type ? $paytype : "" }}
                       @endforeach
                       , {{ $paymentData->term }}일, {{ date("Y-m-d", $paymentData->start_time) }} ~ {{ date("Y-m-d", $paymentData->end_time) }}
                       </div>
                    </div>
                   </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">결제금액</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                   <div class="cell">
                       <div class="description td_style_1">
                         {{ number_format($paymentData->amount, 0) }}원
                         <input class="btn btn-danger cbutton3 btn-xs" type="button" value="결제취소">
                         <input class="btn btn-danger cbutton3 btn-xs" type="button" value="무료처리">
                      </div>
                    </div>
                 </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">결제정보</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                   <div class="cell">
                       <div class="description td_style_1">
                         @php $pay = explode('{:}', $paymentData->payment) @endphp
                          {{ $pay[0] }} {{ !empty($pay[1]) ? "(".$pay[1].")" : "" }} <br />
                          승인번호: {{ !empty($pay[3]) ? $pay[3] : "" }} <br />
                          승인시간: <br />
                       <input class="btn nbutton3 btn-xs" type="button" value="입금확인">
                       </div>
                   </div>
                </div>
               </div>

               <label class="col-md-4 control-label propertyname th_style_1">영수증정보</label>
               <div class="col-md-8 col-xs-10">
                 <div class="col-md-8 col-xs-10">
                     <textarea id="receipt" name="receipt" class="form-control" style="height:200px;">{{ $paymentData->receipt != '' ? $paymentData->receipt : "미발행" }}</textarea>
                 </div>
               </div>

               <button type="submit" class="btn btn-info btn-sm" style="float:right;">업데이트</button>

        </div>
      </div>

      {!! Form::close() !!}

</div>
@endsection
