<?php


/**
 * Beer type
 */
Breadcrumbs::for('taps.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Taps'), route('taps.index'));
});


Breadcrumbs::for('taps.add', function ($breadcrumb) {
    $breadcrumb->parent('taps.index');
    $breadcrumb->push(__('New tap'), route('taps.add'));
});

Breadcrumbs::for('taps.edit', function ($breadcrumb, $tap) {
    $breadcrumb->parent('taps.index');
    $breadcrumb->push($tap->name, route('taps.edit', $tap->slug));
});
