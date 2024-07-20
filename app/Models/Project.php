<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'start_date', 
        'end_date',
    ];

    use HasFactory;

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'projectID');
    }


}
