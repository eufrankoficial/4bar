<?php

// Permissions
Breadcrumbs::for('users.permission.index', function ($breadcrumb) {
    $breadcrumb->parent('users.index');
    $breadcrumb->push(__('Permissions'), route('users.permission.index'));
});

Breadcrumbs::for('users.permission.add', function ($breadcrumb) {
    $breadcrumb->parent('users.permission.index');
    $breadcrumb->push(__('Add'), route('users.permission.add'));
});

Breadcrumbs::for('users.permission.edit', function ($breadcrumb, $permission) {
    $breadcrumb->parent('users.permission.index');
    $breadcrumb->push($permission->name, route('users.permission.edit', $permission->name));
});
