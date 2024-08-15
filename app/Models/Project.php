<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function creator(){
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }


    public function updater(){
        return $this->hasOne('App\Models\User', 'id', 'updated_by');
    }

   
    public function category(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');

    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
        // Define the relationship with ProjectPlan
        public function projectPlans()
        {
            return $this->hasMany(Project_Plan::class);
        }
        
    }
