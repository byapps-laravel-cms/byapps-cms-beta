<div>
    <div class="card-title m-2">
        <i class="fi-menu"></i> 만료예정업체
        <button class="btn float-right" type="button">
          <i class="dripicons-chevron-down"></i>
        </button>
    </div>
</div>

<div class="dragbox collapse show" id="endList">
    <ul class="nav nav-tabs" id="tab-depth1" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="ios-tab" data-toggle="tab" href="#ios" role="tab" aria-controls="ios" aria-selected="true">
          IOS 계정 만료</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="push-tab" data-toggle="tab" href="#push" role="tab" aria-controls="push" aria-selected="false">
          푸쉬 인증서만료</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="ma-tab" data-toggle="tab" href="#ma" role="tab" aria-controls="ma" aria-selected="false">
          MA 서비스만료</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="apps-tab" data-toggle="tab" href="#apps" role="tab" aria-controls="apps" aria-selected="false">
          앱서비스 만료예정</a>
      </li>
    </ul>
    <div class="tab-content" id="tab-depth1-content">
      <!-- 탭1 -->
      <div class="tab-pane fade show active" id="ios" role="tabpanel" aria-labelledby="ios-tab">
        <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="ios-over-tab" data-toggle="tab" href="#ios-over" role="tab" aria-controls="ios-over" aria-selected="true">
              IOS 만료</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ios-stay-tab" data-toggle="tab" href="#ios-stay" role="tab" aria-controls="ios-stay" aria-selected="false">
              IOS 만료예정</a>
          </li>
        </ul>
        <div class="tab-content" id="tab-depth2-content">
          <div class="tab-pane fade show active" id="ios-over" role="tabpanel" aria-labelledby="ios-over-tab">
            <!-- 탭1-1 -->

          <div id="expiredIosList">
          @if (count($expiredIos) > 0)
            @foreach ($expiredIos as $data)
              <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block expiredIos">
                  <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                    {{ $data->app_name }}<br><span class="badge badge-pink">D+ {{ App\Helpers\Helpers::calculateDday($data->ios_dev_exp) }}</span>
                    {{ $data->ios_dev_exp }}
                  </div>
              </div>
              @endforeach
            @endif
          </div>

            @if(count($expiredIos)>0)
             <p class="text-center mt-4 mb-5"><button class="load-more btn btn-pink btn-rounded btn-bordered waves-effect w-md waves-light" data-totalResult="{{ $expiredIosTotCnt }}">Load More</button></p>
             @endif

          </div>
          <div class="tab-pane fade" id="ios-stay" role="tabpanel" aria-labelledby="ios-stay-tab">
            <!-- 탭1-2 -->
                @foreach ($willBeExpiredIos as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-info">D {{ App\Helpers\Helpers::calculateDday($data->ios_dev_exp) }}</span>
                      {{ $data->ios_dev_exp }}
                    </div>
                </div>
                @endforeach
          </div>
        </div>
      </div>
      <!-- 탭1 End -->

      <!-- 탭2 -->
      <div class="tab-pane fade" id="push" role="tabpanel" aria-labelledby="push-tab">
        <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="push-over-tab" data-toggle="tab" href="#push-over" role="tab" aria-controls="push-over" aria-selected="true">
              PUSH 인증서 만료</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="push-stay-tab" data-toggle="tab" href="#push-stay" role="tab" aria-controls="push-stay" aria-selected="false">
              PUSH 인증서 만료예정</a>
          </li>
        </ul>
        <div class="tab-content" id="tab-depth2-content">
          <div class="tab-pane fade show active" id="push-over" role="tabpanel" aria-labelledby="push-over-tab">
            <!-- 탭2-1 -->
                @foreach ($expiredPush as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-pink">D+ {{ App\Helpers\Helpers::calculateDday($data->ios_cer_exp) }}</span>
                      {{ $data->ios_cer_exp }}
                    </div>
                </div>
                @endforeach
          </div>
          <div class="tab-pane fade" id="push-stay" role="tabpanel" aria-labelledby="push-stay-tab">
            <!-- 탭2-2 -->
                @foreach ($willBeExpiredPush as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-info">D {{ App\Helpers\Helpers::calculateDday($data->ios_cer_exp) }}</span>
                      {{ $data->ios_cer_exp }}
                    </div>
                </div>
                @endforeach
          </div>
        </div>
      </div>
      <!-- 탭2 End -->

      <!-- 탭3 -->
      <div class="tab-pane fade" id="ma" role="tabpanel" aria-labelledby="ma-tab">
        <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="ma-over-tab" data-toggle="tab" href="#ma-over" role="tab" aria-controls="ma-over" aria-selected="true">
              MA 인증서 만료</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ma-stay-tab" data-toggle="tab" href="#ma-stay" role="tab" aria-controls="ma-stay" aria-selected="false">
              MA 인증서 만료예정</a>
          </li>
        </ul>
        <div class="tab-content" id="tab-depth2-content">
          <div class="tab-pane fade show active" id="ma-over" role="tabpanel" aria-labelledby="ma-over-tab">
            <!-- 탭3-1 -->
                @foreach ($expiredMA as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-pink">D+ {{ App\Helpers\Helpers::calculateDday(App\Helpers\Helpers::dateFormat($data->end_time)) }}</span>
                      {{ App\Helpers\Helpers::dateFormat($data->end_time) }}
                    </div>
                </div>
                @endforeach
          </div>
          <div class="tab-pane fade" id="ma-stay" role="tabpanel" aria-labelledby="ma-stay-tab">
            <!-- 탭3-2 -->
                @foreach ($willBeExpiredMA as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-info">D {{ App\Helpers\Helpers::calculateDday(App\Helpers\Helpers::dateFormat($data->end_time)) }}</span>
                      {{ App\Helpers\Helpers::dateFormat($data->end_time) }}
                    </div>
                </div>
                @endforeach
          </div>
        </div>
      </div>
      <!-- 탭3 End -->

      <!-- 탭4 -->
      <div class="tab-pane fade" id="apps" role="tabpanel" aria-labelledby="apps-tab">
        <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="apps-over-tab" data-toggle="tab" href="#apps-over" role="tab" aria-controls="apps-over" aria-selected="true">
              앱서비스 만료</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="apps-stay-tab" data-toggle="tab" href="#apps-stay" role="tab" aria-controls="apps-stay" aria-selected="false">
              앱서비스 만료예정</a>
          </li>
        </ul>
        <div class="tab-content" id="tab-depth2-content">
          <div class="tab-pane fade show active" id="apps-over" role="tabpanel" aria-labelledby="apps-over-tab">
            <!-- 탭4-1 -->
                @foreach ($expiredApps as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-pink">D+ {{ App\Helpers\Helpers::calculateDday(str_limit($data->end_time, 10)) }}</span>
                      {{ str_limit($data->end_time, 10) }}
                    </div>
                </div>
                @endforeach
          </div>
          <div class="tab-pane fade" id="apps-stay" role="tabpanel" aria-labelledby="apps-stay-tab">
            <!-- 탭4-2 -->
                @foreach ($willBeExpiredApps as $data)
                <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                    <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      {{ $data->app_name }}<br><span class="badge badge-info">D {{ App\Helpers\Helpers::calculateDday(str_limit($data->end_time, 10)) }}</span>
                      {{ str_limit($data->end_time, 10)}}
                    </div>
                </div>
                @endforeach
          </div>
        </div>
      </div>
      <!-- 탭4 End -->

    </div>

</div>

<script type="text/javascript">
	function calculateDday(dt) {
		 // 오늘 기준 입력날짜 d-day 계산
		 var todate ='{{time()}}';
		 var date = (new Date(dt).valueOf() / 1000);
		 var dday = parseInt((todate - date) / 86400);
		 return dday;
	}
    $(document).ready(function(){
        $(".load-more").on('click',function(){
            var _totalCurrentResult=$(".expiredIos").length;
            console.log("1", _totalCurrentResult);
            // Ajax Reuqest
            $.ajax({
                url: '/load-more-data',
                type:'get',
                dataType:'json',
                data:{
                    skip:_totalCurrentResult
                },
                beforeSend:function(){
                    $(".load-more").html('Loading...');
                },
                success:function(response){
                    var _html = '';
					
                    $.each(response,function(index,value){
                        _html += '<div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block expiredIos">';
                        _html += '  <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">';
                         _html += value.app_name+'<br><span class="badge badge-pink">D+ '+calculateDday(value.ios_dev_exp)+'</span> ';
                        _html += value.ios_dev_exp;
                        _html += '  </div>';
                        _html += '</div>';

                    });
                    $("#expiredIosList").append(_html);
                    // Change Load More When No Further result
                    var _totalCurrentResult=$(".expiredIos").length;
                    var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
                    console.log("2", _totalCurrentResult);
                    console.log(_totalResult);
                    if (_totalCurrentResult == _totalResult){
                        $(".load-more").remove();
                    }else{
                        $(".load-more").html('Load More');
                    }
                }
            });
        });
    });
</script>

<!-- <script>
$(document).ready(function() {
  var _token = $('input[name="_token"]').val();
  load_more('');

  function load_more(id = '', _token)
  {
    $.ajax({
       url: "/loadmore/load_more",
       method: "POST",
       data: {
         idx: id,
         _token:_token
       },
       success:function(data)
       {
         $('#load_more_button').remove();
         $('#expiredIos').append(data);
       }
      })
     }

     $(document).on('click', '#load_more_button', function(){
      var id = $(this).data('id');
      $('#load_more_button').html('<b>불러오는 중...</b>');
      load_more(id, _token);
     });

});

</script> -->
