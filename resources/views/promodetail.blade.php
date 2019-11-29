@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('promodetail') }}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->    
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($promotionData)
                        <h4>
                        <strong>{{ $promotionData->mem_name }}</strong>
                        </h4>
                        @else
                        <h4>
                        <strong>Something went wrong.</strong>
                        </h4>
                        @endif
                        <hr />
                    </div>

                    

                    <div class="col-md-12 col-xs-12 px-4">
                        <form method="POST" action="">
                        <input type="hidden" name="idx" value="{{ $promotionData->idx}}"/>
                        
                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">프로모션명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $promotionData->pm_title }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-2 col-form-label">프로모션 코드</label>
                                <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1"> {{ $promotionData->pm_code }} </p>
                                </div>
                            </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">발급대상 회원ID</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $promotionData->mem_id }} </p>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원명</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1"> {{ $promotionData->mem_name }} </p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">적용대상</label>
                            <div class="col-md-10 col-xs-9">
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

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">적용내용</label>
                            <div class="col-md-10 col-xs-9">
                                <select name="pm_content" id="" class="form-control">
                                <option value="">프로모션 혜택</option>
                                @php $pmContents = array("660000:dc","550000:dc","440000:dc","330000:dc","220000:dc","110000:dc","55000:dc","0:dc") @endphp
                                @foreach ($pmContents as $pmContent)
                                <option value="{{ $pmContent }}">{{ $pmContent }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        <label class="col-md-2 col-form-label">발급사유</label>
                            <div class="col-md-10 col-xs-9">
                                <textarea id="receipt" name="receipt" class="form-control" rows="5">{{ $promotionData->pm_comment }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-md-10 col-xs-9">
                                <label for="" class="radio-inline">
                                <input type="checkbox" name="pm_used" value="0">수정하기
                                </label>
                                <label for="" class="radio-inline">
                                <input type="checkbox" name="pm_used" value="1">삭제하기
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info float-right">업데이트</button>
                    </form>
                </div>
            </div><!--row end-->
        </div>
            <!-- col-md-12 -->
</div>
<!-- cardbody end -->
</div>
<!-- card end -->
</div>
<!-- col-12 end -->
</div>
<!-- row end -->
</div>
<!-- container-fluid end -->

    

@endsection
