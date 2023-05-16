<?php

// Organizations
Breadcrumbs::for('orgs.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Organizations'), route('orgs.index'));
});

Breadcrumbs::for('orgs.add', function ($breadcrumb) {
    $breadcrumb->parent('orgs.index');
    $breadcrumb->push(__('Add'), route('orgs.add'));
});

Breadcrumbs::for('orgs.edit', function ($breadcrumb, $organization) {
    $breadcrumb->parent('orgs.index');
    $breadcrumb->push($organization->name, route('orgs.edit', $organization->slug));
});
