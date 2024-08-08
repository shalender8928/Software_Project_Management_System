<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Plan extends Model
{
    use HasFactory;

    protected $table = 'project__plans';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'deadline',
        'status',
        'created_by',
        'updated_by',
        'approved_by',
        'approved_on',
        'rejection_reason',
    ];
}
