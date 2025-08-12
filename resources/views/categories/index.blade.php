@extends('layouts.app')

@section('title', 'Categories')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Categories</h1>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>
<table class="table table-bordered" id="categories-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Sort Order</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ $category->sortorder }}</td>
            <td>
                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    $('#categories-table').DataTable();
});
</script>
@endpush
