<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';

    protected $fillable = [
        'name',
        'status',
        'created_by',
        'updated_by'
    ];

    public static $statusArrays = ['inactive', 'active'];
}
