@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('apkdetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($apkdata)
                    <h4 class="header-title">{{ $apkdata->app_name }}</h2>
                    @else
                    <h4 class="header-title">데이터가 없습니다.</h4>
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

                    <div class="row">
                    <div class="col-md-12 col-xs-12 px-4">

                      <!-- form start -->
                      {!! Form::open([ 'route' => ['apkupdate', $apkdata->idx] ]) !!}

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App.ID</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_nick" name="mem_nick" value="{{ $apkdata->app_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">App.Name</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="ceo_name" name="ceo_name"  value="{{ $apkdata->app_name }}">
                                    </div>
                                </div>
                            </div>
                        </div>

						<div class="form-group row">
                            <label class="col-md-2 col-form-label">APK 파일</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <!-- <input type="text" class="form-control" id="apk_file" name="apk_file" value="{{ $apkdata->apk_file }}"> -->
                                      <div class="form-group">
                                        <!-- <input name="fileToUpload" type="file" class="filestyle" data-input="false" id="filestyle-8" tabindex="-1" style="display: none;"> -->

                                        <input type="file" name="apk" class="filestyle" data-placeholder="{{ $apkdata->apk_file }}" data-buttontext="첨부파일" data-buttonname="btn-secondary">

                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">옵션</label>
                            <div class="col-md-10 col-xs-9">
                                <label for="" class="radio-inline" id="radio-inline">
                                  <input type="checkbox" name="radios" id="modify" value="modify">수정하기
                                  <input type="checkbox" name="radios" id="delete" value="delete">삭제하기
                                </label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-10 col-xs-9 offset-md-2">
                                <button type="submit" class="btn btn-info btn-sm float-center" >등록하기</button>
                                <button type="submit" class="btn btn-danger btn-sm float-center ml-1" >취소</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!-- form end -->
                    </div>
                    </div><!--row end-->
                </div>
                    <!-- col-md-12 -->
            </div>
                <!-- row end -->
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

@toastr_css
@toastr_js
@toastr_render

@push('script')
<script>
$(document).ready(function() {

checkRadiobutton();

// radio button 눌렸는지 체크
function checkRadiobutton() {
  var update_select = function (){
    if ($('#modify').is(':checked')) {
      $('#delete').attr('disabled', "disabled");
    }
    else if ($('#delete').is(':checked')){
      $("#delete").removeAttr("disabled");
      $('#modify').attr('disabled', "disabled");
    } else {
      $("#modify").removeAttr("disabled");
      $("#delete").removeAttr("disabled");
    }
  };

  $(update_select);
  $('#radio-inline').change(update_select);
}

});
</script>
@endpush

@endsection
