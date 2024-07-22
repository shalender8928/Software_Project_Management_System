<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Log;


class ProjectManagerController extends Controller
{
    public function dashboard()
    {
        return view('projectManager.dashboard');
    }
    public function update_profile_pm()
{
    $user = Auth::user(); // Ensure the user is logged in
    if (!$user) {
        abort(403, 'Unauthorized');
    }
    $data = User::find($user->id);
    return view('projectManager.update_profile_pm', compact('data'));
}

public function update_profile(Request $request, $id)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'gender' => 'required|string|max:10',
        'age' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user = User::find($id);

    if (!$user || $user->id != Auth::id()) {
        abort(403, 'Unauthorized');
    }

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

public function view_profile()
{
    $user = Auth::user();
    $data = User::find($user->id); // Ensure user is logged in
    return view('projectManager.view_profile', compact('data'));
}

    

  // 
public function Assigntask()
{
    // Fetch the authenticated user
    $data = Auth::user();

    // Pass the data to the view
    return view('projectManager.Assigntask', compact('data'));
}


public function storeTask(Request $request)
{
    $validatedData = $request->validate([
        'project_name' => 'required|string|max:255',
        'task_description' => 'required|string',
        'priority' => 'required|integer',
        'assign_to' => 'required|string',
        'deadline' => 'required|date',
        'start_date' => 'required|date',
        'end_date' => 'required|date'
    ]);

    Task::create($validatedData);

    toastr()->success('Task created successfully.'); // Success message

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
        $project->category_id = $request->Category; // Corrected from project_id to category_id
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


  //

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


}



 