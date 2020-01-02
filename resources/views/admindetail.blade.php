@extends('layouts.default')

@section('content')

<div class="row">
    <!-- col-sm-12 start -->
    <div class="col-sm-12">

  {{ Breadcrumbs::render('adminlist') }}
    <!-- card -->
    <div class="card">
        <!-- cardbody start -->
        <div class="card-body">
            <div class="row">
                <div id="app_noti" class="row" >

                    <div class="col-12" style="overflow:auto;" >
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-myinfo-tab" data-toggle="tab" href="#nav-myinfo" role="tab" aria-controls="nav-myinfo" aria-selected="true">개인정보 변경</a>
                                <a class="nav-item nav-link" id="nav-app-company-tab" data-toggle="tab" href="#nav-app-company" role="tab" aria-controls="nav-app-company" aria-selected="false">지정업체 수정</a>
                              @if(request()->user()->adminNMNew == 'all' || strpos(request()->user()->adminNMNew,'|adminupdate|') > -1)
                                <a class="nav-item nav-link" id="nav-manager-tab" data-toggle="tab" href="#nav-manager-info" role="tab" aria-controls="nav-manager-info" aria-selected="false">관리자 권한 수정</a>
                              @endif
                            </div>
                        </nav>

                        <!-- tab content-->
                        <div class="tab-content">
                            <!-- #nav-myinfo -->
                            <div class="tab-pane px-3 active" id="nav-myinfo" role="tabpanel" aria-labelledby="nav-myinfo-tab">
                                <div class="row">
                                    <div class="col-md-12 pl-5">
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">ID</label>
                                            <strong class="form-control-static">{{ request()->user()->mem_id }}</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">관리자명</label>
                                            <strong class="form-control-static">{{ request()->user()->mem_name }}</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">연락처</label>
                                            <input type="text" name="phone" class="col-4" value="010-9804-8898">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">이메일</label>
                                            <input type="text" name="email" class="col-4" value="byapps01@naver.com">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">비밀번호</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">새 비밀번호</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">비밀번호 확인</label>
                                            <input type="password" name="pw" class="col-4" value="">
                                        </div>

                                        <button type="button" class="btn btn-sm btn-inverse waves-effect w-md waves-light text-center"> <i class="mdi mdi-account"></i> <span>회원정보 수정</span> </button>
                                    </div>
                                    <!--//col-md-12-->
                                </div>
                                <!--//row-->
                            </div>
                            <!-- //#nav-myinfo -->

                            <!-- #nav-company-info -->
                            <div class="tab-pane fade px-3 text-black" id="nav-app-company" role="tabpanel" aria-labelledby="nav-app-company-tab">
                                <div class="row">
                                    <div class="col-md-12 pl-5">
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">업체상태</label>
                                            <strong class="form-control-static">색상</strong>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">주요관리</label>
                                            <input type="text" class="colorpicker-default form-control" value="#8fff00">
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">부가서비스</label>
                                            <div class="col-md-7 col-xs-12 px-0">
                                                <div class="checkbox checkbox-warning">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        푸쉬자동화
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-warning">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        웹푸쉬
                                                    </label>
                                                </div>
                                                <br>
                                                <div class="checkbox checkbox-pink">
                                                    <label>
                                                        <input type="checkbox" value="android" >
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        MA통합
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-purple">
                                                    <label>
                                                        <input type="checkbox" value="iphone" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        리타겟팅
                                                    </label>
                                                </div>
                                                <div class="checkbox checkbox-purple">
                                                    <label>
                                                        <input type="checkbox" value="android" checked="">
                                                        <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                        MA
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12 control-label">이용기간</label>
                                            <div class="input-daterange input-group col-md-7 col-xs-12" id="date-range">
                                                <input class="form-control input-limit-datepicker" type="text" name="daterange" value="06/01/2015 - 06/07/2015"/>
                                                <input type="text" class="form-control col-md-2 col-xs-2" name="count-day" value="">일
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-6 col-xs-12control-label">APP OS</label>
                                            <div class="checkbox checkbox-success m-t-0">
                                                <label>
                                                    <input type="checkbox" value="android" checked="">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                    android
                                                </label>
                                            </div>
                                            <div class="checkbox checkbox-info ml-3">
                                                <label>
                                                    <input type="checkbox" value="iphone" checked="">
                                                    <span class="cr"><i class="cr-icon fa fa-check"></i></span>
                                                    ios
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-6 col-xs-12 control-label">이용기간</label>

                                        <div class="form-inline">
                                            <div class="input-daterange input-group row" id="date-range">
                                                <input type="date" class="col-md-3 col-xs-3" name="start">
                                                <div class="input-group-append">
                                                    <span class="input-group-text bg-custom text-white b-0">to</span>
                                                </div>
                                                <input type="date" class="col-md-3 col-xs-3" name="end">
                                                <input type="text" class="col-md-2 col-xs-2" name="count-day" value="">일
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- //#nav-company-info -->

                          @if(request()->user()->adminNMNew == 'all' || strpos(request()->user()->adminNMNew,'|adminupdate|') > -1)
                            <div class="tab-pane fade px-3 text-black" id="nav-manager-info" role="tabpanel" aria-labelledby="nav-manager-tab">
                                <div class="row">
                                    <table id="adminTable" class="table table-striped mb-3 table-colored table-inverse" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>IDX</th>
                                                <th>이름</th>
                                                <th>가입일자</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                          @endif
                        </div><!-- //tab content-->
                    </div>
            </div>
            <!--// row -->
        </div>
        <!--// card-body-->
    </div>
    <!--//card-->
    </div>
    <!--//col-dm-12-->
