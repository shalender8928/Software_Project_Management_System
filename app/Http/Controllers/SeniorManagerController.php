<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Feedback;


class SeniorManagerController extends Controller
{
    public function dashboard()
    {
         $user = Auth::user();
        $data = User::find($user->id);
        return view('seniorManager.dashboard', compact('data'));
    }
    public function mange_view_profile(){
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('seniorManager.mange_view_profile', compact('data'));
    }
    public function edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('seniorManager.edit_profile', compact('data'));

    }
    
    
}
