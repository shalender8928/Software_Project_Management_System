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
// 



public function createProject()
    {
        $data = Auth::user(); // Get the authenticated user's data

        $categories= Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.Create_Project', compact('data' , 'categories'));
    }

    public function add_new_Project(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string',
            'deadline' => 'required|date',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'Category' => 'required|string',
        ]);

        $project = new Project;
        $project->project_name = $request->project_name;
        $project->description = $request->description;
        $project->status = $request->status;
        $project->deadline = $request->deadline;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->category_id = $request->Category; // Corrected from project_name to category_id
        $project->created_by = auth()->user()->id;
        $project->updated_by = auth()->user()->id;
        $project->save();

        toastr()->timeOut(1000)->closeButton()->addSuccess('Project created successfully.');

        return redirect()->route('projectManager.dashboard');
    }

// edit project  


public function edit_project() {
    // Retrieve all projects
    $projects = Project::all();

    toastr()->timeOut(10000)->closeButton()->addSuccess('Project edit successfully.');
    // Pass the projects to the view
    return view('projectManager.edit_project', compact('projects'));
}

// Method to display the project update form (optional if you are using `edit_project` for this)
public function update_Project($id){
    $project = Project::findOrFail($id);
    return view('projectManager.update_project', compact('project'));

    toastr()->timeOut(10000)->closeButton()->addSuccess('Project update successfully.');
}

// Method to handle the update request
public function update_pro_Project(Request $request, $id)
{
    $request->validate([
        'project_name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'status' => 'required|string',
        'deadline' => 'nullable|date',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
        'category_id' => 'required|string',
    ]);

    $project = Project::findOrFail($id);
    $project->update($request->all());
    $project->updated_by = Auth::id();
    $project->save();

    toastr()->success('Project Details Updated Successfully.'); // Success message

    return redirect()->route('projectManager.dashboard');
}

public function delete_project()
{
    $projects = Project::all();

    // Pass the projects to the view
    return view('projectManager.delete_project', compact('projects'));
}

// Method to delete a specific project
public function delete_pro_project($id)
{
    $project = Project::find($id);

    // Check if the project exists
    if (!$project) {
        toastr()->error('Project does not exist.'); // Using toastr for error notification
        return redirect()->route('projectmanager.delete_project'); // Redirect to the project list page
    }

    // Delete the project
    $project->delete();
    toastr()->success('Project successfully deleted.'); // Using toastr for success notification

    return redirect()->route('projectmanager.delete_project'); // Redirect to the project list page
}

