<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    // Specify the table associated with the model if it's not the default 'tasks'
    protected $table = 'tasks';

    // Specify the primary key if it's not the default 'id'
    protected $primaryKey = 'id';

    // The attributes that are mass assignable.
    protected $fillable = [
        'project_name',
        'task_description',
        'priority',
        'assign_to',
        'deadline',
        'start_date',
        'end_date',
    ];

    // If the table has timestamps (created_at, updated_at)
    public $timestamps = true;

    // Example of a relationship: A task may belong to a project
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_name');
    }

    // Example of a relationship: A task may be assigned to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }
}
