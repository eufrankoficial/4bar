<?php


/**
 * Beer type
 */
Breadcrumbs::for('cold_chamber.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Stock Cold Chambers'), route('cold_chamber.index'));
});


Breadcrumbs::for('cold_chamber.add', function ($breadcrumb) {
    $breadcrumb->parent('cold_chamber.index');
    $breadcrumb->push(__('New'), route('cold_chamber.add'));
});

Breadcrumbs::for('cold_chamber.edit', function ($breadcrumb, $coldChamber) {
    $breadcrumb->parent('cold_chamber.index');
    $breadcrumb->push($coldChamber->name, route('cold_chamber.edit', $coldChamber->slug));
});
