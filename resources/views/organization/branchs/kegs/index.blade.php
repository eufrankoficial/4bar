@extends('layouts.default',
    [
        'pageTitle' => __('Kegs'),
        'breadcrumb' => 'kegs.index',
        'addButton' => route('kegs.add'),
        'functionPermission' => 'userHasPermission',
        'permissions' => ['add']
    ])
    @section('content')
        @include('elements.branchs.kegs', ['kegs' => $kegs, 'pagination' => false])
    @endsection
