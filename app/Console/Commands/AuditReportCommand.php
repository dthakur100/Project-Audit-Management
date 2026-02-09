<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AuditReportCommand extends Command
{
    protected $signature = 'audit:report {auditId}';
    protected $description = 'Show audit report in console';

    public function handle()
    {
        $auditId = $this->argument('auditId');

        $results = AuditResult::with('checkpoint')
            ->where('audit_id', $auditId)
            ->get();

        foreach ($results as $result) {
            $this->info(
                "{$result->checkpoint->title} | {$result->status} | {$result->severity}"
            );
        }
    }
}
