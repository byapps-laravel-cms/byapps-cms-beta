<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// 결제 관리
Breadcrumbs::for('pay', function ($trail) {
    $trail->push('결제 관리', route('paylist.view'));
});

// Home > 결제 관리
Breadcrumbs::for('paylist', function ($trail) {
    $trail->parent('pay');
    $trail->push('결제 상세', route('paylist'));
});

// Home > 결제 관리 > 프로모션
Breadcrumbs::for('promo', function ($trail) {
    $trail->parent('pay');
    $trail->push('프로모션', route('promo'));
});
