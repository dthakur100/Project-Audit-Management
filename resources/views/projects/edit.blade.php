@extends('layouts.app')

@section('content')
<h3>Edit Project</h3>

<form method="POST" action="{{ route('projects.update', $project) }}">
    @csrf @method('PUT')

    <div class="mb-3">
        <label>Project Name</label>
        <input name="name" value="{{ $project->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Client Name</label>
        <input name="client_name" value="{{ $project->client_name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Technology Stack</label>
        <input name="technology_stack" value="{{ $project->technology_stack }}" class="form-control">
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection