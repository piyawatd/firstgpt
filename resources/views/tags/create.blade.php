@extends('layouts.app')

@section('title', 'Create Tag')

@section('content')
    <h1 class="h3 mb-4">Create Tag</h1>

    <form method="POST" action="{{ route('tags.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-primary">Save</button>
        <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
