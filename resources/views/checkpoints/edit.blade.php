@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Checkpoint</h4>

    <form method="POST" action="{{ route('checkpoints.update', $checkpoint->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Category</label>
            <select name="audit_category_id" class="form-select" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $checkpoint->audit_category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Checkpoint Title</label>
            <input name="title"
                   value="{{ $checkpoint->title }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Checkpoint Description</label>
            <textarea name="description"
                      class="form-control">{{ $checkpoint->description }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('checkpoints.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
