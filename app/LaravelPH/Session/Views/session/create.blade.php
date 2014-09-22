@extends('layouts.master')

@section('content')

    <h3>Sign In</h3>

    @include('partials/form-errors')

    <form method="POST" action="{{ route('sessions.store') }}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="username" type="text" placeholder="Enter username" value="{{ Input::old('username') }}">
        <input name="password" type="password" placeholder="Enter password" value="{{ Input::old('password') }}">
        <input type="submit" value="Sign In">
    </form>

@stop