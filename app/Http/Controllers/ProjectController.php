<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;

class ProjectController extends Controller
{
    public function create_project()
    {
        $data = Auth::user();
        return view('projectManager.create_project', compact('data'));
    }

    public function store_data(Request $request)
    {
       
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

        // Create a new project instance and fill it with the validated data
        $project = new Project();
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        
        // Save the project to the database
        $project->save();

        // Redirect to a specific route with a success message

        toastr()->timeOut(100)->closeButton()->addSuccess('Project created successfully');
         return redirect()->back();
    }
}
