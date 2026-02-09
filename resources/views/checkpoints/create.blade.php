@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card project-card">

                <!-- Header -->
                <div class="card-header project-header text-center">
                    <h4 class="mb-0">Add Checkpoint</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('checkpoints.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select name="audit_category_id"
                                    class="form-select"
                                    required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Checkpoint Title</label>
                            <input name="title"
                                   class="form-control"
                                   placeholder="e.g. Input Validation"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Checkpoint Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Describe what needs to be checked..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('checkpoints.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Back
                            </a>

                            <button class="btn btn-primary px-4">
                                Save Checkpoint
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
