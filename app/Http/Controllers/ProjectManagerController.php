<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Category;
use App\Models\Developer_has_Task;
use App\Models\Project_Plan;
use App\Models\Project_Objective;
use App\Models\Project_Scope;
use App\Models\Project_Deliverable;
use App\Models\Project_Dependency;
use App\Models\Project_Milestone;
use App\Models\Project_Resource;
use App\Models\user_category;





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

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'add project')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add new project');
            return redirect()->back();
        }

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
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);
        
        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }

        return view('projectManager.edit_project' , compact('project'));
    }

    public function update_project($id) {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'edit project')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit project');
            return redirect()->back();
        }
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
        
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);

        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        return view('projectManager.delete_project' , compact('project'));
    }
    
    public function delete_project_post($id) {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'delete project')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete project');
            return redirect()->back();
        }
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
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);

        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        return view('projectManager.view_project_list', compact('project'));
    }

    public function view_project_detail($id){
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'view project')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view project details');
            return redirect()->back();
        }
        $project = Project::find($id);
        return view('projectManager.view_project_detail' , compact('project'));
    }
    
    public function create_task()
    {
        $user = Auth::user();
    
        // Retrieve the user's category directly
        $userCategory = user_category::where('user_id', $user->id)->first();
    
        // Ensure that the user has a category assigned
        if (!$userCategory) {
            // Handle the case where the user has no category assigned
            toastr()->timet(10000)->closeButton()->warning('You are not assigned category yet');
            return redirect()->back();
        }
    
        // Find projects that belong to the same category as the user
        $projects = Project::where('category_id', $userCategory->category_id)->get();
    
        return view('projectManager.create_task', compact('projects'));
    }
    

    public function create_task_post(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'add task')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add new task');
            return redirect()->back();
        }
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

         $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);

        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }

        return view('projectManager.select_project_to_editt',compact('project'));
    }

    public function edit_task($id)
    {

    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID

    // Check if the user has the 'add-employee' permission
    $hasPermission = $user->permissions()->where('name', 'edit task')->exists();

    if (!$hasPermission) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit the task');
        return redirect()->back();
    }
    
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
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);

        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        return view('projectManager.select_project_to_delette',compact('project'));
    }
    
    public function delete_task(){
        $tasks  = Task:: orderBy('name', 'asc')->get();
        return view('projectManager.delete_task' , compact('tasks'));
    }

    public function delete_task_post($id){
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'delete task')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete                                                                                                                                                                                                                                                                                                                                                                                                task');
            return redirect()->back();
        }
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

         $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);

        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        return view('projectManager.select_project_to_view_task',compact('project'));
    }


    public function view_task_list($id){
        $tasks = Task::with('project')->where('project_id', $id)->orderBy('name', 'asc')->get();
        return view('projectManager.view_task_list', compact('tasks'));
    }

    public function view_task_detail($id)
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'view task')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view task details');
            return redirect()->back();
        }
        $task = Task::with('project')->findOrFail($id);
        return view('projectManager.view_task_detail', compact('task'));
    }

   
    
    public function select_category_assign_task(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_assign_task' , compact('category'));
    }

    public function select_project_to_assign_task($id)
{
    $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
    $category = Category::find($id);
    
    if ($project->isEmpty()) {
        toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
        return redirect()->back();
    }

    return view('projectManager.select_project_to_assign_task', compact('project', 'category'));
}


