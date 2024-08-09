<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use App\Models\ProjectPlan;



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
    // project_manger_view_profile
    public function project_manger_view_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('projectManager.project_manger_view_profile', compact('data'));
    }
    
    public function changeImage()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('projectManager.change_image', compact('data'));
         // Ensure you have a corresponding view file
    }
    public function project_man_update_profile_image(Request $request, $id)
    {
        $request->validate([
          'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $user = User::find($id);
        if ($request->hasFile('image')) 
        {
           $imageName = time().'.'.$request->image->extension();
           $request->image->move(public_path('images'), $imageName);
           $user->image = $imageName;
        }
        $user->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Your Profile has been Successfully Updated');

        return redirect()->route('projectManager.dashboard');

    }
    public function pro_man_edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('projectManager.pro_man_edit_profile', compact('data'));

    }
    //update profile
    public function pro_manager_update_profile(Request $request, $id)
    {
      $request->validate(
       [
       'firstname' => 'required|string|max:255',
       'lastname' => 'required|string|max:255',
       'phone' => 'required|string|max:15',
       'gender' => 'required|string|max:10',
       'age' => 'required|integer',
       'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       $user = User::find($id);
       $user->firstname = $request->firstname;
       $user->lastname = $request->lastname;
       $user->phone = $request->phone;
       $user->gender = $request->gender;
       $user->age = $request->age;

   if ($request->hasFile('image')) 
    {
       $imageName = time().'.'.$request->image->extension();
       $request->image->move(public_path('images'), $imageName);
       $user->image = $imageName;
    }
   
       $user->save();

       toastr()->timeOut(10000)->closeButton()->addSuccess('Your Profile has been Successfully Updated');

       return redirect()->route('projectManager.dashboard');

   }

   


    public function createProject(){
        $categories = Category::orderBy('cat_name' , 'asc')->get(); // Assuming you have a Category model

        return view('projectManager.create_project', compact('categories'));
    }


    public function create_project_post(Request $request) {
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after:start_date',
            'category_id' => 'required|integer'
        ]);
    
        $projectName = $request->input('project_name');
        $projectCount = Project::where('name', $projectName)->count();
    
        if ($projectCount > 0) {
            toastr()->timeOut(10000)->closeButton()->warning('This Project Already Exists.');
            return redirect()->back();
        } else {
            // Create a new project
            $project = new Project;
            $project->name = $request->input('project_name');
            $project->description = $request->input('description');
            $project->start_date = $request->input('start_date');
            $project->deadline = $request->input('deadline');
            $project->category_id = $request->input('category_id');
            $project->created_by = auth()->user()->id; // assuming the current logged-in user creates the project
            $project->updated_by = auth()->user()->id; // initially, the created_by and updated_by are the same
            $project->save();
    
            toastr()->timeOut(10000)->closeButton()->addSuccess('Project created successfully');
            return redirect()->back();
        }
    }

    public function select_project_to_edit(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_project_to_edit' , compact('category'));
    }

    public function edit_project($id){
        $project = Project:: where('category_id' , $id)->orderBy('name' , 'asc')->get();

        return view('projectManager.edit_project' , compact('project'));
    }

    public function update_project($id) {
        $project = Project::find($id);
        $categories = Category::orderBy('cat_name', 'asc')->get(); // Retrieve all categories
    
        return view('projectManager.update_project', compact('project', 'categories'));
    }

    public function update_project_post(Request $request, $id) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'project_name' => 'required|string|max:255',
            'description' => 'required',
            'category_id' => 'required|integer',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ]);
    
        // Find the project by ID
        $project = Project::find($id);
    
        if (!$project) {
            toastr()->error('Project not found.');
            return redirect()->back();
        }
    
        // Check if the project name already exists in another project
        $existingProject = Project::where('name', $request->input('project_name'))->where('id', '!=', $id)->first();
        if ($existingProject) {
            toastr()->timeOut(10000)->closeButton()->warning('This project name is already used by another project.');
            return redirect()->back();
        }
    
        // Check if there are any changes
        if (
            $project->name == $request->input('project_name') &&
            $project->description == $request->input('description') &&
            $project->category_id == $request->input('category_id') &&
            $project->start_date == $request->input('start_date') &&
            $project->deadline == $request->input('deadline')
        ) {
            toastr()->timeOut(10000)->closeButton()->info('No changes were made.');
            return redirect()->back();
        }
    
        // Update the project with the new data
        $project->name = $request->input('project_name');
        $project->description = $request->input('description');
        $project->category_id = $request->input('category_id');
        $project->start_date = $request->input('start_date');
        $project->deadline = $request->input('deadline');
        $project->updated_by = auth()->user()->id; // Update the user who made the change
        $project->save();
    
        toastr()->timeOut(10000)->closeButton()->addSuccess('Project updated successfully.');
        return redirect()->route('projectManager.edit_project');
    }

    public function delete_Selected_project(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.delete_Selected_project' , compact('category'));
    }


    public function delete_project($id){
        $project = Project:: where('category_id' , $id)->orderBy('name' , 'asc')->get();
        return view('projectManager.delete_project' , compact('project'));
    }
    
    public function delete_project_post($id) {
        // Find the project by ID
        $project = Project::find($id);
    
        // Check if the project exists
        if (!$project) {
            toastr()->error('Project not found.');
            return redirect()->back();
        }
    
        // Delete the project
        $project->delete();
    
        toastr()->timeOut(10000)->closeButton()->addSuccess('Project deleted successfully.');
        return redirect()->back();
    }

    public function select_category_to_list(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_to_list' , compact('category'));
    }
    

    public function view_project_list($id){
        $project  = Project:: where('category_id', $id)->orderBy('name' , 'asc')->get();
        return view('projectManager.view_project_list', compact('project'));
    }

    public function view_project_detail($id){
        $project = Project::find($id);
        return view('projectManager.view_project_detail' , compact('project'));
    }
    
    public function create_task(){
        $projects = Project::orderBy('name', 'asc')->get();
        return view('projectManager.create_task', compact('projects'));
    }

    public function create_task_post(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'project_id' => 'required|integer|exists:projects,id',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ]);
    
        // Check if a task with the same name exists within the same project
        $taskExists = Task::where('name', $request->input('name'))
                          ->where('project_id', $request->input('project_id'))
                          ->exists();
    
        if ($taskExists) {
            toastr()->timeOut(10000)->closeButton()->warning('A task with this name already exists in the selected project.');
            return redirect()->back()->withInput();
        }
    
        // Create a new task
        $task = new Task;
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->project_id = $request->input('project_id');
        $task->start_date = $request->input('start_date');
        $task->deadline = $request->input('deadline');
        $task->status = 'pending'; // default status
        $task->created_by = auth()->user()->id;
        $task->updated_by = auth()->user()->id;
        $task->save();
    
        toastr()->timeOut(10000)->closeButton()->success('Task created successfully.');
        return redirect()->back();
    }

    public function select_category_to_editt(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_to_editt' , compact('category'));
    }

    public function select_project_to_editt($id){
        $project = Project:: where('category_id' , $id)->orderBy('name' ,'asc')->get();
        return view('projectManager.select_project_to_editt',compact('project'));
    }

    public function edit_task($id)
        {
            $tasks = Task::with('project')->where('project_id', $id)->orderBy('name', 'asc')->get();
            return view('projectManager.edit_task', compact('tasks'));
        }



    public function update_task($id){
        $task = Task::find($id);
        $projects = Project::orderBy('name', 'asc')->get();
        return view('projectManager.update_task', compact('task', 'projects'));
    }

    public function update_task_post(Request $request, $id) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'project_id' => 'required|integer|exists:projects,id',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
        ]);
    
        $task = Task::find($id);
    
        // Check if a task with the same name exists within the same project
        $taskExists = Task::where('name', $request->input('name'))
                          ->where('project_id', $request->input('project_id'))
                          ->where('id', '!=', $id)
                          ->exists();
    
        if ($taskExists) {
            toastr()->timeOut(10000)->closeButton()->warning('A task with this name already exists in the selected project.');
            return redirect()->back()->withInput();
        }
    
        // Check if there are any changes
        $noChanges = $task->name === $request->input('name') &&
                     $task->description === $request->input('description') &&
                     $task->project_id == $request->input('project_id') &&
                     $task->start_date === $request->input('start_date') &&
                     $task->deadline === $request->input('deadline');
    
        if ($noChanges) {
            toastr()->timeOut(10000)->closeButton()->info('No changes made to the task.');
            return redirect()->back();
        }
    
        // Update the task
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->project_id = $request->input('project_id');
        $task->start_date = $request->input('start_date');
        $task->deadline = $request->input('deadline');
        $task->updated_by = auth()->user()->id;
        $task->save();
    
        toastr()->timeOut(10000)->closeButton()->success('Task updated successfully.');
        return redirect()->back();
    }

    public function select_category_to_delette(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_to_delette' , compact('category'));
    }

    public function select_project_to_delette($id){
        $project = Project:: where('category_id' , $id)->orderBy('name' ,'asc')->get();
        return view('projectManager.select_project_to_delette',compact('project'));
    }
    
    public function delete_task(){
        $tasks  = Task:: orderBy('name', 'asc')->get();
        return view('projectManager.delete_task' , compact('tasks'));
    }

    public function delete_task_post($id){
        $task  = Task:: find($id);

        if (!$task) {
            toastr()->error('Task not found.');
            return redirect()->back();
        }
    
        // Delete the project
        $task->delete();
    
        toastr()->timeOut(10000)->closeButton()->addSuccess('Project deleted successfully.');
        return redirect()->back();
    }


    public function select_category_to_view_task(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_to_view_task' , compact('category'));
    }

    public function select_project_to_view_task($id){
        $project = Project:: where('category_id' , $id)->orderBy('name' ,'asc')->get();
        return view('projectManager.select_project_to_view_task',compact('project'));
    }


    public function view_task_list(){
        $tasks = Task::with('project')->orderBy('name', 'asc')->get();
        return view('projectManager.view_task_list', compact('tasks'));
    }

    public function view_task_detail($id)
    {
        $task = Task::with('project')->findOrFail($id);
        return view('projectManager.view_task_detail', compact('task'));
    }

    public function assign_task(){
        $tasks = Task::with('project')->orderBy('name', 'asc')->get();
        return view('projectManager.assign_task' , compact('tasks'));
    }
    



    public function create_project_plan(){
        $projects = Project:: orderBy('name' , 'asc')->get();
        return view('projectManager.create_project_plan ' , compact('projects'));
    }

    public function add_new_project_plan(Request $request)
{
    // Validate the input
    $request->validate([
        'project' => 'required|exists:projects,id',
        'plan_details' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:pending,in_progress,completed',
        'deadline' => 'required|date|after_or_equal:start_date',
    ]);

    // Create a new project plan
    $projectPlan = new ProjectPlan();
    $projectPlan->project_id = $request->input('project');
    $projectPlan->plan_details = $request->input('plan_details');
    $projectPlan->start_date = $request->input('start_date');
    $projectPlan->end_date = $request->input('end_date');
    $projectPlan->status = $request->input('status');
    $projectPlan->deadline = $request->input('deadline');
    $projectPlan->created_by = auth()->user()->id; // Assuming you are using Laravel's authentication
    $projectPlan->updated_by = auth()->user()->id;

    // Save the project plan to the database
    $projectPlan->save();
    toastr()->timeOut(10000)->closeButton()->addSuccess('Project plan created successfully!' );

    // Redirect to a desired page with a success message
    return redirect()->back();
}



    

