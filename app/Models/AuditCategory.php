<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AuditCategory extends Model
{
    use SoftDeletes;
    protected $fillable = ['name', 'description'];

    public function checkpoints()
    {
        return $this->hasMany(AuditCheckpoint::class);
    }

    protected static function booted(){

        static::deleting(function($category){
            // soft delete all checkpoints
            $category->checkpoints()->delete();
        });

        static::restoring(function($category){
            // restore all checkpoints
            $category->checkpoints()->withTrashed()->restore();
        });
    }
}
