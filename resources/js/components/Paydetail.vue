<template>

<h2>12345</h2>

  <div class="alert alert-info">

        <h4 v-if="!paymentData">
          <strong>{{ paymentData.app_name }}</strong>
        </h4>

        <h4 v-else>
          <strong>Something went wrong.</strong>
        </h4>

  </div>

  <hr />

  <div class="method">
    <div class="row margin-0">

        <input type="hidden" name="idx" :value="paymentData.idx"/>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   주문번호
                   </div>
               </div>
           </div>

           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     {{ paymentData.order_id }} <a href="#" title="삭제" class="btn_del"></a>
                   </div>
               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   결제날짜
                   </div>
               </div>
           </div>
           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     {{ paymentData.reg_time }}
                   </div>
               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   회원ID
                   </div>
               </div>
           </div>

           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     {{ paymentData.mem_id }}
                     <input class="btn nbutton3 btn-xs" type="button" value="회원정보">
                     <input class="btn nbutton3 btn-xs" type="button" value="주문내역">
                     <input class="btn nbutton3 btn-xs" type="button" value="앱관리">
                   </div>
               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   App 명
                   </div>
               </div>
           </div>
           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     {{ paymentData.app_name }} ({{ paymentData.apps_type }})
                   </div>

               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   결제기간
                   </div>
               </div>
           </div>
           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                   @php
                      $arrPaytype = [ '신규', '연장', '충전', '추가', '기타' ];
                   @endphp
                   @foreach ($arrPaytype as $key => $paytype)
                      {{ $key == $paymentData->pay_type ? $paytype : "" }}
                   @endforeach
                   , {{ paymentData.term }}일, {{ date("Y-m-d", paymentData.start_time) }} ~ {{ date("Y-m-d", paymentData.end_time) }}
                   </div>

               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   결제금액
                   </div>
               </div>
           </div>
           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                   {{ number_format(paymentData.amount, 0) }}원
                   <input class="btn btn-danger cbutton3 btn-xs" type="button" value="결제취소">
                   <input class="btn btn-danger cbutton3 btn-xs" type="button" value="무료처리">
                   </div>

               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   결제정보
                   </div>
               </div>
           </div>
           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     @php $pay = explode('{:}', paymentData.payment) @endphp
                      {{ $pay[0] }} {{ !empty($pay[1]) ? "(".$pay[1].")" : "" }} <br />
                      승인번호: {{ !empty($pay[3]) ? $pay[3] : "" }} <br />
                      승인시간: <br />
                   <input class="btn nbutton3 btn-xs" type="button" value="입금확인">
                   </div>

               </div>
           </div>
        </div>

        <div class="row1">
           <div class="col-md-2 col-xs-4 height_2">
               <div class="cell">
                   <div class="propertyname th_style_1">
                   영수증정보
                   </div>
               </div>
           </div>

           <div class="col-md-10 col-xs-8">
               <div class="cell">
                   <div class="description td_style_1">
                     <textarea id="receipt" name="receipt" class="form-control" style="height:200px;">{{ paymentData.receipt != '' ? paymentData.receipt : "미발행" }}</textarea>
                   </div>
               </div>
           </div>
         </div>
        </div>

        <button type="submit" class="btn btn-info btn-sm" style="float:right;">업데이트</button>

    </div>
</template>

<script>
import axios from 'axios'
export default {
  props: [ 'payment-data' ],
  // data() {
  //     return {
  //     }
  // },
  // mounted() {
  //   // this.paymentData = this.getPayDetailData(this.idx);
  //   console.log("~~", this.paymentData);
  //   console.log("here");
  // },
  // methods: {
    // getPayDetailData(paymentData) {
    //   this.payData = paymentData;
    // }
    // getPayDetailData(idx) {
    //   axios({
    //     method: 'GET',
    //     url: '/paydetail/'+ idx
    //   }).then(
    //       response => {
    //         console.log(idx);
    //         console.log(response.data);
    //         return response.data;
    //       },
    //       error => {
    //         console.log(error)
    //       }
    //   )
    // },
  // }
}
</script>
