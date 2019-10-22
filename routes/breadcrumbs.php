<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// 결제 관리
Breadcrumbs::for('paylist', function ($trail) {
    $trail->push('결제 관리', route('paylist.view'));
});

// 결제 관리 > 결제 상세
Breadcrumbs::for('paydetail', function ($trail) {
    $trail->parent('paylist');
    $trail->push('결제 상세', route('paylist'));
});

// 결제 관리 > 프로모션
Breadcrumbs::for('promolist', function ($trail) {
    $trail->parent('paylist');
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

// 앱 접수
Breadcrumbs::for('appsorderlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('앱 접수', route('appsorderlist.view'));
});

// 업데이트 관리
Breadcrumbs::for('updatelist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('업데이트 관리', route('updatelist.view'));
});

// APK 관리
Breadcrumbs::for('apklist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('APK 관리', route('apklist.view'));
});

// APK 관리
Breadcrumbs::for('pushlist', function ($trail) {
  $trail->parent('appslist');
  $trail->push('PUSH 현황', route('pushlist.view'));
});
