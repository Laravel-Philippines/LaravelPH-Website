@extends('layouts.master')

@section('content')

    <h3>Jobs list</h3>

    @include('partials/form-errors')

    <ul>
        @foreach($jobs as $job)
            <li>
                <h3>{{ $job->title }}</h3>
                <p>{{ $job->description }}</p>
                <p>{{ $job->author->username }}</p>
            </li>
        @endforeach
    </ul>

@stop