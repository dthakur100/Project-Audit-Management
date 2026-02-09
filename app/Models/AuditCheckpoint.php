<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AuditCheckpoint extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'audit_category_id',
        'title',
        'description',
    ];

    // public function category()
    // {
    //     return $this->belongsTo(AuditCategory::class);
    // }
    public function category()
{
    return $this->belongsTo(AuditCategory::class, 'audit_category_id')->withTrashed();
}
}