public function assign_task($id)
{
    // Retrieve tasks under the project that are not assigned
    $tasks = Task::with('project')
        ->whereDoesntHave('developerHasTasks', function ($query) {
            $query->where('status', 'assigned');
        })
        ->where('project_id', $id)
        ->orderBy('name', 'asc')
        ->get();

    // Check if no tasks are found
    if ($tasks->isEmpty()) {
        // Check if there are tasks that are assigned
        $assignedTasks = Task::whereHas('developerHasTasks', function ($query) {
            $query->where('status', 'assigned');
        })
        ->where('project_id', $id)
        ->exists();

        if ($assignedTasks) {
            toastr()->timeOut(10000)->closeButton()->info('Tasks for this project have already been assigned to a developer.');
        } else {
            toastr()->timeOut(10000)->closeButton()->warning('No tasks found under the selected project.');
        }
        
        return redirect()->back();
    }

    return view('projectManager.assign_task', compact('tasks'));
}



    public function select_user_to_assign_task($id){

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'assign task')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to assign task to developer');
            return redirect()->back();
        }
        $task = Task::find($id);

        // Query to get developers who are not currently assigned to any tasks
        $freeDevelopers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Developer');
        })->whereDoesntHave('developerHasTasks', function ($query) {
            $query->where('status', 'assigned');
        })->whereHas('qualifications')->with('qualifications')->get();
        

        return view('projectManager.select_user_to_assign_task', compact('task', 'freeDevelopers'));
        }

    public function assign_task_post(Request $request, $id){
{
    $task = Task::find($id);
    $developerId = $request->input('developer_id');

    // Check if the task is already assigned
    $existingAssignment = Developer_has_Task::where('task_id', $id)
        ->where('status', 'assigned')
        ->first();

    if ($existingAssignment) {
        // Task is already assigned
        toastr()->timeOut(10000)->closeButton()->addWarning('This task is already assigned to another developer.');
        return redirect()->back();
    }

    // Assign task to the developer
    $taskAssignment = new Developer_has_Task();
    $taskAssignment->user_id = $developerId;
    $taskAssignment->task_id = $id;
    $taskAssignment->assigned_on = now();
    $taskAssignment->status = 'assigned';
    $taskAssignment->save();

    toastr()->timeOut(10000)->closeButton()->addSuccess('Task assigned successfully.');
    return redirect()->back();
}

    }

    public function select_category_update_task(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_update_task' , compact('category'));
}

    public function select_project_to_update_assigned_task($id){
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);
        
        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        return view('projectManager.select_project_to_update_assigned_task',compact('project'));
    }

    public function select_task($id)
    {
        // Retrieve all tasks under the selected project
        $tasks = Task::with(['project.category', 'developerHasTasks.user'])
            ->where('project_id', $id) // Ensure tasks belong to the selected project
            ->get();
    
        // Check if there are any tasks under the selected project
        if ($tasks->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No tasks found under the selected project.');
            return redirect()->back();
        }
    
        // Retrieve tasks under the selected project that have an assigned user
        $assignedTasks = $tasks->filter(function ($task) {
            return $task->developerHasTasks->contains('status', 'assigned');
        });
    
        // Check if there are tasks but none are assigned
        if ($assignedTasks->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning(' None of the tasks are assigned to a developer for the selected Project.');
            return redirect()->back();        }
    
        // Return the view with all tasks (including unassigned ones)
        return view('projectManager.select_task', compact('tasks'));
    }
    

    

    public function select_assigned_user($id)
{
    $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'update assigned task')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to update assigned task for developer');
            return redirect()->back();
        }

    // Get the task assignment details
    $taskAssignment = Developer_has_Task::where('task_id', $id)->first();

    if ($taskAssignment) {
        // Retrieve the related task and user
        $task = Task::find($taskAssignment->task_id);
        $user = User::find($taskAssignment->user_id);

        // Pass the data to the view
        return view('projectManager.select_assigned_user', compact('taskAssignment', 'task', 'user'));
    } else {
        // If no task assignment found, redirect back with an error message
        toastr()->timeOut(10000)->closeButton()->warning('No task assignment found for the given task');
        return redirect()->back();
    }
}


