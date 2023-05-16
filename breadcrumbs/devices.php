<?php


/**
 * Beer type
 */
Breadcrumbs::for('devices.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Devices'), route('devices.index'));
});


Breadcrumbs::for('devices.add', function ($breadcrumb) {
    $breadcrumb->parent('devices.index');
    $breadcrumb->push(__('New device'), route('devices.add'));
});

Breadcrumbs::for('devices.edit', function ($breadcrumb, $device) {
    $breadcrumb->parent('devices.index');
    $breadcrumb->push($device->name, route('devices.edit', $device->slug));
});
