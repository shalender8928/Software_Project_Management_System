<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_plan_id',
        'taskName',
        'taskDate',
    ];
}
