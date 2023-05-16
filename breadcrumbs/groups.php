<?php

Breadcrumbs::for('users.group.index', function ($breadcrumb) {
    $breadcrumb->parent('users.index');
    $breadcrumb->push(__('Groups'), route('users.group.index'));
});

Breadcrumbs::for('users.group.add', function ($breadcrumb) {
    $breadcrumb->parent('users.group.index');
    $breadcrumb->push(__('Add'), route('users.group.add'));
});

Breadcrumbs::for('users.group.edit', function ($breadcrumb, $group) {
    $breadcrumb->parent('users.group.index');
    $breadcrumb->push($group->name, route('users.group.edit', $group->name));
});
