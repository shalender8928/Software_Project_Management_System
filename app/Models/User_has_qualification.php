<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_has_qualification extends Model
{
    use HasFactory;
    
    public function user_ids(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function qualification_id(){
        return $this->hasOne('App\Models\Qualification', 'id', 'qualification_id');
    }
}