</div>
<!--// row-->
@endsection
@if(request()->user()->adminNMNew == 'all' || strpos(request()->user()->adminNMNew,'|adminupdate|') > -1)
    <div id="shadow" style="display:none"></div>
    <div class="col-md-12 pl-5" id="permission" style="display:none">
        <form action="javascript:void(0)">
            <h1></h1>
          @foreach($pageList as $name => $data)
            <div class="form-group row" style="margin-bottom: 0;">
                <label for="user_id" class="col-md-4 col-form-label text-md-right" style="padding-bottom:0">{{ $data['name'] }}</label>
                <div class="col-md-8 col-form-label" style="padding-bottom:0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name.'nothing' }}" value="nothing" checked>
                        <label class="form-check-label" for="{{ $name.'nothing' }}">없음</label>
                    </div>
                    <?$temp = '';?>
                    @foreach($data['permission'] as $key => $val)
                        <?$temp.= $name.$key ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="{{ $name }}" id="{{ $name.$key }}" value="{{ $temp }}">
                            <label class="form-check-label" for="{{ $name.$key }}">{{ $val }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
          @endforeach
            <div class="col-md-8 offset-md-4">
                <button class="btn btn-primary" onclick="send()">저장</button>
                <button class="btn btn-danger" onclick="$('#shadow').click();">취소</button>
            </div>
        </div>
    </form>
@endif
@push('scripts')
<script>
  @if(request()->user()->adminNMNew == 'all' || strpos(request()->user()->adminNMNew,'|adminupdate|') > -1)
    function send(){
        var permission = [];
        new FormData($('#permission>form')[0]).forEach(function(value, key){
            if(value != 'nothing'){
               permission.push(value);
            }
        })
        if(permission.length == 0) permission == 'nothing'
        $.ajax({
            url : '{{ route('adminupdate') }}',
            type : 'POST',
            data : {user_id:user_id,permission:permission},
            error : function(jqXHR, textStatus, error) {

            },
            success : function(data, jqXHR, textStatus) {
                if(data.success){
                    alert('저장되었습니다');
                    $('#shadow').click();
                }
            }
        });
        return false;
    }
    var user_id = 0;
    var AdminListFirst = true;
    var perPopup = $.merge($('#shadow'),$('#permission'))
    $('[href="#nav-manager-info"]').click(function(){
        if(!AdminListFirst) return;
        AdminListFirst = false;
        $('#adminTable').DataTable({
            processing: true,
            serverSide: true,
            url: location.href,
            columns: [
                { data: 'idx', name: 'idx' },
                { data: 'mem_name', name: 'mem_name' },
                { data: 'reg_date', name: 'reg_date' },
            ],
            columnDefs: [
               {
                  'targets': 0,
                  'className': 'select-checkbox',
                  'searchable': false,
                  'orderable': false,
                  'checkboxes': {
                     'selectRow': true
                  },
               },
            ],
            order: [[ 2, 'asc']],
            paging: true,
            pageLength: 50,
            fixedHeader: false,
            responsive: true,
            orderClasses: false,
            stateSave: false,
            "fnDrawCallback": function () {
                $("#adminTable tbody tr").click(function () {
                    user_id = $(this).attr('id')
                    $('#permission h1').html($(this).find('td').eq(1).text());
                    $.ajax({
                        url : '{{ route('adminupdate') }}',
                        type : 'POST',
                        data : {user_id:user_id},
                        error : function(jqXHR, textStatus, error) {

                        },
                        success : function(data, jqXHR, textStatus) {
                            var per = data.adminNMNew;
                            $('#permission [value=nothing]').attr("checked",true)
                            if(per == 'all'){
                                for(var i = 0 ; i < $('#permission input[type=radio]').length ; i++){
                                    $('#permission input[type=radio]').eq(i).attr('checked',true)
                                }
                            }else if(per == null){
                            }else{
                                per = per.substring(1,per.length-1);
                                per = per.split('|');
                                for(var i = 0 ; i < per.length ; i++){
                                    $(`#permission input[type=radio][value=${per[i]}]`).attr('checked',true)
                                }
                            }
                            perPopup.fadeIn();
                        }
                    });
                });
                $('#shadow').click(function(){
                    perPopup.fadeOut();
                })
             },
        });
    })
  @endif
</script>
@endpush
<style>
    #permission{
        height:fit-content;
        background: #fff;
        position: fixed;
        margin: auto;
        width: 50%;
        z-index: 4000;
        border-radius: 10px;
        top:0;
        bottom: 0;
        left:0;
        right:0;
    }
    #permission>h1{
        text-align: center;
    }
    #shadow{
        position: fixed;
        z-index: 3999;
        height: 100%;
        width: 100%;
        background: #000;
        opacity: .4;
    }
</style>