//     public function viewProjectList($status)
//     {
//         // Fetch projects by status
//         $projects = Project::where('status', $status)->get();

//         // Pass projects and status to the view
//         return view('projectManager.projectList', compact('projects', 'status'));
//     }
   




//     public function manager_view_profile()
//     {
//         $user = Auth::user();
//         return view('projectManager.manager_view_profile', compact('user'));
//     }

//     public function manager_edit_profile()
//     {
//         $user = Auth::user();
//         return view('projectManager.manager_edit_profile', compact('user'));
//     }

//     public function manager_update_profile(Request $request, $id)
//     {
//         $request->validate([
//             'firstname' => 'required|string|max:255',
//             'lastname' => 'required|string|max:255',
//             'phone' => 'required|string|max:15',
//             'gender' => 'required|string|max:10',
//             'age' => 'required|integer',
//             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
//         ]);

//         $user = User::find($id);
//         $user->firstname = $request->firstname;
//         $user->lastname = $request->lastname;
//         $user->phone = $request->phone;
//         $user->gender = $request->gender;
//         $user->age = $request->age;

//         if ($request->hasFile('image')) {
//             $imageName = time() . '.' . $request->image->extension();
//             $request->image->move(public_path('images'), $imageName);
//             $user->image = $imageName;
//         }

