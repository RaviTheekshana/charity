<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Children extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'child_name',
        'age',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'grade',
        'school',
        'program',
        'personal_details_id',
        'guardian_id',
    ];

    protected function casts()
    {
        return [
            'date_of_birth' => 'datetime',
        ];
    }
}
