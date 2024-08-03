<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

   
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function creator(){
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function updater(){
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

    public function developers()
{
    return $this->hasMany(Developer_has_Task::class);
}


    // public function project(){
    //     return $this->hasOne('App\Models\Project', 'id', 'project_id');

    // }
}
