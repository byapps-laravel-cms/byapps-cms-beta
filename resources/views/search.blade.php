@extends('layouts.default')

@section('content')

<div class="col-lg-12">
  <div class="card card-border">
      <div class="card-heading">
        <h3 class="card-title">{{ $searchResults->count() }} results found for "{{ request('query') }}"</h3>
      </div>

      <div class="card-body">

          @foreach($searchResults->groupByType() as $type => $modelSearchResults)
              <h3>@foreach($typesArray as $key => $value)
                {{ ucfirst($type) == $key ? $value : '' }}
                @endforeach
              </h3>

              @foreach($modelSearchResults as $searchResult)

                <div class="col-md-3" style="display:inline-block;">
                  <li>
                    <a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                  </li>
                </div>

              @endforeach

          @endforeach

      </div>
  </div>
</div>
@endsection
