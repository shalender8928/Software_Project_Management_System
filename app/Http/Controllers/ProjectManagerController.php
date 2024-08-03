<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectPlan;
use App\Models\Milestone;
use App\Models\Timeline;
use App\Models\Resource;
use App\Models\Deliverable;
use App\Models\Dependency;

use Illuminate\Support\Facades\Log;


class ProjectManagerController extends Controller
{
    public function dashboard()
    {
     
    $completedCount = Project::where('status', 'completed')->count();
    $pendingCount = Project::where('status', 'pending')->count();
    $in_progress = Project::where('status', 'in_progress')->count();

    // Fetch all projects
    $projects = Project::all();
    $projectCount = $projects->count();

    // Pass the projects and project count to the view
    return view('projectManager.dashboard', compact('projects', 'projectCount', 'pendingCount', 'completedCount', 'in_progress'));

    }
    public function viewProjectList($status)
    {
        // Fetch projects by status
        $projects = Project::where('status', $status)->get();

        // Pass projects and status to the view
        return view('projectManager.projectList', compact('projects', 'status'));
    }
   




    public function manager_view_profile()
    {
        $user = Auth::user();
        return view('projectManager.manager_view_profile', compact('user'));
    }

    public function manager_edit_profile()
    {
        $user = Auth::user();
        return view('projectManager.manager_edit_profile', compact('user'));
    }

    public function manager_update_profile(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->age = $request->age;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Your Profile has been Successfully Updated');

        return redirect()->route('projectManager.dashboard');
    }







public function resources()
{
    $projects = Project::join('project_plans', 'projects.id', '=', 'project_plans.project_id')
        ->select('projects.id as project_id', 'projects.project_name', 'project_plans.id as project_plan_id')
        ->get();
    return view('projectmanager.create_resources', compact('projects'));
}

public function add_new_resources(Request $request)
{
    $validatedData = $request->validate([
        'project_plan_id' => 'required|exists:project_plans,id',
        'resourcename' => 'required|string',
        'resourcetype' => 'required|string',
        'quantity' => 'required|string',
    ]);

    $resource= new resource();
    $resource->project_plan_id = $validatedData['project_plan_id'];
    $resource->resourcename = $validatedData['resourcename'];
    $resource->resourcetype = $validatedData['resourcetype'];
    $resource->quantity = $validatedData['quantity'];

    $resource->save();

    toastr()->addSuccess('resources has been successfully added');
    return redirect()->route('projectmanager.create_resources');
}
//  derivable 


public function derivables()
{
    $projects = Project::join('project_plans', 'projects.id', '=', 'project_plans.project_id')
        ->select('projects.id as project_id', 'projects.project_name', 'project_plans.id as project_plan_id')
        ->get();
    return view('projectmanager.create_deliverable', compact('projects'));
}


public function add_new_derivables(Request $request)
{
    $validatedData = $request->validate([
        'project_plan_id' => 'required|exists:project_plans,id',
        'deliverableName' => 'required|string',
        'description' => 'nullable|string',
        'deadline' => 'required|date',
    ]);

    $deliverable = new Deliverable();
    $deliverable->project_plan_id = $validatedData['project_plan_id'];
    $deliverable->deliverableName = $validatedData['deliverableName'];
    $deliverable->description = $validatedData['description'];
    $deliverable->deadline = $validatedData['deadline'];

    $deliverable->save();

    toastr()->addSuccess('Deliverable has been successfully added');
    return redirect()->route('projectmanager.create_deliverable');
}

// dependency


public function dependencies()
{
    $projects = Project::join('project_plans', 'projects.id', '=', 'project_plans.project_id')
        ->select('projects.id as project_id', 'projects.project_name', 'project_plans.id as project_plan_id')
        ->get();
    return view('projectmanager.create_dependencies', compact('projects'));
}


public function add_new_dependencies(Request $request)
{
    $validatedData = $request->validate([
        'project_plan_id' => 'required|exists:project_plans,id',
        'dependent_task' => 'required|integer',
        'preceding_task' => 'required|integer',
    ]);

    $dependency = new Dependency();
    $dependency->project_plan_id = $validatedData['project_plan_id'];
    $dependency->dependent_task = $validatedData['dependent_task'];
    $dependency->preceding_task = $validatedData['preceding_task'];
    $dependency->save();

    toastr()->addSuccess('Dependency has been successfully added');
    return redirect()->route('projectmanager.create_dependencies');
}


}



 
 




 