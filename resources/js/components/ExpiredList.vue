<template>

  <div class="dragbox collapse show" id="endList">
      <ul class="nav nav-tabs" id="tab-depth1" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="ios-tab" data-toggle="tab" href="#ios" role="tab" aria-controls="ios" aria-selected="true">
            IOS 계정 만료</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="push-tab" data-toggle="tab" href="#push" role="tab" aria-controls="push" aria-selected="false">
            푸쉬 인증서만료</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="ma-tab" data-toggle="tab" href="#ma" role="tab" aria-controls="ma" aria-selected="false">
            MA 서비스만료</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="apps-tab" data-toggle="tab" href="#apps" role="tab" aria-controls="apps" aria-selected="false">
            앱서비스 만료예정</a>
        </li>
      </ul>
      <div class="tab-content" id="tab-depth1-content">
        <!-- 탭1 -->
        <div class="tab-pane fade show active" id="ios" role="tabpanel" aria-labelledby="ios-tab">
          <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="ios-over-tab" data-toggle="tab" href="#ios-over" role="tab" aria-controls="ios-over" aria-selected="true">
                IOS 만료</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="ios-stay-tab" data-toggle="tab" href="#ios-stay" role="tab" aria-controls="ios-stay" aria-selected="false">
                IOS 만료예정</a>
            </li>
          </ul>
          <div class="tab-content" id="tab-depth2-content">
            <div class="tab-pane fade show active" id="ios-over" role="tabpanel" aria-labelledby="ios-over-tab">
              <!-- 탭1-1 -->
                  <div v-for="val in expiredIos" class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                          {{ val.app_name }}<br><span class="badge badge-pink">{{ val.ios_dev_exp }}</span>
                          {{ val.ios_dev_exp }}
                      </div>
                  </div>
            </div>
            <div class="tab-pane fade" id="ios-stay" role="tabpanel" aria-labelledby="ios-stay-tab">
              <!-- 탭1-2 -->
                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:10rem;vertical-align:middle;">
                      </div>
                  </div>
            </div>
          </div>
        </div>
        <!-- 탭1 End -->

        <!-- 탭2 -->
        <div class="tab-pane fade" id="push" role="tabpanel" aria-labelledby="push-tab">
          <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="push-over-tab" data-toggle="tab" href="#push-over" role="tab" aria-controls="push-over" aria-selected="true">
                PUSH 인증서 만료</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="push-stay-tab" data-toggle="tab" href="#push-stay" role="tab" aria-controls="push-stay" aria-selected="false">
                PUSH 인증서 만료예정</a>
            </li>
          </ul>
          <div class="tab-content" id="tab-depth2-content">
            <div class="tab-pane fade show active" id="push-over" role="tabpanel" aria-labelledby="push-over-tab">
              <!-- 탭2-1 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
            <div class="tab-pane fade" id="push-stay" role="tabpanel" aria-labelledby="push-stay-tab">
              <!-- 탭2-2 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
          </div>
        </div>
        <!-- 탭2 End -->

        <!-- 탭3 -->
        <div class="tab-pane fade" id="ma" role="tabpanel" aria-labelledby="ma-tab">
          <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="ma-over-tab" data-toggle="tab" href="#ma-over" role="tab" aria-controls="ma-over" aria-selected="true">
                MA 인증서 만료</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="ma-stay-tab" data-toggle="tab" href="#ma-stay" role="tab" aria-controls="ma-stay" aria-selected="false">
                MA 인증서 만료예정</a>
            </li>
          </ul>
          <div class="tab-content" id="tab-depth2-content">
            <div class="tab-pane fade show active" id="ma-over" role="tabpanel" aria-labelledby="ma-over-tab">
              <!-- 탭3-1 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
            <div class="tab-pane fade" id="ma-stay" role="tabpanel" aria-labelledby="ma-stay-tab">
              <!-- 탭3-2 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
          </div>
        </div>
        <!-- 탭3 End -->

        <!-- 탭4 -->
        <div class="tab-pane fade" id="apps" role="tabpanel" aria-labelledby="apps-tab">
          <ul class="nav nav-tabs" id="tab-depth2" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="apps-over-tab" data-toggle="tab" href="#apps-over" role="tab" aria-controls="apps-over" aria-selected="true">
                앱서비스 만료</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="apps-stay-tab" data-toggle="tab" href="#apps-stay" role="tab" aria-controls="apps-stay" aria-selected="false">
                앱서비스 만료예정</a>
            </li>
          </ul>
          <div class="tab-content" id="tab-depth2-content">
            <div class="tab-pane fade show active" id="apps-over" role="tabpanel" aria-labelledby="apps-over-tab">
              <!-- 탭4-1 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
            <div class="tab-pane fade" id="apps-stay" role="tabpanel" aria-labelledby="apps-stay-tab">
              <!-- 탭4-2 -->

                  <div class="card col-xs-12 col-md-5 col-lg-2 m-1 p-0 d-inline-block">
                      <div class="mx-0 p-2 text-truncate" style="width:8rem;vertical-align:middle;">

                      </div>
                  </div>

            </div>
          </div>
        </div>
        <!-- 탭4 End -->

      </div>

  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      expiredIos: [{}],
    }
  },
  created() {
    this.expiredIos = this.getExpiredIosData();
    console.log("expired here");
  },
  methods: {
    // getExpiredIosData: function() {
    //   axios.post('/expired')
    //   .then(response => {
    //       this.expiredIos = response.data;
    //   });
    // }
    getExpiredIosData() {
      axios({
        method: 'POST',
        url: '/expired'
      }).then(
        response => {
          return response.data
          //this.expiredIos = response.data
        },
        error => {
          console.log(error)
        }
      )
    },
  },
}
</script>
