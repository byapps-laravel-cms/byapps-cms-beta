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
                <span data-plugin="counterup">{{ $appsOrderCount }}</span>
                <small><i class="mdi mdi-arrow-up text-white"></i></small>
              </h2>
              <p class="text-white m-0">어제보다 <b>10%</b> 늘었어요</p>
          </div>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6 list">
      <div class="card widget-box-two widget-two-info list">
          <div class="card-body">
              <i class="mdi mdi-access-point-network widget-two-icon"></i>
              <div class="wigdet-two-content">
                  <p class="m-0 text-white text-uppercase font-600 font-secondary text-overflow" title="User Today">
                    부가서비스 접수
                  </p>
                  <h2 class="text-white"><span data-plugin="counterup">{{ $appendixOrderCount }}</span>
                    <small><i class="mdi mdi-arrow-up text-white"></i></small>
                  </h2>
                  <p class="text-white m-0">어제보다 <b>5.6%</b> 줄었어요</p>
              </div>
          </div>
      </div>
  </div><!-- end col -->

  <div class="col-xl-3 col-md-6 list">
      <div class="card widget-box-two widget-two-pink">
          <div class="card-body">
              <i class="mdi mdi-timetable widget-two-icon"></i>
              <div class="wigdet-two-content">
                  <p class="m-0 text-uppercase text-white font-600 font-secondary text-overflow" title="Request Per Minute">
                    업데이트 접수
                  </p>
                  <h2 class="text-white"><span data-plugin="counterup">{{ $updateCount }}</span>
                    <small><i class="mdi mdi-arrow-up text-white"></i></small>
                  </h2>
                  <p class="text-white m-0">어제보다 <b>7.02%</b> 늘었어요</p>
              </div>
          </div>
      </div>
  </div><!-- end col -->

  <div class="col-xl-3 col-md-6 list">
    <div class="card widget-box-two widget-two-success">
      <div class="card-body">
        <i class="mdi mdi-cloud-download widget-two-icon"></i>
        <div class="wigdet-two-content">
            <p class="m-0 text-white text-uppercase font-600 font-secondary text-overflow" title="New Downloads">
              New Downloads
            </p>
            <h2 class="text-white"><span data-plugin="counterup">854</span> <small><i class="mdi mdi-arrow-up text-white"></i></small></h2>
            <p class="text-white m-0"><b>9.9%</b> From previous period</p>
        </div>
      </div>
    </div>
  </div><!-- end col -->

</div>
