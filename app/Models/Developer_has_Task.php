<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer_has_Task extends Model
{
    use HasFactory;
    protected $table = 'developer_has__tasks';

    protected $fillable = [
        'user_id',
        'task_id',
        'assigned_on',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
