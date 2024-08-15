<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Project_Plan extends Model
{
    use HasFactory;

    protected $table = 'project__plans';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'project_id',
        'name',
        'description',
        'start_date',
        'end_date',
        'deadline',
        'status',
        'created_by',
        'updated_by',
        'approved_by',
        'approved_on',
        'rejection_reason',
    ];
     // Define the relationship with the Project model
     public function project()
     {
         return $this->belongsTo(Project::class, 'project_id');
     }
 
     // Define the relationship with the User model for the creator
     public function createdBy()
     {
         return $this->belongsTo(User::class, 'created_by');
     }
 
     // Define the relationship with the User model for the approver
     public function approvedBy()
     {
         return $this->hasOne('App\Models\User', 'id', 'approved_by');
     }
      public function rejectedBy()
     {
         return $this->hasOne('App\Models\User', 'id', 'rejected_by');
     }
     
     protected $casts = [
        'approved_on' => 'datetime', // Add this line
        'rejected_on' => 'datetime',
    ];
}
