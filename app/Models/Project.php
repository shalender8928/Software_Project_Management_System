<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'creator_id',
        'updater_id'
    ];

<<<<<<< HEAD
    // Define relationships if needed
=======
    // Define relationships if applicable
>>>>>>> e45607bcaddd26624d7200aebbd2eec3c13162ab
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
<<<<<<< HEAD
=======
    use HasFactory;

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'projectID');
    }

>>>>>>> e45607bcaddd26624d7200aebbd2eec3c13162ab

    public function updater()
    {
        return $this->belongsTo(User::class, 'updater_id');
    }
}
