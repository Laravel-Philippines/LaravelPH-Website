@extends('layouts.master')

@section('content')

    <h3>Post a job</h3>

    @include('partials/form-errors')

    <form method="POST" action="{{ route('jobs.store') }}" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="title" type="text" placeholder="Enter title" value="{{ Input::old('title') }}">
        <textarea name="description" placeholder="Enter description"></textarea>
        <input type="submit" value="Post job">
    </form>

@stop