<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'project_id',
        'audit_date',
        'auditor_name',
        'summary',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function results()
    {
        return $this->hasMany(AuditResult::class);
    }
}
