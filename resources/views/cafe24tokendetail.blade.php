@extends('layouts.default')

@section('content')

<div class="container-fluid">

  {{ Breadcrumbs::render('cafe24tokendetail') }}

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">

                    @if ($cafe24ApiTokenData)
                    <h4 class="header-title">{{ $cafe24ApiTokenData->mall_id }}</h2>
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
                      {!! Form::open([ 'route' => ['cafe24tokenupdate', $cafe24ApiTokenData->idx] ]) !!}

                      <div class="form-group row">
                          <label class="col-md-2 col-form-label">설치일</label>
                          <div class="col-md-10 col-xs-9">
                            <div class="form-inline">
                                <div class="input-group">
                                    <p class="form-control">{{ $cafe24ApiTokenData->issued_date }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">몰 아이디</label>
                            <div class="col-md-10 col-xs-9">
                                <div class="form-inline">
                                    <div class="input-group">
                                        <p class="form-control">{{ $cafe24ApiTokenData->mall_id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">회원 아이디</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="mem_id" name="mem_id"  value="{{ $cafe24ApiTokenData->mem_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">앱 아이디</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="app_id" name="app_id"  value="{{ $cafe24ApiTokenData->app_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">주문번호</label>
                            <div class="col-md-10 col-xs-9">
                              <div class="form-inline">
                                  <div class="input-group">
                                      <input type="text" class="form-control" id="order_no" name="order_no"  value="{{ $cafe24ApiTokenData->order_no }}">
                                    </div>
                                </div>
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

@push('scripts')
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

function updateMemlv(idx) {
  var idx = {!! json_encode($cafe24ApiTokenData->idx) !!};

  $.ajax({
    async: false,
    url: '{{ Route("updatememlv") }}',
    type: 'POST',
    data: {
      idx: idx,
      _token: "{{ csrf_token() }}"
    },
    success: function(response) {
      //console.log(response);
    },
  });
}

</script>
@endpush

@endsection
