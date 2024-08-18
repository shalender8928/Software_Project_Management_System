<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Milestone extends Model
{
    use HasFactory;


    protected $table = 'project__milestones';

    protected $fillable = [
        'plan_id',
        'name',
        'description',
        'deadline',
        'end_date',
    ];
}
