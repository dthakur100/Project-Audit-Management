@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Audit Checkpoints</h4>
        <a href="{{ route('checkpoints.create') }}" class="btn btn-primary">
            + Add Checkpoint
        </a>
    </div>

    <!-- Category Filter -->
    <form method="GET" class="mb-3">
        <select name="category_id"
                class="form-select w-25"
                onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Table Card -->
    <div class="card project-card">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">#</th>
                        <th>Category</th>
                        <th>Checkpoint</th>
                        <th>Description</th>
                        <th width="180" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($checkpoints as $index => $checkpoint)
                    <tr class="{{ $checkpoint->trashed() ? 'soft-deleted' : '' }}">

                        <!-- Serial number -->
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $checkpoint->category->name ?? '-' }}
                        </td>

                        <td class="fw-semibold">
                            {{ $checkpoint->title }}
                        </td>

                        <td class="text-muted">
                            {{ $checkpoint->description ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($checkpoint->trashed())
                                <form action="{{ route('checkpoints.restore', $checkpoint->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-success">
                                        Restore
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('checkpoints.edit', $checkpoint) }}"
                                   class="btn btn-sm btn-warning me-1">
                                    Edit
                                </a>

                                <form action="{{ route('checkpoints.destroy', $checkpoint) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Delete this checkpoint?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No checkpoints found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
