<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Project.php


class Project extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'project_name',
        'description',
        'status',
        'deadline',
        'start_date',
        'end_date',
        'category_id',
    ];

<<<<<<< HEAD
    // Define relationships if applicable
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
=======
    use HasFactory;

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'projectID');
    }

>>>>>>> df9f9bcbcaa6c9db8ceb3888cbb367345557baee

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater_id');
    }
}
