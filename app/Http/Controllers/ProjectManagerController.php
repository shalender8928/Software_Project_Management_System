<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectManagerController extends Controller
{
    public function dashboard()
    {
        return view('projectManager.dashboard');
    }
}
