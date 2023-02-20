<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAgent extends Model
{
    use HasFactory;
    protected $table = 'sub_agent';
    protected $fillable = [
        'agent_id',
        'name',
        'address',
    ];
}
