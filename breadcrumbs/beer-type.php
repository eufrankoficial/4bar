<?php


/**
 * Beer type
 */
Breadcrumbs::for('beer_type.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Beer Type'), route('beer_type.index'));
});


Breadcrumbs::for('beer_type.add', function ($breadcrumb) {
    $breadcrumb->parent('beer_type.index');
    $breadcrumb->push(__('New type'), route('beer_type.add'));
});

Breadcrumbs::for('beer_type.edit', function ($breadcrumb, $beerType) {
    $breadcrumb->parent('beer_type.index');
    $breadcrumb->push($beerType->name, route('beer_type.edit', $beerType->slug));
});
