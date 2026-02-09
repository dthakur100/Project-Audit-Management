@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card project-card">

                <!-- Header -->
                <div class="card-header project-header text-center">
                    <h4 class="mb-0">Start New Audit</h4>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('audits.begin') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Select Project</label>
                            <select name="project_id"
                                    class="form-select js-example-basic-single"
                                    required>
                                <option value="">-- Select Project --</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">
                                        {{ $project->name }} ({{ $project->client_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Select Audit Category</label>
                            <select name="audit_category_id"
                                    class="form-select js-example-basic-single"
                                    required>
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">
                                Start Audit
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
            width: '100%'
        });
    });
</script>
@endpush
