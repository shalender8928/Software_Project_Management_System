<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Scope extends Model
{
    use HasFactory;

    protected $table = 'project__scopes';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'plan_id',
        'description',
    ];
}
