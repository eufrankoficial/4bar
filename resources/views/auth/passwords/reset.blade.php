@extends('layouts.auth', ['title' => __('Reset Password')])
    @section('content')
        <reset-password
            action="{{ route('password.reset', $token) }}"
            token="{{ $token }}"
            login="{{ route('login') }}"
            emailprop="{{ $email }}"
        ></reset-password>
    @endsection
