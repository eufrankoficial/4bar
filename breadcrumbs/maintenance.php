<?php


/**
 * Beer type
 */
Breadcrumbs::for('maintenance.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Maintenance'), route('maintenance.index'));
});


Breadcrumbs::for('maintenance.add', function ($breadcrumb) {
    $breadcrumb->parent('maintenance.index');
    $breadcrumb->push(__('New maintenance'), route('maintenance.add'));
});

Breadcrumbs::for('maintenance.edit', function ($breadcrumb, $maintenance) {
    $breadcrumb->parent('maintenance.index');
    $breadcrumb->push($maintenance->name, route('$maintenance.edit', $maintenance->slug));
});
