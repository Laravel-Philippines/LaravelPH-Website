@extends('layouts.master')

@section('content')

    <h3>Sign Up</h3>

    @include('partials/form-errors')

    <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="username" type="text">
        <input name="email" type="email">
        <input name="password" type="password" value="">
        <input name="password_confirmation" type="password">
        <input type="submit" value="Sign up">
    </form>

@stop