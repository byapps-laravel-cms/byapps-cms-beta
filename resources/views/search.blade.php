@extends('layouts.default')

@section('content')

<div class="col-lg-12">
  <div class="card card-border">
      <div class="card-heading">
        <h3 class="card-title">{{ $totalCount }} 개의 <mark>"{{ request('query') }}"</mark> 검색결과</h3>
      </div>

      <div class="card-body" id="appsDataResults">
        <h3>앱 목록</h3>

        @if (count($appsData) > 0)
          @foreach($appsData as $key => $value)
              <div class="col-md-4 appsDataResult text-truncate" style="display:inline-block;">
                <li>
                  <a href="/appsdetail/{{ $value->idx }}">{{ $value->app_name }} ({{ date("Y-m-d", $value->reg_time) }})</a>
                </li>
              </div>
          @endforeach
        @endif
      </div>
      @if ($appsCnt > 20)
        <p class="text-center mt-4 mb-5">
          <button class="load-more1 btn btn-pink btn-rounded btn-bordered waves-effect w-md waves-light" data-totalResult1="{{ $appsCnt }}">
            Load More
          </button>
        </p>
      @endif
      <hr />

      <div class="card-body" id="appsPayResults">
        <h3>결제 관리</h3>

        @if (count($appsPayData) > 0)
          @foreach($appsPayData as $key => $value)
              <div class="col-md-4 appsPayResult text-truncate" style="display:inline-block;">
                <li>
                  <a href="/appspaydetail/{{ $value->idx }}">{{ $value->app_name }} ({{ date("Y-m-d", $value->reg_time) }})</a>
                </li>
              </div>
          @endforeach
        @endif
      </div>
      @if ($appsPayCnt > 20)
        <p class="text-center mt-4 mb-5">
          <button class="load-more2 btn btn-pink btn-rounded btn-bordered waves-effect w-md waves-light" data-totalResult2="{{ $appsPayCnt }}">
            Load More
          </button>
        </p>
      @endif

      <hr />
  </div>
</div>

@put('script')
<script type="text/javascript">
$(document).ready(function(){

  $(".load-more1").on('click', function(){
    load_more('load-more1', 'appsDataResult', 'AppsData', 'reg_time', '#appsDataResults', 'appsdetail', 'data-totalResult1');
  });

  $(".load-more2").on('click', function(){
    load_more('load-more2', 'appsPayResult', 'AppsPaymentData', 'reg_time', '#appsPayResults', 'appspaydetail', 'data-totalResult2');
  });

  function load_more(btnName, resultClass, modelName, dateColumn, resultsId, linkAddress, totalResult) {

      var _totalCurrentResult = $('.' + resultClass).length;
      var str = {!! json_encode(request('query')) !!};
      console.log(str);

      $.ajax({
          url: '/search-more',
          type:'get',
          dataType:'json',
          data:{
              skip: _totalCurrentResult,
              str: str,
              model: modelName
          },
          beforeSend:function(){
              $('.' + btnName).html('Loading...');
          },
          success:function(response){
              var _html = '';
              $.each(response,function(index,value){
                  _html += '<div class="col-md-4 '+ resultClass +' text-truncate" style="display:inline-block;">';
                  _html += '  <li>';
                   _html += '   <a href="/'+ linkAddress +'/'+ value.idx + '">' + value.app_name + ' (' + yyyymmdd(value.reg_time) +')</a>';
                  _html += '  </li>';
                  _html += '</div>';
              });
              $(resultsId).append(_html);

              // Change Load More When No Further result
              var _totalCurrentResult = $('.' + resultClass).length;
              var _totalResult = parseInt($('.' + btnName).attr(totalResult));

              console.log(_totalCurrentResult);
              console.log(_totalResult);

              if (_totalCurrentResult == _totalResult){
                  $('.' + btnName).parent().remove();
                  $('.' + btnName).remove();
              } else {
                  $('.' + btnName).html('Load More');
              }
          $('.' + btnName).blur();
          }
      });
  }

// Unix Timestamp를 Y-m-d형식 변환
  function yyyymmdd(timevalue) {
      var x = new Date(timevalue*1000);
      var y = x.getFullYear().toString();
      var m = (x.getMonth() + 1).toString();
      var d = x.getDate().toString();
      (d.length == 1) && (d = '0' + d);
      (m.length == 1) && (m = '0' + m);
      var yyyymmdd = y + '-' + m + '-' + d;
      return yyyymmdd;
  }

});
</script>
@endput

@endsection
