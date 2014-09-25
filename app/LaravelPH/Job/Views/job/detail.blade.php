@extends('layouts.master')

@section('content')

    <h3>Jobs Detail View</h3>

    <h3>{{ $job->title }}</h3>
    <p>{{ $job->description }}</p>
    <p>{{ $job->author->username }}</p>

@stop