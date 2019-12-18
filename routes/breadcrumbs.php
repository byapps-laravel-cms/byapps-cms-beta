<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// 결제 관리
Breadcrumbs::for('appspaylist', function ($trail) {
    $trail->push('결제 관리', route('appspaylist.view'));
});

// 결제 관리 > 결제 상세
Breadcrumbs::for('appspaydetail', function ($trail) {
    $trail->parent('appspaylist');
    $trail->push('결제 상세', route('appspaylist'));
});

// 결제 관리 > 프로모션
Breadcrumbs::for('promolist', function ($trail) {
    $trail->parent('appspaylist');
    $trail->push('프로모션', route('promolist.view'));
});

// 결제 관리 > 프로모션 > 프로모션 상세
Breadcrumbs::for('promodetail', function ($trail) {
    $trail->parent('promolist');
    $trail->push('프로모션 상세', route('promolist'));
});

// 앱 관리(앱 목록)
Breadcrumbs::for('appslist', function ($trail) {
  $trail->push('앱 관리', route('appslist.view'));
});

// 앱 관리 > 앱 상세
Breadcrumbs::for('appdetail', function ($trail) {
  $trail->parent('appslist');
  $trail->title('\App\AppsData','app_name');
  $trail->push('앱 상세','');
});

// 앱 접수
Breadcrumbs::for('appsorderlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('앱 접수', route('appsorderlist.view'));
});

// 앱 접수 상세
Breadcrumbs::for('appsorderdetail', function ($trail) {
  $trail->parent('appsorderlist');
  $trail->title('\App\AppsOrderData','app_name');
  $trail->push('앱 접수 상세','');
});

// 업데이트 관리
Breadcrumbs::for('appsupdatelist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('업데이트 관리', route('appsupdatelist.view'));
});

// APK 관리
Breadcrumbs::for('apklist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('APK 관리', route('apklist.view'));
});

// CAFE24 앱 설치
Breadcrumbs::for('cafe24tokenlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('CAFE24 앱 설치', route('cafe24tokenlist.view'));
});

// Push 현황
Breadcrumbs::for('pushlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('PUSH 현황', route('pushlist.view'));
});

// 소식 관리
Breadcrumbs::for('pushnewslist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('소식 관리', route('pushnewslist.view'));
});

// 인증회원 관리
Breadcrumbs::for('appspointmemberlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('인증회원 관리', route('appspointmemberlist.view'));
});

// 앱포인트 관리
Breadcrumbs::for('appspointlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('앱포인트 관리', route('appspointlist.view'));
});

// 테스터 관리
Breadcrumbs::for('pushtesterlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('테스터 관리', route('pushtesterlist.view'));
});

// 부가서비스
Breadcrumbs::for('appendixlist', function ($trail) {
  $trail->push('부가서비스', route('appendixorderlist.view'));
});

// 부가서비스 접수
Breadcrumbs::for('appendixorderlist', function ($trail) {
  $trail->parent('appendixlist');
  $trail->push('부가서비스 접수', route('appendixorderlist.view'));
});

// MA 이용 업체
Breadcrumbs::for('malist', function ($trail) {
  $trail->parent('appendixlist');
  $trail->push('MA 이용 업체', route('malist.view'));
});

// MA 상세
Breadcrumbs::for('madetail', function ($trail) {
  $trail->parent('malist');
  $trail->title('\App\MaData','app_name');
  $trail->push('MA 상세','');
});

// 통계
Breadcrumbs::for('statlist', function ($trail) {
  $trail->push('통계', route('appsdownstatlist.view'));
});

// 앱 설치 통계
Breadcrumbs::for('appsdownstatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 설치 통계', route('appsdownstatlist.view'));
});

// 앱 이용 통계
Breadcrumbs::for('appsstatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 이용 통계', route('appsstatlist.view'));
});

// 앱 매출 통계
Breadcrumbs::for('appssalestatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('앱 매출 통계', route('appssalestatlist.view'));
});

// 푸쉬 허용 통계
Breadcrumbs::for('pushonoffstatlist', function ($trail) {
  $trail->parent('statlist');
  $trail->push('푸쉬 허용 통계', route('pushonoffstatlist.view'));
});

// 고객사 관리(회원 정보)
Breadcrumbs::for('userlist', function ($trail) {
  $trail->push('고객사 관리', route('userinfolist.view'));
});

// 고객 정보
Breadcrumbs::for('userinfolist', function ($trail) {
  $trail->parent('userlist');
  $trail->push('고객 정보', route('userinfolist.view'));
});

// 고객 정보 상세
Breadcrumbs::for('userinfodetail', function ($trail) {
  $trail->parent('userinfolist');
  $trail->push('고객 정보 상세', route('userinfolist'));
});

// 고객 문의(구 1:1 문의)
Breadcrumbs::for('qnamemberlist', function ($trail) {
  $trail->parent('userlist');
  $trail->push('고객 문의', route('qnamemberlist.view'));
});

// 고객 문의 상세
Breadcrumbs::for('qnamemberdetail', function ($trail) {
  $trail->parent('qnamemberlist');
  $trail->push('고객 문의 상세', route('userinfolist'));
});

// 비고객 문의(비회원 문의) -> (구 홈페이지 문의)
Breadcrumbs::for('qnanonmemberlist', function ($trail) {
  $trail->parent('userlist');
  $trail->push('비고객 문의', route('qnanonmemberlist.view'));
});

// 비고객 문의 상세
Breadcrumbs::for('qnanonmemberdetail', function ($trail) {
  $trail->parent('qnanonmemberlist');
  $trail->push('비고객 문의 상세', route('userinfolist'));
});

// 리셀러 관리
Breadcrumbs::for('resellerlist', function ($trail) {
  $trail->push('리셀러 관리', route('resellerinfolist.view'));
});

// 리셀러 정보
Breadcrumbs::for('resellerinfolist', function ($trail) {
  $trail->parent('resellerlist');
  $trail->push('리셀러 정보', route('resellerinfolist.view'));
});

// 리셀러 정보 상세
Breadcrumbs::for('resellerinfodetail', function ($trail) {
  $trail->parent('resellerinfolist');
  $trail->push('리셀러 상세', route('resellerinfolist'));
});

// 리셀러 정산
Breadcrumbs::for('resellerpaymentlist', function ($trail) {
  $trail->parent('resellerlist');
  $trail->push('리셀러 정산', route('resellerpaymentlist.view'));
});

//관리자
Breadcrumbs::for('admin', function ($trail) {
  $trail->push('관리자', route('adminlist'));
});

//관리자 관리
Breadcrumbs::for('adminlist', function ($trail) {
  $trail->parent('admin');
  $trail->push('관리자 관리', route('adminlist'));
});
