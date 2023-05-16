<?php

/**
 * Suupliers
 */
Breadcrumbs::for('pins.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Pins kegs'), route('pins.index'));
});

Breadcrumbs::for('pins.add', function ($breadcrumb) {
    $breadcrumb->parent('pins.index');
    $breadcrumb->push(__('New pin'), route('pins.add'));
});

Breadcrumbs::for('pins.edit', function ($breadcrumb, $pin) {
    $breadcrumb->parent('pins.index');
    $breadcrumb->push($pin->pin, route('pins.edit', $pin));
});
