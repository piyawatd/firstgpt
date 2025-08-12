@extends('layouts.app')

@section('title', 'Tag Detail')

@section('content')
    <h1 class="h3 mb-4">Tag Detail</h1>

    <p><strong>Name:</strong> {{ $tag->name }}</p>

    <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
@endsection
