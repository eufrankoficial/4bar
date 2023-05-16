<?php

// Organizations
Breadcrumbs::for('menu.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Menus'), route('menu.index'));
});

Breadcrumbs::for('menu.add', function ($breadcrumb) {
    $breadcrumb->parent('menu.index');
    $breadcrumb->push(__('Add'), route('menu.add'));
});

Breadcrumbs::for('menu.edit', function ($breadcrumb, $menu) {
    $breadcrumb->parent('menu.index');
    $breadcrumb->push($menu->menu, route('menu.edit', $menu->slug));
});
