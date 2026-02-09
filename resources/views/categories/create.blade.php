@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card project-card">

                <!-- Header -->
                <div class="card-header project-header text-center">
                    <h4 class="mb-0">Create Category</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input name="name"
                                   class="form-control"
                                   placeholder="Security, Code Quality"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Describe this audit category..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('categories.index') }}"
                               class="btn btn-outline-secondary px-4">
                                Back
                            </a>

                            <button class="btn btn-primary px-4">
                                Save Category
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
