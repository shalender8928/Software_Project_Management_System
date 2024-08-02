<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependency extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'dependencies';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'project_plan_id',
        'dependent_task',
        'preceding_task',
    ];
}
