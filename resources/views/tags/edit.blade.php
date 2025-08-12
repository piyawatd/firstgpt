@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <h1 class="h3 mb-4">Edit Tag</h1>

    <form method="POST" action="{{ route('tags.update', $tag) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $tag->name }}" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
