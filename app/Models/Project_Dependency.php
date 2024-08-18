<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Dependency extends Model
{
    use HasFactory;
    protected $table = 'project__dependencies';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'plan_id',
        'preceding_task_id',
        'dependent_task_id',
        'dependency_type',
    ];


    public function precedingTask()
    {
        return $this->belongsTo(Task::class, 'preceding_task_id');
    }

    // Define the relationship to the dependent task
    public function dependentTask()
    {
        return $this->belongsTo(Task::class, 'dependent_task_id');
    }
}
