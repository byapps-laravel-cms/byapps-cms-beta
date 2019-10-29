@extends('layouts.default')

@section('content')
<style>
.input-group-text {
  font-size: 11px;
}
</style>

@if (Auth::user())
<div class="container-fluid">

  <div class="sortable">

    @foreach ($home_layouts as $layout)

        @if ($layout == 'layout1')
        <!-- 주문 현황 -->
        <li class="ui-state-default one card" id="layout1">
            @include('components.status')
        </li>

        @elseif ($layout == 'layout2')
        <!-- 차트 -->
        <li class="ui-state-default card" id="layout2">
          @include('components.chart')
        </li>

        @elseif ($layout == 'layout3')
        <!-- 매출 차트 -->
        <li class="ui-state-default card" id="layout3">
            @include('components.saleschart')
        </li>

        @elseif ($layout == 'layout4')
        <!-- 매출 통계표 -->
        <li class="ui-state-default card" id="layout4">
            @include('components.sales')
        </li>

        @elseif ($layout == 'layout5')
        <!-- 만료예정업체 목록 -->
        <li class="ui-state-default one card" id="layout5">
            @include('components.expiredlist')
        </li>

        @endif
    @endforeach

  </div>
  <!-- sortable end -->

</div>
<!-- container-fluid end -->
@endif
@endsection
