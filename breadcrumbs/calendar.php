<?php

/**
 * Calendars
 */
Breadcrumbs::for('orgs.branchs.calendar.index', function ($breadcrumb, $organization, $branch) {
    $breadcrumb->parent('orgs.branchs.index', $organization);
    $breadcrumb->push(__('Calendar'), route('orgs.branchs.calendar.index', [$organization, $branch]));
});


Breadcrumbs::for('orgs.branchs.calendar.add', function ($breadcrumb, $organization, $branch) {
    $breadcrumb->parent('orgs.branchs.index', $organization);
    $breadcrumb->push(__('New'), route('orgs.branchs.calendar.add', [$organization, $branch]));
});

Breadcrumbs::for('orgs.branchs.calendar.edit', function ($breadcrumb, $organization, $branch, $calendar) {
    $breadcrumb->parent('orgs.branchs.index', $organization);
    $breadcrumb->push(__('Edit'), route('orgs.branchs.calendar.edit', [$organization, $branch, $calendar]));
});