//         $user->save();

//         toastr()->timeOut(10000)->closeButton()->addSuccess('Your Profile has been Successfully Updated');

//         return redirect()->route('projectManager.dashboard');
//     }
// // 



// public function createProject()
//     {
//         $data = Auth::user(); // Get the authenticated user's data

//         $categories= Category:: orderBy('cat_name' , 'asc')->get();
//         return view('projectManager.Create_Project', compact('data' , 'categories'));
//     }

//     public function add_new_Project(Request $request)
//     {
//         $request->validate([
//             'project_name' => 'required|string|max:255',
//             'description' => 'required|string',
//             'status' => 'required|string',
//             'deadline' => 'required|date',
//             'start_date' => 'required|date',
//             'end_date' => 'required|date',
//             'Category' => 'required|string',
//         ]);

//         $project = new Project;
//         $project->project_name = $request->project_name;
//         $project->description = $request->description;
//         $project->status = $request->status;
//         $project->deadline = $request->deadline;
//         $project->start_date = $request->start_date;
//         $project->end_date = $request->end_date;
//         $project->category_id = $request->Category; // Corrected from project_id to category_id
//         $project->created_by = auth()->user()->id;
//         $project->updated_by = auth()->user()->id;
//         $project->save();

//         toastr()->timeOut(1000)->closeButton()->addSuccess('Project created successfully.');

