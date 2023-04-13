<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataCovid extends Model
{
    use HasFactory;

    protected $table = 'data_covids';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'date',
        'new_cases',
    ];
    public $timestamps = false;
}
