@extends('layouts.auth', ['title' => 'Login'])
    @section('content')
        <login-component action="{{ route('login.post') }}" linkforgot="{{ route('forgot.password') }}"></login-component>
    @endsection


