@extends('layouts.app')

@section('content')
<style>
    .soft-deleted {
        opacity: 0.5;
        background-color: #f8f9fa;
    }
</style>
<div class="d-flex justify-content-between mb-3">
    <h4>Audit Categories</h4>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">
        + Add Category
    </a>
</div>

<table class="table table-bordered" id="datatable">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th width="200">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($categories as $category)
        <tr class="{{ $category->trashed() ? 'soft-deleted' : '' }}">
            <td>{{ $loop->iteration }}</td>

            <td>{{ $category->name }}</td>

            <td>{{ $category->description ?? '-' }}</td>

            <td>
                @if($category->trashed())
                    {{-- Restore button --}}
                    <form action="{{ route('categories.restore', $category->id) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success">
                            Restore
                        </button>
                    </form>
                @else
                    {{-- Edit --}}
                    <a href="{{ route('categories.edit', $category) }}"
                       class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    {{-- Delete --}}
                    <form action="{{ route('categories.destroy', $category) }}"
                          method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this category?')"
                                class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
