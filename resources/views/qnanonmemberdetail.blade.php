@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('qnanonmemberdetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($qnaNonmemberData)
                    <h4 class="header-title">{{ $qnaNonmemberData->company }}</h2>
                    @else
                    <h4 class="header-title">Something went wrong.</h4>
                    @endif

                    <hr />

                    @if ($message = Session::get('success'))
                    <div class="row justify-content-end">
                        <div class="col-3 col-align-self-end alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>
                            toastr.success("{{ $message }}");
                            </strong>
                        </div>
                    </div>
                    @endif

                    <div class="row" id="qnaNonmemberData">
                      <div class="col-md-12 col-xs-12 px-4">

                        <!-- form start -->
                        {!! Form::open([ 'route' => ['qnanonmemberupdate', $qnaNonmemberData->idx] ]) !!}

                          <div class="form-group row">
                              <label class="col-md-2 col-form-label ">접수자</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->name }}
                                </p>
                              </div>

                              <label class="col-md-2 col-form-label ">문의일시</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->reg_date }}
                                </p>
                              </div>

                              <label class="col-md-2 col-form-label ">이메일</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->email }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">연락처</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->phone }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">주소지</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->address }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">업종</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->comtype }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">도메인</label>
                              <div class="col-md-10 col-xs-9">
                                <a class="form-control-static mt-1 mb-1" href="{{ $qnaNonmemberData->hopeurl }}"></a>
                              </div>

                              <label class="col-md-2 col-form-label ">개발유형</label>
                              <div class="col-md-10 col-xs-9">
                                <p class="form-control-static mt-1 mb-1">{{ $qnaNonmemberData->apptype }}</p>
                              </div>

                              <label class="col-md-2 col-form-label ">문의내용</label>
                              <div class="col-md-10 col-xs-9">
                                  <div class="card card-border">
                                      <!-- <div class="card-header border-primary pb-1"> -->
                                        <div class="card-body">
                                            <p class="mb-0">{!! $qnaNonmemberData->comment !!}</p>
                                        </div>
                                      <!-- </div> -->
                                  </div>
                              </div>

                            </div>

                            @if ($qnaNonmemberData->process != 2)
                            <div class="form-group row" id="answer">
                                <div class="col-md-10 col-xs-9 offset-md-2">
                                    <button type="submit" class="btn btn-info btn-sm float-right">상담완료</button>
                                </div>
                            </div>
                            @endif

                          {!! Form::close() !!}
                          <!-- form end -->

                          </div><!-- col12 end-->
                      </div><!--row end-->

            </div><!--col-sm-12 end-->
          </div><!-- row end -->

        </div><!-- cardbody end -->

      </div>
      <!-- card end -->
    </div>
    <!-- col-12 end -->
  </div>
  <!-- row end -->
</div>
<!-- container-fluid end -->

@toastr_css
@toastr_js
@toastr_render

<script>

// 사이드바 열고 고객정보 보기
function getMemberInfo(idx) {
  console.log(idx);
  sidebarOpen();
}

</script>
@endsection
