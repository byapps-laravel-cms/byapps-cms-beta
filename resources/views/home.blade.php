@extends('layouts.default')

@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">여기요</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> -->


<div class="container-fluid">
<!-- {% if not user %}
<h2><center>로그인하는페이지</center></h2>
{% elseif user %} -->


<div class="sortable">
  <!-- {% for record in records %}
      {% if record == 'layout1' %} -->
        <li class="ui-state-default one card" id="layout1">
            <div class="cal_box col-md-12 col-sm-12">
                <div class="card-title mt-2">
                    <i class="fi-menu"></i> 주문요청현황
                    <button class="btn float-right" type="button" data-toggle="collapse" data-target="#salesList" aria-expanded="true" aria-controls="salesList"><i class="dripicons-chevron-down"></i></button>
                </div>
            </div>


            <div class="row dragbox collapse show" id="salesList">
                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-two widget-two-purple">
                            <div class="card-body">
                                <i class="mdi mdi-chart-line widget-two-icon"></i>
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase text-white font-600 font-secondary text-overflow" title="Statistics">
                                      주문접수
                                    </p>
                                    <h2 class="text-white">
                                      <span data-plugin="counterup">10</span>
                                      <small><i class="mdi mdi-arrow-up text-white"></i></small>
                                    </h2>
                                    <p class="text-white m-0">어제보다 <b>10%</b> 늘었어요</p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-two widget-two-info">
                            <div class="card-body">
                                <i class="mdi mdi-access-point-network widget-two-icon"></i>
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-white text-uppercase font-600 font-secondary text-overflow" title="User Today">
                                      부가서비스 접수
                                    </p>
                                    <h2 class="text-white"><span data-plugin="counterup">20</span>
                                      <small><i class="mdi mdi-arrow-up text-white"></i></small>
                                    </h2>
                                    <p class="text-white m-0">어제보다 <b>5.6%</b> 줄었어요</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                        <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-two widget-two-pink">
                            <div class="card-body">
                                <i class="mdi mdi-timetable widget-two-icon"></i>
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-uppercase text-white font-600 font-secondary text-overflow" title="Request Per Minute">
                                      업데이트 접수
                                    </p>
                                    <h2 class="text-white"><span data-plugin="counterup">30</span>
                                      <small><i class="mdi mdi-arrow-up text-white"></i></small>
                                    </h2>
                                    <p class="text-white m-0">어제보다 <b>7.02%</b> 늘었어요</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card widget-box-two widget-two-success">
                            <div class="card-body">
                                <i class="mdi mdi-cloud-download widget-two-icon"></i>
                                <div class="wigdet-two-content">
                                    <p class="m-0 text-white text-uppercase font-600 font-secondary text-overflow" title="New Downloads">New Downloads</p>
                                    <h2 class="text-white"><span data-plugin="counterup">854</span> <small><i class="mdi mdi-arrow-up text-white"></i></small></h2>
                                    <p class="text-white m-0"><b>9.9%</b> From previous period</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->

            </div>
        </li>
      <!-- {% elseif record == 'layout2' %} -->
        <li class="ui-state-default card" id="layout2">
            <div class="cal_box col-md-12 col-sm-12">
                <div class="card-title mt-2">
                    <i class="fi-menu"></i> 통계
                    <button class="btn float-right" type="button" data-toggle="collapse" data-target="#allLank" aria-expanded="true" aria-controls="allLank"><i class="dripicons-chevron-down"></i></button>
                </div>
            </div>
            <div class="dragbox_hover row collapse show" id="allLank">
                <div class="col-xs-12 col-md-3">
                    <!-- <h6 class="theme1 p-1 text-center">앱 통계</h6> -->
                    <div id="app_stats"></div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <!-- <h6 class="theme1 p-1 text-center">MA 통계</h6> -->
                    <div id="ma_stats"></div>
                </div>
                <div class="col-xs-12 col-md-6">
                    <h6 class="theme1 p-1 text-center">매출통계</h6>
                    <div id="sale_stats" data-toggle="modal" data-target="#lankDetail"></div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="lankDetail" tabindex="-1" role="dialog" aria-labelledby="lankDetail" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">기간별 상세 통계</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="date" >~
                            <input type="date" >
                            <button type="button" class="btn btn-secondary mx-auto">조회</button>
                        </form>
                        <div id="chartDetail">

                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-auto" data-dismiss="modal">확인</button>
                    </div>
                </div>
                </div>
            </div>
        </li>
      <!-- {% elseif record == 'layout3' %} -->

        <li class="ui-state-default one card" id="layout3">
            <div class="cal_box col-md-12 col-sm-12">
                <div class="card-title mt-2">
                    <i class="fi-menu"></i> 만료예정업체
                    <button class="btn float-right" type="button" data-toggle="collapse" data-target="#endList" aria-expanded="true" aria-controls="endList"><i class="dripicons-chevron-down"></i></button>
                </div>
            </div>

            <div class="dragbox collapse show" id="endList">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-ios-tab" data-toggle="tab" href="#nav-ios" role="tab" aria-controls="nav-ios" aria-selected="true">IOS 계정 만료</a>
                        <a class="nav-item nav-link" id="nav-push-tab" data-toggle="tab" href="#nav-push" role="tab" aria-controls="nav-push" aria-selected="false">푸쉬 인증서만료</a>
                        <a class="nav-item nav-link" id="nav-ma-tab" data-toggle="tab" href="#nav-ma" role="tab" aria-controls="nav-ma" aria-selected="false">MA 서비스만료</a>
                        <a class="nav-item nav-link" id="nav-ios2-tab" data-toggle="tab" href="#nav-app" role="tab" aria-controls="nav-ios2" aria-selected="true">앱서비스 만료예정</a>
                    </div>
                </nav>

                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane mx-0 row active" id="nav-ios" role="tabpanel" aria-labelledby="nav-ios-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-ios-tab" data-toggle="tab" href="#ios-stay" role="tab" aria-controls="ios-stay" aria-selected="true">만료예정</a>
                                <a class="nav-item nav-link" id="nav-push-tab" data-toggle="tab" href="#ios-over" role="tab" aria-controls="ios-over" aria-selected="false">만료</a>
                            </div>
                        </nav>


                    </div>
                    <div class="tab-pane fade row" id="nav-push" role="tabpanel" aria-labelledby="nav-push-tab">

                    </div>

                    <div class="tab-pane fade row" id="nav-ma" role="tabpanel" aria-labelledby="nav-ma-tab">

                    </div>

                    <div class="tab-pane fade row" id="nav-app" role="tabpanel" aria-labelledby="nav-ma-tab">

                        </div>
                </div>
            </div>
        </li>
      <!-- {% endif %}
  {% endfor %} -->
</div>

<!-- Pages -->


<!-- {% endif %} -->

</div>




@endsection
