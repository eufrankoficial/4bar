<?php

/**
 * Suupliers
 */
Breadcrumbs::for('supplier.index', function ($breadcrumb) {
    $breadcrumb->parent('dashboard.index');
    $breadcrumb->push(__('Suppliers'), route('supplier.index'));
});

Breadcrumbs::for('supplier.add', function ($breadcrumb) {
    $breadcrumb->parent('supplier.index');
    $breadcrumb->push(__('New Supplier'), route('supplier.add'));
});

Breadcrumbs::for('supplier.edit', function ($breadcrumb, $supplier) {
    $breadcrumb->parent('supplier.index');
    $breadcrumb->push($supplier->name, route('supplier.edit', $supplier->slug));
});
