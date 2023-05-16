<?php

/**
 * Suupliers
 */
Breadcrumbs::for('kegs.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Kegs'), route('kegs.index'));
});

Breadcrumbs::for('kegs.add', function ($breadcrumb) {
    $breadcrumb->parent('kegs.index');
    $breadcrumb->push(__('New Keg'), route('kegs.add'));
});

Breadcrumbs::for('kegs.edit', function ($breadcrumb, $keg) {
    $breadcrumb->parent('kegs.index');
    $title = !empty($keg->name) ? $keg->name : $keg->beerType->name;
    $breadcrumb->push($keg->pin_keg . ' - ' . $title, route('kegs.edit', $keg));
});
