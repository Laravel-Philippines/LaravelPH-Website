@extends('layouts.master')

@section('content')

    <h3>Sign Up</h3>

    @include('partials/form-errors')

    <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="username" type="text" placeholder="Username">
        <input name="email" type="email" placeholder="Email address">
        <input name="password" type="password" value="" placeholder="Password">
        <input name="password_confirmation" type="password" placeholder="Confirm password">
        <input type="submit" value="Sign up">
    </form>

@stop