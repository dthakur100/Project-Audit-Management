@extends('layouts.app')

@section('content')
<h4>Edit Category</h4>

<form method="POST" action="{{ route('categories.update', $category) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control"
               value="{{ $category->name }}" required>
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ $category->description }}</textarea>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
