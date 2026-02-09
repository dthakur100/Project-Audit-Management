<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditResult extends Model
{
    protected $fillable = [
        'audit_id',
        'audit_checkpoint_id',
        'status',
        'severity',
        'remarks',
    ];

    public function audit()
    {
        return $this->belongsTo(Audit::class);
    }

    // public function checkpoint()
    // {
    //     return $this->belongsTo(AuditCheckpoint::class);
    // }
    public function checkpoint()
    {
        return $this->belongsTo(AuditCheckpoint::class, 'audit_checkpoint_id')->withTrashed();
    }
}
