<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personal_Details extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'inmate_no',
        'inmate_name',
        'prison_id',
        'sentence_no',
        'end_year_sentence',
    ];

    protected function casts()
    {
        return [
            'end_year_sentence' => 'datetime',
        ];
    }
    public function children()
    {
        return $this->hasMany(Children::class, 'personal_details_id');
    }
    public function prison()
    {
        return $this->hasMany(Prison::class, 'prison_id');
    }
}