//         return redirect()->route('projectManager.dashboard');
//     }

// // edit project  


// public function edit_project() {
//     // Retrieve all projects
//     $projects = Project::all();

//     toastr()->timeOut(10000)->closeButton()->addSuccess('Project edit successfully.');
//     // Pass the projects to the view
//     return view('projectManager.edit_project', compact('projects'));
// }

// // Method to display the project update form (optional if you are using `edit_project` for this)
// public function update_Project($id){
//     $project = Project::findOrFail($id);
//     return view('projectManager.update_project', compact('project'));

//     toastr()->timeOut(10000)->closeButton()->addSuccess('Project update successfully.');
// }

// // Method to handle the update request
// public function update_pro_Project(Request $request, $id)
// {
//     $request->validate([
//         'project_name' => 'required|string|max:255',
//         'description' => 'nullable|string|max:255',
//         'status' => 'required|string',
//         'deadline' => 'nullable|date',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date',
//         'category_id' => 'required|string',
//     ]);

//     $project = Project::findOrFail($id);
//     $project->update($request->all());
//     $project->updated_by = Auth::id();
//     $project->save();

//     toastr()->success('Project Details Updated Successfully.'); // Success message

//     return redirect()->route('projectManager.dashboard');
// }

// public function delete_project()
// {
//     $projects = Project::all();

