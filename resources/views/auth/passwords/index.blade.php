@extends('layouts.auth', ['title' => __('Forgot Password')])
@section('content')
    <forgot-password action="{{ route('forgot.password.post') }}" login="{{ route('login') }}"></forgot-password>
@endsection
