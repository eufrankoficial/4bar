<?php

Breadcrumbs::for('dashboard.index', function ($breadcrumb) {
    $breadcrumb->push(__('Home'), route('dashboard.index'));
});