//     // Pass the projects to the view
//     return view('projectManager.delete_project', compact('projects'));
// }

// // Method to delete a specific project
// public function delete_pro_project($id)
// {
//     $project = Project::find($id);

//     // Check if the project exists
//     if (!$project) {
//         toastr()->error('Project does not exist.'); // Using toastr for error notification
//         return redirect()->route('projectmanager.delete_project'); // Redirect to the project list page
//     }

//     // Delete the project
//     $project->delete();
//     toastr()->success('Project successfully deleted.'); // Using toastr for success notification

//     return redirect()->route('projectmanager.delete_project'); // Redirect to the project list page
// }

// public function view_project_list() {
//     $projects = Project::all(); // Fetch projects from the database
//     return view('projectManager.view_project_list', compact('projects'));
// }
// public function view_project_detail($id){
//     $project = Project::find($id);

//     if (!$project) {
//         // Handle the case where the project is not found
//         return redirect()->route('projectmanager.view_project_list')->with('error', 'Project not found');
//     }

//     return view('projectManager.view_project_detail', compact('project'));
// }


//   //

//   public function Edit_Assigntask()
//   {
//       $tasks = Task::all();
//       return view('projectManager.edit_Assigntask', compact('tasks'));
//   }
//   public function update_assigntask($id)
//   {
//       $task = Task::find($id);
      
//       // Fetch the task if needed for the view
//       return view('projectmanager.update_assigntask', compact('task'));
//   }
  
//   public function update_pro_assigntask(Request $request, $id)
// {
//     // Validate the request
//     $request->validate([
//         'project_name' => 'required|string|max:255',
//         'task_description' => 'required|string|max:255',
//         'priority' => 'required|string|max:255',
//         'assign_to' => 'required|string|max:255',
//         'deadline' => 'required|date',
//         'start_date' => 'required|date',
//         'end_date' => 'required|date',
//     ]);

//     // Find the task by ID
//     $task = Task::find($id);

//     if ($task) {
//         // Update the task with the request data
//         $task->update([
//             'project_name' => $request->project_name,
//             'task_description' => $request->task_description,
//             'priority' => $request->priority,
//             'assign_to' => $request->assign_to,
//             'deadline' => $request->deadline,
//             'start_date' => $request->start_date,
//             'end_date' => $request->end_date,
//         ]);

//         // Redirect with success message
//         toastr()->success('Project Details Updated Successfully.');

//         return redirect()->route('ProjectManager.Edit_Assigntask');
//     }

//     // Redirect with error message if task not found
//     return redirect()->back()->with('error', 'Task not found.');
// }

//   public function delete_task()
//   {
//       $tasks = Task::all();

//       // Pass the tasks to the view
//       return view('projectManager.delete_task', compact('tasks'));
      
//   }

//   // Method to delete a specific task
//   public function delete_pro_assigntask($id)
//   {
//       $task = Task::find($id);

//       // Check if the task exists
//       if (!$task) {
//           toastr()->error('Task does not exist.'); // Using toastr for error notification
//           return redirect()->route('projectmanager.delete_task'); // Redirect to the task list page
//       }

//       // Delete the task
//       $task->delete();
//       toastr()->success('Task successfully deleted.'); // Using toastr for success notification

//       return redirect()->route('projectmanager.delete_task'); // Redirect to the task list page
//   }


//   public function view_task_list()
//   {
//       $tasks = Task::all();
//       return view('projectManager.view_task_list', compact('tasks'));
//   }

//   public function view_task_detail($id)
//   {
//       $task = Task::find($id);

//       if (!$task) {
//           return redirect()->route('projectmanager.view_task_list')->with('error', 'Task not found');
//       }

//       return view('projectManager.view_task_detail', compact('task'));
//   }


}



 
 




 