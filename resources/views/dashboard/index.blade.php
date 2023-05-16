@extends('layouts.default', ['breadcrumb' => 'dashboard.index'])

    @section('content')
        @include('elements.taps.list', ['title' => __('Taps')])
        @include('elements.branchs.kegs', ['title' => __('Barrel stock')])

    @endsection
