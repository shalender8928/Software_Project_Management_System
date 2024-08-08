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


    public function view_task_list($id){
        $tasks = Task::with('project')->where('project_id', $id)->orderBy('name', 'asc')->get();
        return view('projectManager.view_task_list', compact('tasks'));
    }

    public function view_task_detail($id)
    {
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
        $project = Project:: where('category_id' , $id)->orderBy('name' ,'asc')->get();
        return view('projectManager.select_project_to_update_assigned_task',compact('project'));
    }

    public function select_task($id)
    {
        // Retrieve tasks that have an assigned user
        $tasks = Task::with(['project.category', 'developerHasTasks.user'])
            ->whereHas('developerHasTasks', function ($query) {
                $query->where('status', 'assigned');
            })->get();

        // Check if tasks are found
        if ($tasks->isEmpty()) {
            toastr()->timeOut(10000)->closeButton()->warning('No tasks with assigned users found.');
            return redirect()->back();
        }

        // Return the view with tasks
        return view('projectManager.select_task', compact('tasks'));
    }


    

    public function select_assigned_user($id)
{
    

    // Get the task assignment details
    $taskAssignment = Developer_has_Task::where('task_id', $id)->first();

    if ($taskAssignment) {
        // Retrieve the related task and user
        $task = Task::find($taskAssignment->task_id);
        $user = User::find($taskAssignment->user_id);

     
        // Merge free and assigned developers
        $developers = $freeDevelopers->merge($assignedDevelopers);

        // Pass the data to the view
        return view('projectManager.select_assigned_user', compact('taskAssignment', 'task', 'user'));
    } else {
        // If no task assignment found, redirect back with an error message
        toastr()->timeOut(10000)->closeButton()->warning('No task assignment found for the given task');
        return redirect()->back();
    }
}


public function assign_task_update_post(Request $request, $id)
{
    $task = Task::findOrFail($id);
    $newDeveloperId = $request->user_id;
    $currentAssignment = Developer_has_Task::where('task_id', $id)->first();
    $newAssignment = Developer_has_Task::where('user_id', $newDeveloperId)->first();

    if ($newDeveloperId) {
        if ($newAssignment && $newAssignment->task_id != $id) {
            if ($request->confirm) {
                $newAssignment->delete();
                Developer_has_Task::updateOrCreate(
                    ['task_id' => $id],
                    ['user_id' => $newDeveloperId]
                );
                return response()->json([
                    'status' => 'success',
                ]);
            } else {
                return response()->json([
                    'status' => 'confirm',
                    'message' => 'The selected developer is already assigned to another task. Do you want to reassign the task?'
                ]);
            }
        } else {
            Developer_has_Task::updateOrCreate(
                ['task_id' => $id],
                ['user_id' => $newDeveloperId]
            );
            return response()->json([
                'status' => 'success',
            ]);
        }
    } else {
        if ($currentAssignment) {
            $currentAssignment->delete();
        }
        return response()->json([
            'status' => 'success',
        ]);
    }
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
            Project_Deliverable::create($validated);

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
            




}



 
 




// public function select_category_assign_task(){
//     $category = Category:: orderBy('cat_name' , 'asc')->get();
//     return view('projectManager.select_category_assign_task' , compact('category'));
// }

// public function select_project_to_assign_task($id)
// {
// $project = Project::where('category_id', $id)->orderBy('name', 'asc')->get();
// $category = Category::find($id);

// if ($project->isEmpty()) {
//     toastr()->timeOut(10000)->closeButton()->warning('No projects found under the selected category.');
//     return redirect()->back();
// }

// return view('projectManager.select_project_to_assign_task', compact('project', 'category'));
// }
