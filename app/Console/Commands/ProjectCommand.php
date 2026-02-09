<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;

class ProjectCommand extends Command
{
    protected $signature = 'project {action}';
    protected $description = 'Create or list projects';

    public function handle()
    {
        $action = $this->argument('action');

        if ($action === 'create') {
            $this->createProject();
        } elseif ($action === 'list') {
            $this->listProjects();
        } else {
            $this->error('Invalid action. Use create or list');
        }
    }

    private function createProject()
    {
        $name = $this->ask('Project name?');
        $client = $this->ask('Client name?');
        $tech = $this->ask('Technology stack?');
        $startDate = $this->ask('Start date (YYYY-MM-DD)?');

        Project::create([
            'name' => $name,
            'client_name' => $client,
            'technology_stack' => $tech,
            'start_date' => $startDate,
            'status' => 'active',
        ]);

        $this->info('✅ Project created successfully');
    }

    private function listProjects()
    {
        $projects = Project::all(['id', 'name', 'client_name', 'status']);

        if ($projects->isEmpty()) {
            $this->warn('No projects found.');
            return;
        }

        $this->table(
            ['ID', 'Name', 'Client', 'Status'],
            $projects->toArray()
        );
    }
}