public function view_project_list() {
    $projects = Project::all(); // Fetch projects from the database
    return view('projectManager.view_project_list', compact('projects'));
}
public function view_project_detail($id){
    $project = Project::find($id);

    if (!$project) {
        // Handle the case where the project is not found
        return redirect()->route('projectmanager.view_project_list')->with('error', 'Project not found');
    }

    return view('projectManager.view_project_detail', compact('project'));
}







  //  task assign



   public function Assigntask()
{

    $projects = Project::all();

    // Pass the projects to the view
    return view('projectManager.Assigntask', compact('projects'));
}

  public function storeTask(Request $request)
{
    $validatedData = $request->validate([

        'project_name' => 'required|integer',
        'task_description' => 'required|string',
        'priority' => 'required|string',
    
        'assign_to' => 'required|string',
        'deadline' => 'required|date',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    // Adjust the data as needed
    $taskData = [
        'project_name' => $validatedData['project_name'],
        'task_description' => $validatedData['task_description'],
        'priority' => $validatedData['priority'],
        
        'assign_to' => $validatedData['assign_to'],
        'deadline' => $validatedData['deadline'],
        'start_date' => $validatedData['start_date'],
        'end_date' => $validatedData['end_date'],
        // Add other fields as needed
    ];

    // Insert data into the tasks table
    Task::create($taskData);

   
    toastr()->success('Task created successfully!'); // Success message

    return redirect()->route('projectManager.dashboard');
}

  public function Edit_Assigntask()
  {
      $tasks = Task::all();
      return view('projectManager.edit_Assigntask', compact('tasks'));
  }
  public function update_assigntask($id)
  {
      $task = Task::find($id);
      
      // Fetch the task if needed for the view
      return view('projectmanager.update_assigntask', compact('task'));
  }
  
  public function update_pro_assigntask(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'project_name' => 'required|string|max:255',
        'task_description' => 'required|string|max:255',
        'priority' => 'required|string|max:255',
        'assign_to' => 'required|string|max:255',
        'deadline' => 'required|date',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);

    // Find the task by ID
    $task = Task::find($id);

    if ($task) {
        // Update the task with the request data
        $task->update([
            'project_name' => $request->project_name,
            'task_description' => $request->task_description,
            'priority' => $request->priority,
            'assign_to' => $request->assign_to,
            'deadline' => $request->deadline,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Redirect with success message
        toastr()->success('Project Details Updated Successfully.');

        return redirect()->route('ProjectManager.Edit_Assigntask');
    }

    // Redirect with error message if task not found
    return redirect()->back()->with('error', 'Task not found.');
}

  public function delete_task()
  {
      $tasks = Task::all();

      // Pass the tasks to the view
      return view('projectManager.delete_task', compact('tasks'));
      
  }

  // Method to delete a specific task
  public function delete_pro_assigntask($id)
  {
      $task = Task::find($id);

      // Check if the task exists
      if (!$task) {
          toastr()->error('Task does not exist.'); // Using toastr for error notification
          return redirect()->route('projectmanager.delete_task'); // Redirect to the task list page
      }

      // Delete the task
      $task->delete();
      toastr()->success('Task successfully deleted.'); // Using toastr for success notification

      return redirect()->route('projectmanager.delete_task'); // Redirect to the task list page
  }


  public function view_task_list()
  {
      $tasks = Task::all();
      return view('projectManager.view_task_list', compact('tasks'));
  }

  public function view_task_detail($id)
  {
      $task = Task::find($id);

      if (!$task) {
          return redirect()->route('projectmanager.view_task_list')->with('error', 'Task not found');
      }

      return view('projectManager.view_task_detail', compact('task'));
  }







//  craete project plan 




  
public function createProjectPlan()
{
    $projects = Project::orderBy('project_name', 'asc')->get();
    $projectplan = ProjectPlan::all(); // Example of fetching all project plans  // Fetching projects
    return view('projectManager.create_Project_plan', compact('projects','projectplan'));
}

public function add_new_Project_plan(Request $request)
{
    $validatedData = $request->validate([
        'project_id' => 'required|exists:projects,id',
        'plandetails' => 'required|string',
    ]);

    // Create a new ProjectPlan
    $projectPlan = new ProjectPlan;
    $projectPlan->project_id = $validatedData['project_id'];
    $projectPlan->plandetails = $validatedData['plandetails'];
    $projectPlan->created_by = Auth::id();
    $projectPlan->updated_by = Auth::id();
    $projectPlan->save();

    toastr()->addSuccess('project plan has been Successfully Updated');

    return redirect()->route('projectmanager.create_project_plan');
}

// Method to display the project update form
public function update_ProjectPlan($id)
{
    $projectPlans = ProjectPlan::all(); 
    return view('projectManager.update_projectplan', compact('projectPlans'));
}


public function update_pro_projectplan(Request $request, $id)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'plandetails' => 'required|string|max:5000',
    ]);

    $projectPlan = ProjectPlan::findOrFail($id);

    $projectPlan->project_id = $request->input('project_id');
    $projectPlan->plandetails = $request->input('plandetails');
    $projectPlan->save();

    return redirect()->route('projectmanager.update_projectplan', ['id' => $projectPlan->id])
     ->with('success', 'Project plan updated successfully!');
}







// milestone

  
public function createmilestone()
{
    $projects = Project::join('project_plans', 'projects.id', '=', 'project_plans.project_id')
    ->select('projects.id as project_id', 'projects.project_name', 'project_plans.id as project_plan_id')
    ->get();
 return view('projectmanager.create_milestone_project', compact('projects'));
}

public function add_new_milestone(Request $request)
{
        $validatedData = $request->validate([
        'project_plan_id' => 'required|exists:project_plans,id',
        'milestoneName' => 'required|string',
        'milestoneDate' => 'required|date',
    ]);

    $milestone = new Milestone();
    $milestone->project_plan_id = $validatedData['project_plan_id'];
    $milestone->milestoneName = $validatedData['milestoneName'];
    $milestone->milestoneDate = $validatedData['milestoneDate'];

    $milestone->save();

    toastr()->addSuccess('Milestone has been successfully added');
    return redirect()->route('projectmanager.create_milestone_project');
}



//  timelines




public function timelines()
{
    $projects = Project::join('project_plans', 'projects.id', '=', 'project_plans.project_id')
        ->select('projects.id as project_id', 'projects.project_name', 'project_plans.id as project_plan_id')
        ->get();
    return view('projectmanager.create_timelines', compact('projects'));
}

public function add_new_timelines(Request $request)
{
    $validatedData = $request->validate([
        'project_plan_id' => 'required|exists:project_plans,id',
        'taskName' => 'required|string',
        'taskDate' => 'required|date',
    ]);

    $timeline = new Timeline();
    $timeline->project_plan_id = $validatedData['project_plan_id'];
    $timeline->taskName = $validatedData['taskName'];
    $timeline->taskDate = $validatedData['taskDate'];

    $timeline->save();

    toastr()->addSuccess('Timeline has been successfully added');
    return redirect()->route('projectmanager.create_timelines');
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



 
 




 