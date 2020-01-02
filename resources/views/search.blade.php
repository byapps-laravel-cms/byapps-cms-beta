@extends('layouts.default')

@section('content')

<div class="col-lg-12">
  <div class="card card-border">
      <div class="card-heading">
        <h3 class="card-title">{{ $searchResults->count() }} 개의 <mark>"{{ request('query') }}"</mark> 검색결과</h3>
      </div>

      <div class="card-body" id="searchResults">

          @foreach($searchResults->groupByType() as $type => $modelSearchResults)
              <h3>@foreach($typesArray as $key => $value)
                {{ ucfirst($type) == $key ? $value : '' }}
                @endforeach
              </h3>

              @foreach($modelSearchResults->chunk(20) as $chunk)

                @foreach($chunk as $searchResult)
                <div class="col-md-3 searchResult" style="display:inline-block;">
                  <li>
                    <a href="{{ $searchResult->url }}">{{ $searchResult->title }}
                    </a>
                  </li>
                </div>
                @endforeach

                    @if(count($chunk) > 0)
                     <p class="text-center mt-4 mb-5">
                       <button class="load-more btn btn-pink btn-rounded btn-bordered waves-effect w-md waves-light" >Load More</button>
                     </p>
                     @endif
              @endforeach

              <hr />

          @endforeach

      </div>
  </div>
</div>
@endsection

@push('script')
<script type="text/javascript">
$(document).ready(function(){
  $(".load-more").on('click', function(){
      var _totalCurrentResult = $("#searchResults div").length;

      console.log("!!!!!!!!", _totalCurrentResult);

      $.ajax({
          url: '/search',
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
                  _html += '<div class="col-md-3 searchResult" style="display:inline-block;">';
                  _html += '  <li>';
                   _html += '<a href="'+ value.url + '">' + value.title + '</a>';
                  _html += '  </li>';
                  _html += '</div>';

              });
              $("#searchResults").append(_html);
              // Change Load More When No Further result
              var _totalCurrentResult=$(".searchResult").length;
              var _totalResult=parseInt($(".load-more").attr('data-totalResult'));
              console.log("2", _totalCurrentResult);
              console.log(_totalResult);
              if (_totalCurrentResult == _totalResult){
                  $(".load-more").remove();
              }else{
                  $(".load-more").html('Load More');
              }
    $(".load-more").blur();
          }
      });
  });
});
</script>
@endpush
