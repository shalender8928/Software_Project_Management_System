<?php

// app/Models/Feedback.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'customerID',
        'projectID',
        'feedbackText',
        'rating',
        'created_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'projectID');
    }}

