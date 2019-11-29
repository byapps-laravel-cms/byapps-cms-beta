@extends('layouts.default')

@section('content')

<div class="col-lg-12">
  <div class="card card-border">
      <div class="card-heading">
        <h3 class="card-title">{{ $searchResults->count() }} 개의 <mark>"{{ request('query') }}"</mark> 검색결과</h3>
      </div>

      <div class="card-body">

          @foreach($searchResults->groupByType() as $type => $modelSearchResults)
              <h3>@foreach($typesArray as $key => $value)
                {{ ucfirst($type) == $key ? $value : '' }}
                @endforeach
              </h3>

              @foreach($modelSearchResults->chunk(20) as $chunk)

                @foreach($chunk as $searchResult)
                <div class="col-md-3" style="display:inline-block;">
                  <li>
                    <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                  </li>
                </div>
                @endforeach

              @endforeach

              <hr />

          @endforeach

      </div>
  </div>
</div>
@endsection
