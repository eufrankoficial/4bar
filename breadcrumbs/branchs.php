<?php

//Branchs
Breadcrumbs::for('orgs.branchs.index', function ($breadcrumb, $organization) {
    $breadcrumb->parent('orgs.edit', $organization);
    $breadcrumb->push(__('Branchs'), route('orgs.branchs.index', $organization->slug));
});

Breadcrumbs::for('orgs.branchs.add', function ($breadcrumb, $organization) {
    $breadcrumb->parent('orgs.branchs.index', $organization);
    $breadcrumb->push(__('Add new'), route('orgs.branchs.add', $organization->slug));
});

Breadcrumbs::for('orgs.branchs.edit', function ($breadcrumb, $organization, $branch) {
    $breadcrumb->parent('orgs.branchs.index', $organization);
    $breadcrumb->push($branch->name, route('orgs.branchs.edit', [$organization->slug, $branch->slug]));
});

//Branchs
Breadcrumbs::for('branchs.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Branchs'), route('branchs.index'));
});

Breadcrumbs::for('branchs.add', function ($breadcrumb) {
    $breadcrumb->parent('branchs.index');
    $breadcrumb->push(__('Add new'), route('branchs.add'));
});

Breadcrumbs::for('branchs.edit', function ($breadcrumb, $branch) {
    $breadcrumb->parent('branchs.index');
    $breadcrumb->push($branch->name, route('branchs.edit', $branch->slug));
});
