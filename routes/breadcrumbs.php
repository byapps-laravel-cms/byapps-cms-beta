<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// 결제 관리
Breadcrumbs::for('paylist', function ($trail) {
    $trail->push('결제 관리', route('paylist.view'));
});

// Home > 결제 관리 > 결제 상세
Breadcrumbs::for('paydetail', function ($trail) {
    $trail->parent('paylist');
    $trail->push('결제 상세', route('paylist'));
});

// Home > 결제 관리 > 프로모션
Breadcrumbs::for('promolist', function ($trail) {
    $trail->parent('paylist');
    $trail->push('프로모션', route('promolist.view'));
});

// Home > 결제 관리 > 프로모션 > 프로모션 상세
Breadcrumbs::for('promodetail', function ($trail) {
    $trail->parent('promolist');
    $trail->push('프로모션 상세', route('promolist'));
});
