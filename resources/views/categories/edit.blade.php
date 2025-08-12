@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Edit Category</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Sort Order</label>
        <input type="number" name="sortorder" class="form-control" value="{{ old('sortorder', $category->sortorder) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
