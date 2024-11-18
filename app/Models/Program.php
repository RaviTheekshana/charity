<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
    public function children()
    {
        return $this->belongsToMany(Children::class, 'child_program', 'program_id', 'child_id');
    }

}

