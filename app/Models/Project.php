<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
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
