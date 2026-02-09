<?php

namespace App\Exports;

use App\Models\AuditResult;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


class AuditReportExport implements FromCollection, WithHeadings,ShouldAutoSize
{
    protected $projectId;

    public function __construct($projectId)
    {
        $this->projectId = $projectId;
        $this->projectName = Project::find($projectId)?->name ??'Unknown Project';
    }

    // public function collection()
    // {
    //     return AuditResult::where('audit_id', $this->projectId)
    //         ->with(['category', 'checkpoint'])
    //         ->get()
    //         ->map(function ($result) {
    //             return [
    //                 'Category' => $result->category->name ?? '',
    //                 'Checkpoint' => $result->checkpoint->name ?? '',
    //                 'Status' => $result->status,
    //                 'Remarks' => $result->remarks,
    //             ];
    //         });
    // }


//     public function collection()
// {
//     return AuditResult::whereHas('audit', function ($query) {
//             $query->where('project_id', $this->projectId);
//         })
//         ->with([
//             'checkpoint.category' => fn ($q) => $q->withTrashed(),
//             'audit'
//         ])
//         ->get()
//         ->map(function ($result) {
//             return [
//                 'Category'   => $result->checkpoint?->category?->name ?? 'NA',
//                 'Checkpoint' => $result->checkpoint?->title ?? 'Deleted Checkpoint',
//                 'Status'     => $result->status?? 'NA',
//                 'Remarks'    => $result->remarks ?? 'NA',
//                 'Audit Date' => $result->audit?->created_at?->format('d-m-Y'),
//             ];
//         });
// }

// public function collection()
// {
//     // Step 1: Get latest audit for this project
//     $latestAudit = \App\Models\Audit::where('project_id', $this->projectId)
//                         ->latest() // order by created_at desc
//                         ->first();

//     // If no audit found
//     if (!$latestAudit) {
//         return collect();
//     }

//     // Step 2: Get only results of latest audit
//     return AuditResult::where('audit_id', $latestAudit->id)
//         ->with([
//             'checkpoint.category' => fn ($q) => $q->withTrashed(),
//             'audit'
//         ])
//         ->get()
//         ->map(function ($result) {
//             return [
//                 'Category'   => $result->checkpoint?->category?->name ?? 'NA',
//                 'Checkpoint' => $result->checkpoint?->title ?? 'Deleted Checkpoint',
//                 'Status'     => $result->status ?? 'NA',
//                 'Remarks'    => $result->remarks ?? 'NA',
//                 'Audit Date' => $result->audit?->created_at?->format('d-m-Y'),
//             ];
//         });
// }

public function collection()
{
    return AuditResult::whereHas('audit', function ($query) {
            $query->where('project_id', $this->projectId);
        })
        ->with([
            'checkpoint.category' => fn ($q) => $q->withTrashed(),
            'audit'
        ])
        ->get()
        ->groupBy(function ($result) {
            return $result->checkpoint?->category?->id;
        })
        ->map(function ($results) {

            // get latest audit_id for this category
            $latestAuditId = $results->max('audit_id');

            return $results
                ->where('audit_id', $latestAuditId)
                ->map(function ($result) {
                    return [
                        'Category'   => $result->checkpoint?->category?->name ?? 'NA',
                        'Checkpoint' => $result->checkpoint?->title ?? 'Deleted Checkpoint',
                        'Status'     => $result->status ?? 'NA',
                        'Remarks'    => $result->remarks ?? 'NA',
                        'Audit Date' => $result->audit?->created_at?->format('d-m-Y'),
                    ];
                });
        })
        ->flatten(1); // flatten grouped structure
}




    public function headings(): array
    {
        return [
            ['Project Name: ' . $this->projectName],
            [], // empty row
            [],
            ['Category', 'Checkpoint', 'Status', 'Remarks', 'Audit Date']
        ];
    }

   
}
