@extends('layouts.app')

@section('content')

<style>

/* Header underline */
.header-underline {
    width: 90px;
    height: 5px;
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    border-radius: 4px;
}

/* Animated buttons */
.btn-animated {
    transition: all 0.25s ease;
}

.btn-animated:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
}

/* Table tweaks */
.table th {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
}

.table td {
    font-size: 14px;
}

/* Card already defined earlier */
.project-card {
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    border: none;
}
</style>
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Card -->
            <div class="card project-card">
                
                <!-- Header -->
                <div class="card-header project-header text-center">
                    <h4 class="mb-0">Create Project</h4>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Project Name</label>
                            <input name="name" class="form-control" placeholder="Project Alpha">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input name="client_name" class="form-control" placeholder="ABC Corp">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Technology Stack</label>
                            <input name="technology_stack" class="form-control" placeholder="Laravel, React">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-lg">
                                Save Project
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
