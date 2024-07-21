<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name', 
        'task_description', 
        'priority', 
        'assign_to', 
        'deadline', 
        'start_date', 
        'end_date'
    ];
}