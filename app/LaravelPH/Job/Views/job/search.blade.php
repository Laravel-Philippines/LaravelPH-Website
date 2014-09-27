@extends('layouts.master')

@section('content')

    @include('Job::partials.search-form')

    <h3>Search results</h3>

    @if($jobs->count())
        <ul>
            @foreach($jobs as $job)
                <li>
                    <h3>{{{ $job->title }}}</h3>
                    <p>{{{ $job->author->username }}}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>No job matches your query.</p>
    @endif

    {{ $jobs->links() }}

@stop