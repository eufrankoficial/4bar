<?php


/**
 * Beer type
 */
Breadcrumbs::for('sensor_type.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Sensor Type'), route('sensor_type.index'));
});


Breadcrumbs::for('sensor_type.add', function ($breadcrumb) {
    $breadcrumb->parent('sensor_type.index');
    $breadcrumb->push(__('New type'), route('sensor_type.add'));
});

Breadcrumbs::for('sensor_type.edit', function ($breadcrumb, $sensorType) {
    $breadcrumb->parent('sensor_type.index');
    $breadcrumb->push($sensorType->sensor_type_name, route('sensor_type.edit', $sensorType->slug));
});
