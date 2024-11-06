<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guardian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guardian_name',
        'contact_number_1',
        'contact_number_2',
        'relationship',
        'region',
        'connecting_location',
    ];
}