public function assign_task_update_post($taskId)
{
    // Find the task by its ID
    $task = Developer_has_Task:: where('task_id' , $taskId)->first();

    if (!$task) {
        // Display error message using Toastr if the task was not found or something went wrong
    toastr()->timeOut(10000)->closeButton()->error('An error occurred while updating the task.');
    return redirect()->back();
    }

   
    $task->delete();


    // Display success message using Toastr
    toastr()->timeOut(10000)->closeButton()->addSuccess('Task assignment removed successfully.');

    // Redirect to the admin.select_category_update_task page
    return redirect()->route('projectManager.dashboard');
}



    public function select_category_to_add_pro_plan(){
        $category = Category:: orderBy('cat_name' , 'asc')->get();
        return view('projectManager.select_category_to_add_pro_plan' , compact('category'));
    }

    public function select_project_to_add_pro_plan($id){
        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
        $category = Category::find($id);
        
        if ($project->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
            return redirect()->back();
        }
        
        return view('projectManager.select_project_to_add_pro_plan', compact('project', 'category'));
    }


    public function add_new_pro_plan($id){
        // Retrieve tasks under the project that are not assigned
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'add project plan')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add project plan');
            return redirect()->back();
        }
        $tasks = Task::with('project')
        ->where('project_id', $id)
        ->orderBy('name', 'asc')
        ->get();

    // Check if no tasks are found
    if ($tasks->isEmpty()) {
        
            toastr()->timeOut(10000)->closeButton()->warning('No tasks found under the selected project, Please create the task for this project to continue...');
    
        return redirect()->back();
    }

        $project = Project:: find($id);

    return view('projectManager.add_new_pro_plan', compact('project'));
    }


    public function create_project_plan(Request $request){




            $validated = $request->validate([
                'project_id' => 'required|exists:projects,id', // Ensure project_id exists in projects table
                'name' => 'required|string|max:255', // Name is required, string, max 255 characters
                'description' => 'nullable|string', // Description is optional, must be a string if provided
                'start_date' => 'required|date', // Start date is required and must be a valid date
                'deadline' => 'required|date|after_or_equal:start_date', // Deadline is required and must be a valid date
            ]);


            $exist = Project_Plan:: where('project_id' , $validated['project_id'])->count();

            if($exist){
                toastr()->timeOut(10000)->closeButton()->warning('Project plan for the selected project have already been created.');
                return redirect()->back();
            }

            // Get the currently authenticated user ID
            $userId = Auth::id();

            // Create a new ProjectPlan using the validated data and additional fields
            $projectPlan =  Project_Plan::create([
                'project_id' => $validated['project_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'] ?? null, // Use null if not provided
                'deadline' => $validated['deadline'],
                'created_by' => $userId,
                'updated_by' => $userId, // Set the same user for initial creation
                'approved_by' => null, // Will be updated later if approved
                'approved_on' => null, // Will be updated later if approved
                'rejection_reason' => null, // Will be updated later if rejected
            ]);

            // Redirect to dashboard with success message
            // $projectPlanId = $projectPlan->id;
            // $plan = Project_Plan::find($projectPlanId);

        // Display a success message using toastr
        toastr()->timeOut(10000)->closeButton()->addSuccess('Project plan created successfully!');

        // Redirect to the project objective creation view with the project plan ID
        return view('projectManager.add_project_objective', compact('projectPlan'));
    }


    public function go_to_objective($id)
    {
        // Fetch a single project plan instance based on project_id
        $projectPlan = Project_Plan::where('project_id', $id)->firstOrFail();
    
        // Return the view with the single project plan instance
        return view('projectManager.add_project_objective', compact('projectPlan'));
    }
    


    public function store_project_objective(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'plan_id' => 'required|exists:project__plans,id', // Ensure plan_id exists in project_plans table
        'description' => 'required|string', // Description is required and must be a string
    ]);

    $id = $validated['plan_id'];

    // Check if an objective already exists for the given plan
    $exists = Project_Objective::where('plan_id', $id)->exists();

    if ($exists) {
        toastr()->timeOut(10000)->closeButton()->warning('Project Objective for this Project Plan has already been created.');
        return redirect()->back();
    }

    // Get the currently authenticated user ID
    $userId = Auth::id();

    // Create a new ProjectObjective using the validated data
    Project_Objective::create([
        'plan_id' => $validated['plan_id'],
        'description' => $validated['description'],
    ]);

    $projectPlan = Project_Plan::find($id);

    // Display a success message using toastr
    toastr()->timeOut(10000)->closeButton()->addSuccess('Project objective added successfully!');

    // Redirect to a relevant page (e.g., dashboard or another view)
    return view('projectManager.add_project_scope', compact('projectPlan'));
}


    public function go_to_scope($id){
        $projectPlan = Project_Plan::where('id', $id)->firstOrFail();
        return view('projectManager.add_project_scope', compact('projectPlan'));
    }


        public function store_project_scope(Request $request)
        {
            // Validate the incoming request data
            $validated = $request->validate([
                'plan_id' => 'required|exists:project__plans,id', // Ensure plan_id exists in project__plans table
                'description' => 'required|string', // Description is required and must be a string
            ]);

            // Check if the scope already exists for the given plan_id
            $existingScope = Project_Scope::where('plan_id', $validated['plan_id'])->first();

            if ($existingScope) {
                toastr()->timeOut(10000)->closeButton()->warning('Project Scope for this Project Plan has already been created.');
                return redirect()->back();
            }

            // Create a new ProjectScope using the validated data
            Project_Scope::create([
                'plan_id' => $validated['plan_id'],
                'description' => $validated['description'],
            ]);

            // Fetch the project plan instance to pass it to the view
            $projectPlan = Project_Plan::findOrFail($validated['plan_id']);

            // Display a success message using toastr
            toastr()->timeOut(10000)->closeButton()->addSuccess('Project scope added successfully!');

            // Redirect to a relevant page (e.g., dashboard or another view)
            return view('projectManager.add_project_deliverable', compact('projectPlan'));
        }


        public function go_to_deliverable($id){
            $projectPlan = Project_Plan::where('id', $id)->firstOrFail();
            return view('projectManager.add_project_deliverable', compact('projectPlan'));
        }


        public function store_project_deliverable(Request $request)
        {
            // Validate the incoming request data
            $validated = $request->validate([
                'plan_id' => 'required|exists:project__plans,id', // Ensure plan_id exists in project_plans table
                'name' => 'required|string|max:255', // Name is required and must be a string with a max length of 255
                'description' => 'nullable|string', // Description is optional and must be a string if provided
                'deadline' => 'required|date', // Deadline is required and must be a valid date
            ]);

            // Check if a deliverable with the same plan_id and name already exists
            $existingDeliverable = Project_Deliverable::where('plan_id', $validated['plan_id'])
                                                    ->where('name', $validated['name'])
                                                    ->first();

            if ($existingDeliverable) {
                // Display a warning message if the deliverable already exists
                toastr()->timeOut(10000)->closeButton()->warning('A deliverable with the same name for this project plan already exists.');
                return redirect()->back();
            }

            // Create a new ProjectDeliverable using the validated data

            Project_Deliverable::create([
                'plan_id' => $validated['plan_id'],
                'name' => $validated['name'],
                'description' => $validated['description'],
                'deadline' => $validated['deadline'],

            ]);

            // Display a success message using toastr
            toastr()->timeOut(10000)->closeButton()->addSuccess('Project deliverable added successfully!');

           

            // Return the view with the project plan and tasks
            return redirect()->back();
        }


        public function go_to_dependencies($id)
            {
                // Retrieve the project plan by its ID
                $projectPlan = Project_Plan::find($id);
                if (!$projectPlan) {
                    // Handle case where project plan does not exist
                    toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                    return redirect()->back();
                }

                // Retrieve the project ID and category from the project plan
                $project_id = $projectPlan->project_id;

                // Retrieve all tasks that belong to the same project and category
                $tasks = Task::where('project_id', $project_id)->get();

                // Return the view with the project plan and tasks
                return view('projectManager.add_project_dependency', compact('projectPlan', 'tasks'));
            }

            public function store_project_dependency(Request $request)
            {
                // Validate the incoming request data
                $validated = $request->validate([
                    'plan_id' => 'required|exists:project__plans,id',
                    'preceding_task_id' => 'required|exists:tasks,id',
                    'dependent_task_id' => 'required|exists:tasks,id|different:preceding_task_id',
                    'dependency_type' => 'required|in:start_to_start,finished_to_start,start_to_finish,finished_to_finish',
                ]);

                $existingDependency = Project_Dependency::where('plan_id', $validated['plan_id'])
                    ->where('preceding_task_id', $validated['preceding_task_id'])
                    ->where('dependent_task_id', $validated['dependent_task_id'])
                    ->first();

                if ($existingDependency) {
                    // Display a warning message using toastr
                    toastr()->timeOut(10000)->closeButton()->warning('This dependency has already been added for this project plan.');
                    return redirect()->back();
                }

                // Create a new ProjectDependency using the validated data
                Project_Dependency::create($validated);

                // Display a success message using toastr
                toastr()->timeOut(10000)->closeButton()->addSuccess('Project dependency added successfully!');

                // Redirect to a relevant page (e.g., dashboard or another view)
                return redirect()->back();
            }

            public function go_to_resources($id){
                $projectPlan = Project_Plan::where('id', $id)->firstOrFail();
                return view('projectManager.add_project_resource', compact('projectPlan'));
            }

            public function store_project_resource(Request $request)
            {
                // Validate the incoming request data
                $validated = $request->validate([
                    'plan_id' => 'required|exists:project__plans,id', // Ensure plan_id exists in project_plans table
                    'name' => 'required|string|max:255', // Name is required and must be a string with a max length of 255
                    'type' => 'required|in:material,labor,equipment,consultant', // Type must be one of the specified values
                    'cost_per_unit' => 'required|numeric|min:0', // Cost per unit is required and must be a positive number
                    'availability' => 'required|integer|min:0', // Availability is required and must be a positive integer
                ]);

                // Check if a resource with the same plan_id and name already exists
                $existingResource = Project_Resource::where('plan_id', $validated['plan_id'])
                    ->where('name', $validated['name'])
                    ->first();

                if ($existingResource) {
                    // Display a warning message using toastr
                    toastr()->timeOut(10000)->closeButton()->warning('A resource with the same name already exists for this project plan.');
                    return redirect()->back();
                }

                // Create a new ProjectResource using the validated data
                Project_Resource::create($validated);

                // Display a success message using toastr
                toastr()->timeOut(10000)->closeButton()->addSuccess('Project resource added successfully!');

                // Redirect to a relevant page (e.g., dashboard or another view)
                return redirect()->back();
            }


            public function go_to_milestones($id){
                $projectPlan = Project_Plan::where('id', $id)->firstOrFail();
                return view('projectManager.add_project_milestone', compact('projectPlan'));
            }


            public function store_project_milestone(Request $request)
            {
                // Validate the incoming request data
                $validated = $request->validate([
                    'plan_id' => 'required|exists:project__plans,id', // Ensure plan_id exists in project_plans table
                    'name' => 'required|string|max:255', // Name is required and must be a string with a max length of 255
                    'description' => 'nullable|string', // Description is optional and must be a string if provided
                    'deadline' => 'required|date', // Deadline is required and must be a valid date
                ]);

                $existingMilestone = Project_Milestone::where('plan_id', $validated['plan_id'])
                    ->where('name', $validated['name'])
                    ->first();

                if ($existingMilestone) {
                    // Display a warning message using toastr
                    toastr()->timeOut(10000)->closeButton()->warning('A Milestone with the same name already exists for this project plan.');
                    return redirect()->back();
                }
            
                // Create a new ProjectMilestone using the validated data
                Project_Milestone::create($validated);
            
                // Display a success message using toastr
                toastr()->timeOut(10000)->closeButton()->addSuccess('Project milestone added successfully!');
            
                // Redirect to a relevant page (e.g., dashboard or another view)
                return redirect()->back();
            }


            public function select_category_to_edit_pp(){
                $category = Category:: orderBy('cat_name' , 'asc')->get();
                return view('projectManager.select_category_to_edit_pp' , compact('category'));
            }

            public function select_project_to_edit_pp($id){
                $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
                $category = Category::find($id);

                if ($project->isEmpty()) {
                    toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
                    return redirect()->back();
                }

                return view('projectManager.select_project_to_edit_pp', compact('project', 'category'));
            }

            public function select_project_plan($id)

                {
                    $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        $hasPermission = $user->permissions()->where('name', 'edit project plan')->exists();

        if (!$hasPermission) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit project plan');
            return redirect()->back();
        }
                    // Check if the project plan exists
                    $projectPlan = Project_Plan::where('project_id', $id)->first();

                    if (!$projectPlan) {
                        // If the project plan does not exist, display a message and suggest creating one
                        toastr()->timeOut(10000)->closeButton()->warning('Project plan not found. Please create a project plan first.');
                        return redirect()->back();
                    }

                    

                    // Return the view with the project plan and its components
                    return view('projectManager.select_project_plan', compact('projectPlan'));
                }

                public function edit_plan($id){
                    $projectPlan = Project_Plan::where('id', $id)->first();
                    $project = Project::where('id',$projectPlan->project_id )->first();

                    if (!$projectPlan) {
                        // If the project plan does not exist, display a message and suggest creating one
                        toastr()->timeOut(10000)->closeButton()->warning('Project plan not found. Please create a project plan first.');
                        return redirect()->back();
                    }

                    return view('projectManager.edit_plan', compact('projectPlan', 'project'));

                }

                public function update_project_plan(Request $request, $id)
                {
                    // Validate the incoming request data
                    $validatedData = $request->validate([
                        'name' => 'required|string|max:255',
                        'description' => 'nullable|string',
                        'start_date' => 'required|date',
                        'deadline' => 'required|date|after_or_equal:start_date',
                    ]);

                    // Find the project plan by ID
                    $projectPlan = Project_Plan::find($id);

                    // Check if a project plan with the same name exists within the same project
                    $planExists = Project_Plan::where('name', $request->input('name'))
                                        ->where('project_id', $projectPlan->project_id)
                                        ->where('id', '!=', $id)
                                        ->exists();

                    if ($planExists) {
                        toastr()->timeOut(10000)->closeButton()->warning('A project plan with this name already exists in the selected project.');
                        return redirect()->back()->withInput();
                    }

                    // Check if there are any changes
                    $noChanges = $projectPlan->name === $request->input('name') &&
                                $projectPlan->description === $request->input('description') &&
                                $projectPlan->start_date === $request->input('start_date') &&
                                $projectPlan->deadline === $request->input('deadline');

                    if ($noChanges) {
                        toastr()->timeOut(10000)->closeButton()->info('No changes made to the project plan.');
                        return redirect()->back();
                    }

                    // Update the project plan
                    $projectPlan->name = $request->input('name');
                    $projectPlan->description = $request->input('description');
                    $projectPlan->start_date = $request->input('start_date');
                    $projectPlan->deadline = $request->input('deadline');
                    $projectPlan->save();

                    toastr()->timeOut(10000)->closeButton()->success('Project plan updated successfully.');
                    return redirect()->back();
                }


                public function edit_objective($id)
                {
                    $objective = Project_Objective::where('plan_id', $id)->first();
                    $projectPlan = Project_Plan::find($id);
                    $project = Project:: where('id' ,$projectPlan->project_id )->first();
                
                    if (!$objective) {
                        toastr()->timeOut(10000)->closeButton()->warning('No project objective found for this project plan. Please create a project objective first.');
                        return redirect()->back();
                    }
                
                    return view('projectManager.edit_objective', compact('objective', 'projectPlan' , 'project'));
                }

                public function update_project_objective(Request $request, $id) {
                    $validatedData = $request->validate([
                        'description' => 'required|string',
                    ]);
                
                    $objective = Project_Objective::find($id);
                
                    if (!$objective) {
                        toastr()->timeOut(10000)->closeButton()->warning('Project objective not found.');
                        return redirect()->back();
                    }
                
                   
                
                    // Check if there are any changes
                    $noChanges =$objective->description === $request->input('description');
                
                    if ($noChanges) {
                        toastr()->timeOut(10000)->closeButton()->info('No changes made to the project objective.');
                        return redirect()->back();
                    }
                
                    // Update the project objective
                    $objective->description = $request->input('description');
                    $objective->save();
                
                    toastr()->timeOut(10000)->closeButton()->success('Project objective updated successfully.');
                    return redirect()->back();
                }


                public function edit_scope($id){
                    $scope = Project_Scope::where('plan_id', $id)->first();
                    $projectPlan = Project_Plan::find($id);
                    $project = Project:: where('id' ,$projectPlan->project_id )->first();
                
                    if (!$scope) {
                        toastr()->timeOut(10000)->closeButton()->warning('No project scope found for this project plan. Please create a project scope first.');
                        return redirect()->back();
                    }
                
                    return view('projectManager.edit_scope', compact('scope', 'projectPlan' , 'project'));
                }


                public function update_project_scope(Request $request , $id){
                    $validatedData = $request->validate([
                        'description' => 'required|string',
                    ]);
                
                    $scope = Project_Scope::find($id);
                
                    if (!$scope) {
                        toastr()->timeOut(10000)->closeButton()->warning('Project scope not found.');
                        return redirect()->back();
                    }
                
                   
                
                    // Check if there are any changes
                    $noChanges = $scope->description === $request->input('description');
                
                    if ($noChanges) {
                        toastr()->timeOut(10000)->closeButton()->info('No changes made to the project scope.');
                        return redirect()->back();
                    }
                
                    // Update the project objective
                    $scope->description = $request->input('description');
                    $scope->save();
                
                    toastr()->timeOut(10000)->closeButton()->success('Project scope updated successfully.');
                    return redirect()->back();
                }



                public function edit_deliverable($id){
                    $projectPlan = Project_Plan::find($id);
                
                    if (!$projectPlan) {
                        toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                        return redirect()->back();
                    }
                
                    $deliverables = Project_Deliverable::where('plan_id', $id)->get();
                
                    if ($deliverables->isEmpty()) {
                        toastr()->timeOut(10000)->closeButton()->warning('No project deliverables found for this project plan. Please create project deliverables first.');
                        return redirect()->back();
                    }
                
                    $project = Project::where('id', $projectPlan->project_id)->first();
                
                    return view('projectManager.edit_deliverable', compact('deliverables', 'projectPlan', 'project'));
                }


                public function edit_deliverable_form($id){
                    $deliverable = Project_Deliverable:: find($id);
                    $projectPlan = Project_Plan::where('id' , $deliverable->plan_id)->first();
                    $project = Project::where('id', $projectPlan->project_id)->first();


                    return view('projectManager.edit_deliverable_form' , compact('deliverable','projectPlan', 'project'));
                }


                public function update_project_deliverable(Request $request, $id)
                {
                    // Validate the incoming request data
                    $request->validate([
                        'name' => 'required|string|max:255',
                        'description' => 'required|string',
                        'deadline' => 'required|date',
                    ]);
                
                    // Retrieve the deliverable to be updated
                    $deliverable = Project_Deliverable::findOrFail($id);
                
                    // Check if there are no changes made
                    if (
                        $deliverable->name === $request->name &&
                        $deliverable->description === $request->description &&
                        $deliverable->deadline === $request->deadline
                    ) {
                        toastr()->info('No changes were made to the deliverable.');
                        return redirect()->back();
                    }
                
                    // Check if there is another deliverable with the same name under the same project plan
                    $existingDeliverable = Project_Deliverable::where('plan_id', $deliverable->plan_id)
                        ->where('name', $request->name)
                        ->where('id', '!=', $id) // Exclude the current deliverable
                        ->first();
                
                    if ($existingDeliverable) {
                        toastr()->error('A deliverable with the same name already exists under this project plan.');
                        return redirect()->back();
                    }
                
                    // Update the deliverable with new data
                    $deliverable->name = $request->name;
                    $deliverable->description = $request->description;
                    $deliverable->deadline = $request->deadline;
                    $deliverable->save();
                
                    // Success message and redirect
                    toastr()->success('Deliverable updated successfully.');
                    return redirect()->back();
                }

                public function edit_dependency($id)
                    {
                        $projectPlan = Project_Plan::find($id);

                        if (!$projectPlan) {
                            toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                            return redirect()->back();
                        }

                        $dependencies = Project_Dependency::where('plan_id', $id)->with(['precedingTask', 'dependentTask'])->get();

                        if ($dependencies->isEmpty()) {
                            toastr()->timeOut(10000)->closeButton()->warning('No project dependencies found for this project plan. Please create project dependencies first.');
                            return redirect()->back();
                        }

                        $project = Project::where('id', $projectPlan->project_id)->first();

                        return view('projectManager.edit_dependency', compact('dependencies', 'projectPlan', 'project'));
                    }

                    public function edit_dependency_form($id)
                    {
                        // Find the project dependency by ID
                        $dependency = Project_Dependency::find($id);

                        if (!$dependency) {
                            toastr()->timeOut(10000)->closeButton()->warning('Dependency not found.');
                            return redirect()->back();
                        }

                        // Find the project plan
                        $projectPlan = Project_Plan::find($dependency->plan_id);
                        $project = Project::where('id', $projectPlan->project_id)->first();


                        if (!$projectPlan) {
                            toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                            return redirect()->back();
                        }

                        // Get all tasks related to the project
                        $tasks = Task::where('project_id', $projectPlan->project_id)->get();

                        return view('projectManager.edit_dependency_form', compact('dependency', 'projectPlan', 'tasks', 'project'));
                    }

                    public function update_project_dependency(Request $request, $id)
                    {
                        // Validate the input data
                        $request->validate([
                            'preceding_task_id' => 'required|exists:tasks,id',
                            'dependent_task_id' => 'required|different:preceding_task_id|exists:tasks,id',
                            'dependency_type' => 'required|in:start_to_start,finished_to_start,start_to_finish,finished_to_finish',
                        ]);

                        // Find the project dependency by ID
                        $dependency = Project_Dependency::find($id);

                        if (!$dependency) {
                            toastr()->timeOut(10000)->closeButton()->warning('Dependency not found.');
                            return redirect()->back();
                        }

                        // Check if there are any changes
                        $hasChanges = (
                            $dependency->preceding_task_id != $request->preceding_task_id ||
                            $dependency->dependent_task_id != $request->dependent_task_id ||
                            $dependency->dependency_type != $request->dependency_type
                        );

                        if (!$hasChanges) {
                            toastr()->timeOut(10000)->closeButton()->info('No changes detected.');
                            return redirect()->back();
                        }

                        // Check if another dependency exists with the same preceding and dependent tasks under the same plan
                        $existingDependency = Project_Dependency::where('plan_id', $dependency->plan_id)
                            ->where('preceding_task_id', $request->preceding_task_id)
                            ->where('dependent_task_id', $request->dependent_task_id)
                            ->where('id', '!=', $id)
                            ->first();

                        if ($existingDependency) {
                            toastr()->timeOut(10000)->closeButton()->error('A dependency with the same preceding and dependent tasks already exists.');
                            return redirect()->back();
                        }

                        // Update the project dependency
                        $dependency->preceding_task_id = $request->preceding_task_id;
                        $dependency->dependent_task_id = $request->dependent_task_id;
                        $dependency->dependency_type = $request->dependency_type;
                        $dependency->save();

                        toastr()->timeOut(10000)->closeButton()->success('Dependency updated successfully.');
                        return redirect()->back(); // Redirect to a relevant route
                    }


                    public function edit_milestone($id){

                        $projectPlan = Project_Plan::find($id);

                        if (!$projectPlan) {
                            toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                            return redirect()->back();
                        }

                        $milestone = Project_Milestone::where('plan_id', $id)->get();

                        if ($milestone->isEmpty()) {
                            toastr()->timeOut(10000)->closeButton()->warning('No project milestones found for this project plan. Please create project milestone first.');
                            return redirect()->back();
                        }

                        $project = Project::where('id', $projectPlan->project_id)->first();

                        return view('projectManager.edit_milestone', compact('milestone', 'projectPlan', 'project'));
                    }

                    public function edit_milestone_form($id){
                        $milestone = Project_Milestone:: find($id);
                        $projectPlan = Project_Plan::where('id' , $milestone->plan_id)->first();
                        $project = Project::where('id', $projectPlan->project_id)->first();
    
    
                        return view('projectManager.edit_milestone_form' , compact('milestone','projectPlan', 'project'));

                    }

                    public function update_project_milestone(Request $request, $id)
                    {
                        // Validate the input data
                        $request->validate([
                            'name' => 'required|string|max:255',
                            'description' => 'required|string',
                            'deadline' => 'required|date|after_or_equal:today',
                        ]);
                    
                        // Find the milestone by ID
                        $milestone = Project_Milestone::find($id);
                    
                        if (!$milestone) {
                            toastr()->timeOut(10000)->closeButton()->warning('Milestone not found.');
                            return redirect()->back();
                        }
                    
                        // Check for changes
                        $hasChanges = (
                            $milestone->name != $request->name ||
                            $milestone->description != $request->description ||
                            $milestone->deadline != $request->deadline
                        );
                    
                        if (!$hasChanges) {
                            toastr()->timeOut(10000)->closeButton()->info('No changes detected.');
                            return redirect()->back();
                        }
                    
                        // Check if another milestone with the same name exists under the same project plan
                        $existingMilestone = Project_Milestone::where('plan_id', $milestone->plan_id)
                            ->where('name', $request->name)
                            ->where('id', '!=', $id)
                            ->first();
                    
                        if ($existingMilestone) {
                            toastr()->timeOut(10000)->closeButton()->error('A milestone with the same name already exists under this project plan.');
                            return redirect()->back();
                        }
                    
                        // Update the milestone
                        $milestone->name = $request->name;
                        $milestone->description = $request->description;
                        $milestone->deadline = $request->deadline;
                        $milestone->save();
                    
                        toastr()->timeOut(10000)->closeButton()->success('Milestone updated successfully.');
                        return redirect()->back();
                    }

                    public function edit_resource($id){
                        $projectPlan = Project_Plan::find($id);

                        if (!$projectPlan) {
                            toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                            return redirect()->back();
                        }

                        $resource = Project_Resource::where('plan_id', $id)->get();

                        if ($resource->isEmpty()) {
                            toastr()->timeOut(10000)->closeButton()->warning('No project resources found for this project plan. Please create project resource first.');
                            return redirect()->back();
                        }

                        $project = Project::where('id', $projectPlan->project_id)->first();

                        return view('projectManager.edit_resource', compact('resource', 'projectPlan', 'project'));
                    }

                    public function edit_resource_form($id){
                        $resource = Project_Resource:: find($id);
                        $projectPlan = Project_Plan::where('id' , $resource->plan_id)->first();
                        $project = Project::where('id', $projectPlan->project_id)->first();
    
    
                        return view('projectManager.edit_resource_form' , compact('resource','projectPlan', 'project'));
                    }




                    public function update_project_resource(Request $request, $id)
                    {
                        // Validate the incoming request data
                        $request->validate([
                            'name' => 'required|string|max:255',
                            'type' => 'required|string',
                            'cost_per_unit' => 'required|numeric',
                            'availability' => 'required|numeric',
                        ]);
                    
                        // Find the resource to be updated
                        $resource = Project_Resource::find($id);
                    
                        if (!$resource) {
                            toastr()->timeOut(10000)->closeButton()->error('Resource not found.', 'Error');
                            return redirect()->back();
                        }
                    
                        // Check if the new name already exists under the same project plan
                        $existingResource = Project_Resource::where('plan_id', $resource->plan_id)
                            ->where('name', $request->name)
                            ->where('id', '!=', $id)
                            ->first();
                    
                        if ($existingResource) {
                            toastr()->timeOut(10000)->closeButton()->error('A resource with the same name already exists under this project plan.');
                            return redirect()->back();
                        }
                    
                        // Check if there are any changes
                        $hasChanges = $resource->name != $request->name ||
                                      $resource->type != $request->type ||
                                      $resource->cost_per_unit != $request->cost_per_unit ||
                                      $resource->availability != $request->availability;
                    
                        if (!$hasChanges) {
                            toastr()->timeOut(10000)->closeButton()->info('No changes were made to the resource.');
                            return redirect()->back();
                        }
                    
                        // Update the resource details if changes were made
                        $resource->name = $request->name;
                        $resource->type = $request->type;
                        $resource->cost_per_unit = $request->cost_per_unit;
                        $resource->availability = $request->availability;
                        $resource->save();
                    
                        // Display success message and redirect
                        toastr()->timeOut(10000)->closeButton()->success('Resource updated successfully.');
                        return redirect()->back();
                    }


                    public function select_category_to_delete_pp(){
                        $category = Category:: orderBy('cat_name' , 'asc')->get();
                        return view('projectManager.select_category_to_delete_pp' , compact('category'));
                    }
                    
                    public function select_project_to_delete_pp($id){
                        $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
                        $category = Category::find($id);

                        if ($project->isEmpty()) {
                            toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
                            return redirect()->back();
                        }

                        return view('projectManager.select_project_to_delete_pp', compact('project', 'category'));
                    }

                    public function select_project_plan_to_delete($id){
                        {
                            // Check if the project plan exists
                            $projectPlan = Project_Plan::where('project_id', $id)->first();
        
                            if (!$projectPlan) {
                                // If the project plan does not exist, display a message and suggest creating one
                                toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                                return redirect()->back();
                            }
        
                            
        
                            // Return the view with the project plan and its components
                            return view('projectManager.select_project_plan_to_delete', compact('projectPlan'));
                        }

 
              }
              
              public function delete_plan($id){
                $projectPlan = Project_Plan::where('id', $id)->first();
                if (!$projectPlan) {
                    // If the project plan does not exist, display a message and suggest creating one
                    toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                    return redirect()->back();
                }

                $projectPlan->delete();
                toastr()->timeOut(10000)->closeButton()->addSuccess('Project plan deleted successfully');
                return redirect()->back();
              }

              public function delete_objective($id){
                $objective = Project_Objective::where('plan_id', $id)->get();
                    if (!$objective) {
                        toastr()->timeOut(10000)->closeButton()->warning('No project objective found for this project plan.');
                        return redirect()->back();
                    }

                    $objectiveDel = Project_Objective:: find($objective->id);

                $objectiveDel->delete();
                toastr()->timeOut(10000)->closeButton()->addSuccess('Project objective deleted successfully');
                return redirect()->back();
              }

}



 
 


// public function select_category_to_edit_pp(){
//                 $category = Category:: orderBy('cat_name' , 'asc')->get();
//                 return view('projectManager.select_category_to_edit_pp' , compact('category'));
//             }

//             public function select_project_to_edit_pp($id){
//                 $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
//                 $category = Category::find($id);

//                 if ($project->isEmpty()) {
//                     toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
//                     return redirect()->back();
//                 }

//                 return view('projectManager.select_project_to_edit_pp', compact('project', 'category'));
//             }