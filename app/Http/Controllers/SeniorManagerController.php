<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SeniorManagerController extends Controller
{
    public function dashboard()
    {
        return view('seniorManager.dashboard');
    }
}
