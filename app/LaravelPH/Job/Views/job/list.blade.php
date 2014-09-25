@extends('layouts.master')

@section('content')

    <h3>Jobs list</h3>

    @if(Auth::check())
        <a href="{{ route('jobs.create') }}">Post a job</a>
    @endif

    <ul>
        @foreach($jobs as $job)
            <li>
                <h3>{{ $job->title }}</h3>
                <p>{{ $job->description }}</p>
                <p>{{ $job->author->username }}</p>
            </li>
        @endforeach
    </ul>

    {{ $jobs->links() }}

@stop