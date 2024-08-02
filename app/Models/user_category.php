<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_category extends Model
{
    use HasFactory;

    public function user_id(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function category_id(){
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
}
