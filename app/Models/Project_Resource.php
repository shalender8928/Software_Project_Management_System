<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Resource extends Model
{
    use HasFactory;
    protected $table = 'project__resources';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'plan_id',
        'name',
        'type',
        'cost_per_unit',
        'availability',
    ];
}
