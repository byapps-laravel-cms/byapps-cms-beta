@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('pushnewsdetail') }}

    <div class="row">
        <!-- col-sm-12 start -->
        <div class="col-sm-12">
        <!-- card -->    
        <div class="card">
            <!-- cardbody start -->
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        @if ($pushNewsData->app_name)
                        <h4>
                        <strong>{{$pushNewsData->app_name}}</strong>
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
                        <input type="hidden" name="idx" value=""/>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-md-10 col-xs-9">
                                <label for="" class="radio-inline">
                                <input type="radio" name="pm_used" value="0">수정하기
                                </label>
                                <label for="" class="radio-inline">
                                <input type="radio" name="pm_used" value="1">삭제하기
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group row" id="paymentData">
                            <label class="col-md-2 col-form-label ">푸쉬알림</label>
                            <div class="col-md-10 col-xs-9">
                            <p class="form-control-static mt-1 mb-1">{{$pushNewsData->push_true}}</p>
                            </div>
                        </div>

                        <div class="form-group row">
							<label class="col-md-2 col-form-label">App.ID</label>
							<div class="col-md-10 col-xs-9">
							<p class="form-control-static mt-1 mb-1">{{$pushNewsData->app_name}} ({{$pushNewsData->app_id}})</p>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-md-2 col-form-label">소식내용</label>
                            <div class="col-md-10 col-xs-9">
								<div class="col-md-2" style="padding-left: 0; float:left">
									<textarea id="content" name="content" class="form-control" rows="5" {{ $pushNewsData->content_type == "img" ? "readonly" : "" }}>{{$pushNewsData->content}}</textarea>
								</div>
								<div class="col-md-2" style="float:left">
									@if ($pushNewsData->content_type == "img")
										<img src='/member/apps/news/{{$pushNewsData->app_id}}/{{$pushNewsData->content}}' height='200'>
									@endif
								</div>
                            </div>
						</div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">첨부이미지</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <div class="form-group">
                                        <input type="file" name="attach_img" class="filestyle" data-placeholder="{{$pushNewsData->attach_img}}" data-buttontext="첨부파일" data-buttonname="btn-secondary">
										&nbsp;&nbsp;이미지와 소식내용은 별도 전달됩니다.
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

						</div>

                        <div class="col-md-12 col-sm-12 text-center">
							<button type="submit" class="btn btn-info mx-auto">등록하기</button>
						</div>
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
