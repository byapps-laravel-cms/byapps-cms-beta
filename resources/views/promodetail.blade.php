@extends('layouts.default')

@section('content')

<div class="container">

  {{ Breadcrumbs::render('promo') }}

  <div class="alert alert-info">
    @if ($promotionData)
    <h4>
      <strong>{{ $promotionData->mem_name }}</strong>
    </h4>
    @else
    <h4>
      <strong>Something went wrong.</strong>
    </h4>
    @endif
  </div>

  <hr />

  <div class="method">

    <div class="col-md-12 margin-0">
        <form method="POST" action="">


        <input type="hidden" name="idx" value="{{ $promotionData->idx}}"/>

            <div class="row1">

                <div class="form-group row" id="appsData">

                    <label class="col-md-4 control-label propertyname th_style_1">프로모션명</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10">
                          <input type="text" class="form-control" name="pm_title" value="{{ $promotionData->pm_title }}">
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">프로모션 코드</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10">
                          <input type="text" class="form-control" name="pm_code" value="{{ $promotionData->pm_code }}">
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">발급대상 회원ID</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10">
                          <input type="text" class="form-control" name="mem_id" value="{{ $promotionData->mem_id }}">
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">회원명</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10">
                          <input type="text" class="form-control" name="mem_name" value="{{ $promotionData->mem_name }}">
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">적용대상</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10">
                        <label class="radio-inline">
                          <input type="radio" name="pm_target" checked="{{ $promotionData->pm_target == 'ma' ? 'checked' : '' }}" value="">
                          마케팅 오토메이션
                        </label>
                        <label class="radio-inline">
                          <input type="radio" name="pm_target" checked="{{ $promotionData->pm_target != 'ma' ? 'checked' : '' }}" value="">
                          앱 서비스
                        </label>
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">적용내용</label>
                    <div class="col-md-8 col-xs-10">
                      <div class="col-md-8 col-xs-10 td_style_1">

                        <select name="pm_content" id="" class="form-control">
                          <option value="">프로모션 혜택</option>
                        @php $pmContents = array("660000:dc","550000:dc","440000:dc","330000:dc","220000:dc","110000:dc","55000:dc","0:dc") @endphp
                        @foreach ($pmContents as $pmContent)
                          <option value="{{ $pmContent }}">{{ $pmContent }}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">발급사유</label>
                    <div class="col-md-8 col-xs-10">
                      <textarea class="col-md-8 col-xs-10" name="pm_comment" id="" rows="5">{{ $promotionData->pm_comment }}</textarea>
                    </div>

                    <label class="col-md-4 control-label propertyname th_style_1">옵션</label>
                    <div class="col-md-8 col-xs-10">
                      <label for="" class="radio-inline">
                        <input type="checkbox" name="pm_used" value="0">수정하기
                      </label>
                      <label for="" class="radio-inline">
                        <input type="checkbox" name="pm_used" value="1">삭제하기
                      </label>
                    </div>


                </div>

          </div>
          <button type="submit" class="btn btn-info float-right">업데이트</button>

        </div>

        </form>
    </div>

</div>
@endsection
