<?php

namespace App\Exports;

use App\Models\AuditResult;
use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;



class AuditReportExport implements FromCollection, WithHeadings,ShouldAutoSize, WithEvents
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
            ['Category', 'Checkpoint', 'Status', 'Remarks', 'Audit Date']
        ];
    }

    public function registerEvents():array{
        return [
            AfterSheet::class => function(AfterSheet $event){
                $cellRange= 'A1:E1'; //project Heading
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(18)->setBold(true);
                $event->sheet->getDelegate()->getStyle('A2:E2')->getFont()->setSize(15)->setBold(true);
                $event->sheet->getDelegate()->mergeCells('A1:E1');
                $event->sheet->getDelegate()->getStyle('A1:E100')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                //background color 
                $event->sheet->getDelegate()->getStyle('A1:E1')->getFill()->setFillType(FILL::FILL_SOLID)->getStartColor()->setARGB('ADD8E6');
                //Border 
                $event->sheet->getDelegate()->getStyle('A1:E1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);


                $lastRow = $event->sheet->getDelegate()->getHighestRow();
                $lastColumn = $event->sheet->getDelegate()->getHighestColumn();
                //Apply border from A2 to last COlumn
                $event->sheet->getDelegate()->getStyle('A2:'.$lastColumn .$lastRow)
                ->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

                $sheet = $event->sheet->getDelegate();
                
// CATEGORY → Green
$sheet->getStyle('A2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB('90EE90'); // Light Green


// CHECKPOINT → Yellow
$sheet->getStyle('B2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFFF00'); // Yellow


// STATUS → Pink
$sheet->getStyle('C2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB('FFC0CB'); // Pink


// REMARKS → Dark Blue
$sheet->getStyle('D2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB('F08080'); // Light Red


// AUDIT DATE → Grey
$sheet->getStyle('E2')->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()->setARGB('D3D3D3'); // Light Grey

            },
        ];
    }

   
}
