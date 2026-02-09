@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Page Header -->
    <div class="text-center mb-4">
        <h3 class="mb-1">Audit Checkpoints</h3>
        <p class="text-muted mb-0">Review each checkpoint and record audit results</p>
    </div>

    <form method="POST" action="{{ route('audits.save', $audit->id) }}">
        @csrf

        @foreach($checkpoints as $index => $checkpoint)
            <div class="card project-card mb-4">

                <!-- Checkpoint Header -->
                <div class="card-header bg-light">
                    <h6 class="mb-0 fw-semibold">
                        {{ $index + 1 }}. {{ $checkpoint->title }}
                    </h6>
                </div>

                <div class="card-body">

                    <!-- Status + Severity -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="results[{{ $checkpoint->id }}][status]"
                                    class="form-select"
                                    required>
                                <option value="">Select Status</option>
                                <option value="pass">Pass</option>
                                <option value="fail">Fail</option>
                                <option value="partial">Partial</option>
                                <option value="na">Not Applicable</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Severity</label>
                            <select name="results[{{ $checkpoint->id }}][severity]"
                                    class="form-select">
                                <option value="">Select Severity</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div>
                        <label class="form-label">Remarks</label>
                        <textarea
                            name="results[{{ $checkpoint->id }}][remarks]"
                            class="form-control"
                            rows="3"
                            placeholder="Add observations or comments (optional)"></textarea>
                    </div>

                </div>
            </div>
        @endforeach

        <!-- Submit -->
        <div class="text-center mt-4">
            <button class="btn btn-primary btn-lg px-5">
                Submit Audit
            </button>
        </div>

    </form>

</div>
@endsection
