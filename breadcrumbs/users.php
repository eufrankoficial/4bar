<?php

Breadcrumbs::for('users.index', function ($breadcrumb) {
    $breadcrumb->push(__('Users'), route('users.index'));
});

Breadcrumbs::for('users.add', function ($breadcrumb) {
    $breadcrumb->parent('users.index');
    $breadcrumb->push(__('Add new user'), route('users.add'));
});


Breadcrumbs::for('users.edit', function ($breadcrumb, $user) {
    $breadcrumb->parent('users.index');
    $breadcrumb->push($user->name, route('users.edit', $user->id));
});
