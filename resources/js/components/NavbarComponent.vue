<template>

  <div class="topbar-main navbar m-b-0 b-0">
    <div class="container-fluid">

        <!-- LOGO -->
        <div class="logo-box topbar-left">
            <a href="/" class="logo">
                <img src="{{ asset('byapps_logo_b_1.gif') }}" alt="logo" height="40">
            </a>
        </div>
        <!-- End Logo container-->

        <div class="menu-extras">
            <ul class="nav navbar-right list-inline">

                <li class="d-none d-sm-inline-block list-inline-item">
                    <form role="search" class="app-search" action="search" method="get">
                        <input type="text" placeholder="Search..." class="form-control" name="q">
                        <a href=""><i class="fa fa-search"></i></a>
                    </form>
                </li>

                @if (Route::has('login'))
                  @auth
                <li class="list-inline-item user-box mt-3">
                    <img data-name="{{ Auth::user()->name }}" class="profile" />
                </li>

                <li class="list-inline-item user-box">

                    <a class="nav-link dropdown-toggle waves-effect user-link" data-toggle="dropdown" href="#" aria-haspopup="false" aria-expanded="true">
                        <i class="fi-ellipsis rounded-circle user-img text-white" style="font-size:2.5em;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class=" mdi mdi-bell-ring-outline"></i>
                            <span>알림허용</span>
                        </a>

                        <!-- item-->
                        <a href="http://innotiveinc.co.kr/desk/" class="dropdown-item">
                            <i class="mdi mdi-calendar-check"></i>
                            <span>이노팸</span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a class="dropdown-item notify-item" href="{{ route('logout') }}">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>로그아웃</span>
                        </a>

                        @else
                        <a class="dropdown-item notify-item" href="{{ route('login') }}">
                            <i class="mdi mdi-logout-variant"></i>
                            <span>로그인</span>
                        </a>

                    </div>
                </li>
                  @endauth
                @endif
            </ul>

            <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

    </div>
  </div>

  <div class="navbar-custom">
      <div class="container-fluid">
          <div id="navigation">
              <!-- Navigation Menu-->
              <ul class="navigation-menu">
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-credit-card"></i>
                          결제 관리
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                                  <li><a href="paylist">결제 관리</a></li>
                                  <li><a href="paypromoList">프로모션</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-android"></i>
                          앱 관리
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                                  <li><a href="#sub">앱 접수</a></li>
                                  <li><a href="updateList">업데이트 관리</a></li>
                                  <li><a href="apkList">APK 관리</a></li>
                                  <li><a href="appsList">앱 목록</a></li>
                                  <li><a href="pushList">푸쉬 현황</a></li>
                                  <li><a href="newsList">소식 관리</a></li>
                                  <li><a href="membersList">인증회원 관리</a></li>
                                  <li><a href="#">앱 포인트 관리</a></li>
                                  <li><a href="#">테스터</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-loupe"></i>
                          부가서비스
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                                  <li><a href="#">부가서비스 접수</a></li>
                                  <li><a href="#">MA 이용 업체</a></li>
                                  <li><a href="#">프리미엄 서비스</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-chart-bar"></i>
                          통계
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                                  <li><a href="#">앱 설치 통계</a></li>
                                  <li><a href="#">앱 이용 통계</a></li>
                                  <li><a href="#">앱 매출 통계</a></li>
                                  <li><a href="#">푸쉬 허용 통계</a></li>
                                  <li><a href="#">리타게팅 푸쉬 통계</a></li>
                                  <li><a href="#">부가서비스 매출 통계</a></li>
                                  <li><a href="#">프리미엄 통계</a></li>
                                  <li><a href="#">통계 매출</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-account"></i>
                          회원 관리
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                                  <li><a href="usersList">회원 정보</a>
                                  <li><a href="#">회원 문의</a></li>
                                  <li><a href="#">비회원 문의</a></li>
                                  <div class="dropdown-divider"></div>
                                  <li><a href="#">제휴 광고상담 관리</a></li>
                                  <li><a href="#">터틀체인</a></li>
                                  <li><a href="#">리타쿠</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-account-multiple"></i>
                          리셀러
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                              <li><a href="#">리셀러 정보</a></li>
                              <li><a href="#">리셀러 정산</a></li>
                              <li><a href="#">리셀러 방문 통계</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-worker"></i>
                          관리자
                      </a>
                      <ul class="submenu megamenu">
                          <li>
                              <ul>
                              <li><a href="#">앱 템플릿</a></li>
                              <li><a href="#">앱 카테고리</a></li>
                              <li><a href="#">공지사항</a></li>
                              <li><a href="#">팝업 관리</a></li>
                              <li><a href="#">SMS 관리</a></li>
                              <li><a href="#">CMS 관리</a></li>
                              </ul>
                          </li>
                      </ul>
                  </li>
                  <li id="page_history" class="has-submenu">
                      <a href="#">
                          <i class="mdi mdi-worker"></i>
                          히스토리
                      </a>
                      <ul class="submenu megamenu">
                      </ul>
                  </li>
              </ul>
              <!-- End navigation menu  -->
              <div class="clearfix"></div>
          </div>
          <!-- end #navigation -->
      </div>
      <!-- end container -->
  </div>

</template>

<script>
export default {
  data() {
    return {
    }
  },
  mounted() {
    console.log('Navbar Component mounted.')
  },
}
</script>
