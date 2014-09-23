@extends('layouts.master')

@section('content')

    <h1>Sign Up</h1>

    @include('partials/form-errors')

    {{ Form::open(['route' => 'users.store']) }}
        <div>{{ Form::text('username', '', ['class' => 'form-control', 'placeholder' => 'Username']) }}</div>
        <div>{{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'YourEmail@mailprovider.com']) }}</div>
        <div>{{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Your Unique Password']) }}</div>
        <div>{{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm your password']) }}</div>
        <div>{{ Form::submit('Sign Up', ['class' => 'form-control']) }}</div>
    {{ Form::close() }}

@stop