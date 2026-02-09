<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AuditCategory;
use App\Models\AuditCheckpoint;

class AuditCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Code Quality' => [
                'Folder structure follows standards',
                'Proper naming conventions used',
                'Code duplication avoided',
                'Readable and well-formatted code',
                'Comments and documentation present',
            ],
            'Security' => [
                'Input validation implemented',
                'Authentication & authorization enforced',
                'Sensitive data encrypted',
                'No hardcoded credentials',
                'Protection against SQL Injection / XSS',
            ],
            'Performance' => [
                'Database queries optimized',
                'Caching used where applicable',
                'No unnecessary loops or heavy operations',
                'Assets optimized',
            ],
            'Documentation' => [
                'README available',
                'API documentation present',
                'Setup instructions clear',
            ],
            'Testing' => [
                'Unit tests written',
                'Critical flows tested',
                'Test coverage acceptable',
            ],
        ];

        foreach ($categories as $categoryName => $checkpoints) {
            $category = AuditCategory::create([
                'name' => $categoryName,
                'description' => $categoryName . ' related audit checks',
            ]);
        
            foreach ($checkpoints as $checkpoint) {
                AuditCheckpoint::create([
                    'audit_category_id' => $category->id,
                    'title' => $checkpoint,
                ]);
            }
        }
    }
}