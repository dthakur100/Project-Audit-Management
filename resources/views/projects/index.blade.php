@extends('layouts.app')

@section('content')
<style>
    /* ---------- Project Action Buttons ---------- */

.project-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;
    flex-wrap: nowrap;
}

.project-actions .action-form {
    margin: 0;
}

.project-actions .action-btn {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.4;
    border-radius: 6px;
    transition: all 0.2s ease;
}

.project-actions .action-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.12);
}

/* No-audit badge */
.project-actions .action-badge {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 12px;
    background-color: #e5e7eb;
    color: #6b7280;
}
.table td,
.table th {
    text-align: center;
    vertical-align: middle;
}
.table thead tr th{
    text-align: center;
    vertical-align: middle;
}

</style>
<div class="container py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Projects</h3>
            <div class="header-underline"></div>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('projects.create') }}" class="btn btn-primary btn-animated">
                + New Project
            </a>

            <a href="{{ route('audits.start') }}" class="btn btn-success btn-animated">
                Start Audit
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card project-card">
        <div class="card-body p-0">

            <table class="table align-middle mb-0" id="projectsTable">
                <thead class="table-light">
                    <tr>
                        <th width="60">#</th>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Tech Stack</th>
                        <th>Status</th>
                        <th width="260" class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($projects as $index => $project)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="fw-semibold">
                            {{ $project->name }}
                        </td>

                        <td>{{ $project->client_name }}</td>

                        <td>
                            <span class="badge bg-info-subtle text-dark">
                                {{ $project->technology_stack }}
                            </span>
                        </td>

                        <td>
                            <span class="badge bg-success-subtle text-success">
                                {{ ucfirst($project->status) }}
                            </span>
                        </td>

                       <td class="text-center">
    <div class="project-actions">

        <a href="{{ route('projects.edit', $project) }}"
           class="btn btn-sm btn-warning action-btn">
            Edit
        </a>

        <form action="{{ route('projects.destroy', $project) }}"
              method="POST" class="action-form">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger action-btn"
                    onclick="return confirm('Delete this project?')">
                Delete
            </button>
        </form>

        @php
            $latestAudit = $project->audits->first();
        @endphp

        @if($latestAudit)
            <a href="{{ route('audits.report.html', $latestAudit->id) }}"
               class="btn btn-sm btn-primary action-btn">
                Report
            </a>

            <a href="{{ route('audits.report.json', $latestAudit->id) }}"
               class="btn btn-sm btn-success action-btn">
                JSON
            </a>
        @else
            <span class="action-badge">No Audit</span>
        @endif

    </div>
</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#projectsTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
            responsive: true
        });
    });
</script>
@endpush
