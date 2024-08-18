<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Objective extends Model
{
    use HasFactory;

    protected $table = 'project__objectives';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'plan_id',
        'description',
    ];
}
