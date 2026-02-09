<?php

namespace App\Http\Controllers;
use App\Models\AuditResult;
use Illuminate\Http\Request;
use App\Models\Audit;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
    class AuditReportController extends Controller
{


// public function json(Audit $audit)
// {
//     $results = AuditResult::with(['checkpoint.category', 'audit'])
//         ->whereHas('audit', fn ($q) =>
//             $q->where('project_id', $audit->project_id)
//         )
//         ->orderByDesc('audit_id')
//         ->get()
//         ->groupBy(fn ($r) =>
//             $r->checkpoint?->category?->name ?? 'Uncategorized'
//         )
//         ->map(function ($items) {
//             $latestAuditId = $items->first()->audit_id;
//             return $items->where('audit_id', $latestAuditId);
//         });

//     return response()->json([
//         'project' => $audit->project->name,
//         'summary' => [
//             'total' => $results->flatten()->count(),
//             'pass' => $results->flatten()->where('status', 'pass')->count(),
//             'fail' => $results->flatten()->where('status', 'fail')->count(),
//         ],
//         'categories' => $results,
//     ]);
// }

public function json(Audit $audit)
{
    try {
        DB::beginTransaction();
        $results = AuditResult::with([
                'checkpoint' => fn ($q) => $q->withTrashed(),
                'checkpoint.category' => fn ($q) => $q->withTrashed(),
                'audit'
            ])
            ->whereHas('audit', fn ($q) =>
                $q->where('project_id', $audit->project_id)
            )
            ->orderByDesc('audit_id')
            ->get()
            ->groupBy(fn ($r) =>
                $r->checkpoint?->category?->name ?? 'Deleted Category'
            )
            ->map(function ($items) {
                $latestAuditId = $items->first()->audit_id;
                return $items->where('audit_id', $latestAuditId);
            });
            DB::commit();
        return response()->json([
            'project' => $audit->project->name,
            'summary' => [
                'total' => $results->flatten()->count(),
                'pass' => $results->flatten()->where('status', 'pass')->count(),
                'fail' => $results->flatten()->where('status', 'fail')->count(),
            ],
            'categories' => $results,
        ]);

    } catch (\Throwable $e) {
        DB::rollBack();
        // Log full error
        Log::error('Audit Report JSON Error', [
            'audit_id' => $audit->id,
            'message'  => $e->getMessage(),
            'file'     => $e->getFile(),
            'line'     => $e->getLine(),
        ]);

        // Safe response for frontend
        return response()->json([
            'message' => 'Something went wrong. Please try again later.'
        ], 500);
    }
}

public function html(Audit $audit)
{
    try {
        $results = AuditResult::with([
                'checkpoint' => fn ($q) => $q->withTrashed(),
                'checkpoint.category' => fn ($q) => $q->withTrashed(),
                'audit'
            ])
            ->whereHas('audit', fn ($q) =>
                $q->where('project_id', $audit->project_id)
            )
            ->orderByDesc('audit_id')
            ->get()
            ->groupBy(fn ($r) =>
                $r->checkpoint?->category?->name ?? 'Deleted Category'
            )
            ->map(function ($items) {
                $latestAuditId = $items->first()->audit_id;
                return $items->where('audit_id', $latestAuditId);
            });

        return view('audits.report', compact('audit', 'results'));

    } catch (\Throwable $e) {

        //  Log error
        Log::error('Audit Report HTML Error', [
            'audit_id' => $audit->id,
            'message'  => $e->getMessage(),
            'file'     => $e->getFile(),
            'line'     => $e->getLine(),
        ]);

        //  Frontend  UI message  
        return back()->with('error', 'Something went wrong. Please try again.');
    }
}

// public function html(Audit $audit)
// {
//     $results = AuditResult::with([
//             'checkpoint' => fn ($q) => $q->withTrashed(),
//             'checkpoint.category' => fn ($q) => $q->withTrashed(),
//             'audit'
//         ])
//         ->whereHas('audit', fn ($q) =>
//             $q->where('project_id', $audit->project_id)
//         )
//         ->orderByDesc('audit_id')
//         ->get()
//         ->groupBy(fn ($r) =>
//             $r->checkpoint?->category?->name ?? 'Deleted Category'
//         )
//         ->map(function ($items) {
//             $latestAuditId = $items->first()->audit_id;
//             return $items->where('audit_id', $latestAuditId);
//         });

//     return view('audits.report', compact('audit', 'results'));
// }




    //     public function html(Audit $audit)
    // {
    //         $results = AuditResult::with(['checkpoint.category'])
    //     ->where('audit_id', $audit->id)
    //     ->get()
    //     ->groupBy(fn ($r) =>
    //         $r->checkpoint?->category?->name ?? 'Uncategorized'
    //     );

    //         return view('audits.report', compact('audit', 'results'));
    // }

//     public function html(Audit $audit)
// {
//     $results = AuditResult::with(['checkpoint.category', 'audit'])
//         ->whereHas('audit', function ($q) use ($audit) {
//             $q->where('project_id', $audit->project_id);
//         })
//         ->get()
//         ->groupBy(fn ($r) =>
//             $r->checkpoint?->category?->name ?? 'Uncategorized'
//         )->latest();

//     return view('audits.report', compact('audit', 'results'));
// }

// public function html(Audit $audit)
// {
//     $results = AuditResult::with(['checkpoint.category', 'audit'])
//         ->whereHas('audit', fn ($q) =>
//             $q->where('project_id', $audit->project_id)
//         )
//         ->orderByDesc('audit_id') // latest audits first
//         ->get()
//         ->groupBy(fn ($r) =>
//             $r->checkpoint?->category?->name ?? 'Uncategorized'
//         )
//         ->map(function ($items) {
//             // take ONLY latest audit per category
//             $latestAuditId = $items->first()->audit_id;
//             return $items->where('audit_id', $latestAuditId);
//         });

//     return view('audits.report', compact('audit', 'results'));
// }


    // public function json(Audit $audit)
    // {
    //     $results = AuditResult::with(['checkpoint.category'])
    //         ->where('audit_id', $audit->id)
    //         ->get()
    //         ->groupBy('checkpoint.category.name');

    //     return response()->json([
    //         'project' => $audit->project->name,
    //         'audit_date' => $audit->created_at->toDateString(),
    //         'summary' => [
    //             'total' => $results->flatten()->count(),
    //             'pass' => $results->flatten()->where('status', 'pass')->count(),
    //             'fail' => $results->flatten()->where('status', 'fail')->count(),
    //         ],
    //         'categories' => $results,
    //     ]);
    // }

//     public function json(Audit $audit)
// {
//     $results = AuditResult::with(['checkpoint.category', 'audit'])
//         ->whereHas('audit', fn ($q) =>
//             $q->where('project_id', $audit->project_id)
//         )
//         ->get()
//         ->groupBy(fn ($r) =>
//             $r->checkpoint?->category?->name ?? 'Uncategorized'
//         );

//     return response()->json([
//         'project' => $audit->project->name,
//         'audit_date' => now()->toDateString(),
//         'summary' => [
//             'total' => $results->flatten()->count(),
//             'pass' => $results->flatten()->where('status', 'pass')->count(),
//             'fail' => $results->flatten()->where('status', 'fail')->count(),
//         ],
//         'categories' => $results,
//     ]);
// }
}

