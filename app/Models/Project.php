<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'progress';

    protected function name():Attribute
    {
        return Attribute::make(
            get: fn($value)=> ucWords($value),
        );
    }
    protected $fillable = [
        'name',
        'client_name',
        'technology_stack',
        'start_date',
        'status',
    ];

    
    public function audits()
{
    return $this->hasMany(Audit::class)->latest();
}
}
