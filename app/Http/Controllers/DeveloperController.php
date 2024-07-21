<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeveloperController extends Controller
{
    public function dashboard()
    {
        // Fetch user data or any other relevant data
        $data = Auth::user(); // Assuming you are fetching the authenticated user's data

        // Pass the data to the view
        return view('developer.dashboard', compact('data'));
    }

    public function edit_profile()
    {
        $user = Auth::user(); // Get the authenticated user
        $user_id = $user->id; // Get the user's ID
        $data = User::find($user_id); // Fetch user data based on ID

        return view('developer.edit_profile', compact('data')); // Pass user data to the view
    }
}
