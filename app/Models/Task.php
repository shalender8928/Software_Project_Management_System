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

    // In Task model
    public function developerHasTasks()
    {
        return $this->hasMany(Developer_has_Task::class, 'task_id');
    }



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function precedingDependencies()
    {
        return $this->hasMany(Project_Dependency::class, 'preceding_task_id');
    }

    public function dependentDependencies()
    {
        return $this->hasMany(Project_Dependency::class, 'dependent_task_id');
    }

  

}
