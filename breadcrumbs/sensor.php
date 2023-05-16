<?php


/**
 * Sensor
 */
Breadcrumbs::for('sensors.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Sensors'), route('sensors.index'));
});


Breadcrumbs::for('sensors.add', function ($breadcrumb) {
    $breadcrumb->parent('sensors.index');
    $breadcrumb->push(__('New sensor'), route('sensors.add'));
});

Breadcrumbs::for('sensors.edit', function ($breadcrumb, $sensor) {
    $breadcrumb->parent('sensors.index');
    $breadcrumb->push($sensor->name, route('sensors.edit', $sensor->slug));
});
