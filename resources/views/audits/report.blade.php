@extends('layouts.app')

@section('content')
<h2>Audit Report </h2>
    <h3>Project Name - {{ $audit->project->name }}</h3>

@foreach($results as $category => $items)
    <h4 class="mt-4">{{ $category }}</h4>

    <table class="table table-bordered">
    <tr>
        <th>S.NO.</th>
        <th>Category</th>
        <th>Checkpoint</th>
        <th>Status</th>
        <th>Severity</th>
        <th>Remarks</th>
    </tr>

    @foreach($items as $result)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>
            {{ $result->checkpoint->category->name ?? 'Uncategorized' }}
        </td>

        <td>{{ $result->checkpoint->title ?? 'NA' }}</td>

        <td>
            <span class="badge bg-{{ $result->status == 'fail' ? 'danger' : 'success' }}">
                {{ strtoupper($result->status ?? '-') }}
            </span>
        </td>

        <td>{{ $result->severity ?? '-' }}</td>
        <td>{{ $result->remarks ?? '-' }}</td>
    </tr>
    @endforeach
</table>
@endforeach
@endsection