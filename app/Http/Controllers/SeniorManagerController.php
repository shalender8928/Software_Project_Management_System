<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\Developer_has_Task;
use App\Models\Project_Plan;
use App\Models\Project_Objective;
use App\Models\Project_Scope;
use App\Models\Project_Deliverable;
use App\Models\Project_Dependency;
use App\Models\Project_Milestone;
use App\Models\Project_Resource;


class SeniorManagerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $data = User::find($user->id);
        // Fetch the count of projects
        $projects = Project::count();
       // Fetch the count of pending projects
        $pending = Project::where('status', 'pending')->count();
       // Fetch the count of completed projects
        $completed = Project::where('status', 'completed')->count();

      // Fetch the count of tasks
      $tasks = Task::count();
    // Fetch the count of project managers
    $projectManagerRole =  User::role('Project Manager')->count();

    // Fetch the count of developers

    $developers =  User::role('developer')->count();

       // Count the number of approved projects
    $approvedProjectsCount = Project_Plan::where('status', 'approved')->count();

     // Count the number of approved projects
     $rejectedProjectsCount = Project_Plan::where('status', 'rejected')->count();
        
   return view('seniorManager.dashboard', compact('data', 'projects', 'pending', 'completed','tasks','projectManagerRole','developers','approvedProjectsCount','rejectedProjectsCount'));
      
    }
    public function mange_view_profile(){
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('seniorManager.mange_view_profile', compact('data'));
    }
    public function edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('seniorManager.edit_profile', compact('data'));

    }
      //update profile
      public function update_profile(Request $request, $id)
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
 
         return redirect()->route('seniorManager.dashboard');
 
     }
    //  changee password 
     public function changee_password_sm()
     {
         $user = Auth::user();
         $user_id = $user->id;    // logged in User Id
         $data = User::find($user_id);
         return view('seniorManager.changee_password_sm', compact('data'));
 
     }
     public function changePassword(Request $request)
     {
         // Validate the request
         $request->validate([
             'current_password' => 'required',
             'new_password' => 'required|min:8|confirmed', // 'confirmed' checks new_password_confirmation
         ]);
 
         // Check if the current password matches
         if (!Hash::check($request->current_password, Auth::user()->password)) {
             toastr()->error('Current Password Does Not Match');
             return redirect()->back();
         }
 
         // Update the new password
         User::whereId(auth()->user()->id)->update([
             'password' => Hash::make($request->new_password),
         ]);
 
         toastr()->success('Password successfully changed');
         return redirect()->route('seniorManager.dashboard');
     }
     public function view_project_list()
     {
         $user = Auth::user();
         $user_id = $user->id; // Logged in User ID
         $data = User::find($user_id);
     
         // Fetch project plans from the database
         $category  = Category::orderBy('created_at','desc')->get();
        return view('seniorManager.view_project_list', compact('data','category'));
     }
     public function view_project_details($id)
     {
         $user = Auth::user();
         $data = User::find($user->id);
         $project = Project::find($id);

 
         return view('seniorManager.view_project_details', compact('data','project'));
 
         
     }
    // view the project manager 
    public function view_project_managers()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
    
        // Fetching users with the role of 'Project Manager'
        $projectManagerRole = Role::where('name', 'Project Manager')->first();
        
        if ($projectManagerRole) {
            $projectManagers = User::whereHas('roles', function($query) use ($projectManagerRole) {
                $query->where('role_id', $projectManagerRole->id);
            })->get();
        } else {
            $projectManagers = collect();
        }
    
        $count = $projectManagers->count();
    
        return view('seniorManager.view_project_managers', compact('data', 'projectManagers', 'count'));
    }
    public function viewProjectManagerDetails($id)
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
          // Fetch the manager by ID
          $manager = User::with('roles')->findOrFail($id);

        // Pass the manager to the view
        return view('seniorManager.view_project_manager_details', compact('data','manager'));
    }
    public function viewProjectManagerAddress($id)
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        // Fetch the user details
        $user = DB::table('users')->where('id', $id)->first();

        // Fetch the address details
        $address = DB::table('addresses')->where('user_id', $id)->first();

        return view('seniorManager.view_project_manager_address', compact('data','user', 'address'));
    }
    public function viewListDevelopers()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        // Fetching users with the role of 'Developer'
        $developerRole = Role::where('name', 'Developer')->first();
        
        if ($developerRole) {
            $developers = User::whereHas('roles', function($query) use ($developerRole) {
                $query->where('role_id', $developerRole->id);
            })->get();
        } else {
            $developers = collect();
        }
        $count = $developers->count();
        return view('seniorManager.view_list_developere', compact('data', 'developers', 'count'));
    }
    public function viewProjectDevelopereDetails($id)
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
          // Fetch the manager by ID
          $developer = User::with('roles')->findOrFail($id);

                  // Fetch the address details
        $address = DB::table('addresses')->where('user_id', $id)->first();

        // Pass the manager to the view
        return view('seniorManager.view_projec_developer_details', compact('data','developer','address'));
    }
    public function viewProjectsByCategory($id)
   {
    // Get the logged-in user
    $user = Auth::user();
    $user_id = $user->id;  // Logged in User ID
    $data = User::find($user_id);

    // Fetch the category and its projects, excluding those with approved project plans
    $category = Category::with(['projects' => function ($query) {
        $query->whereDoesntHave('projectPlans', function ($subQuery) {
            $subQuery->where('status', 'approved');
        });
    }])->findOrFail($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Category not found.');
    }

    // Retrieve the projects within the category
    $projects = $category->projects;

    // Pass the data to the view
    return view('seniorManager.view_projects_by_category', compact('data', 'projects'));
    
    }
    


     
        // Show the form to edit the profile image
        public function editImage()
        {
            $user = Auth::user();
            $user_id = $user->id;    // logged in User Id
            $data = User::find($user_id);
            return view('seniorManager.image_edit', compact('data'));
             // Ensure you have a corresponding view file
        }
        public function update_profile_image(Request $request, $id)
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
    
            return redirect()->route('seniorManager.dashboard');

        }
        public function View_project_Details_with_project_plan($id)
        {
            // Fetch the project plan
            $projectPlan = Project_Plan::where('project_id', $id)->first();
            $data = Auth::user();
        
            if (!$projectPlan) {
                // If the project plan does not exist, display a message and suggest creating one
                toastr()->timeOut(10000)->closeButton()->warning('Project plan not found. Please create a project plan first.');
                return redirect()->back();
            }
        
            // Check the status of the project plan
            if ($projectPlan->status == 'approved') {
                // Redirect if the status is 'approved'
                toastr()->timeOut(10000)->closeButton()->success('This project plan has been approved and is no longer available for modification.');
                return redirect()->route('seniorManager.dashboard');
            }
        
            // Return the view with the project plan and its components
            return view('seniorManager.View_project_Details_with_project_plan', compact('projectPlan', 'data'));
        }
        
        // View project plan Details
        public function view_project_plan($id){
            $data = Auth::user();
            $projectPlan = Project_Plan::where('id', $id)->first();
            $project = Project::where('id',$projectPlan->project_id )->first();

            if (!$projectPlan) {
                // If the project plan does not exist, display a message and suggest creating one
                toastr()->timeOut(10000)->closeButton()->warning('Project plan not found. Please create a project plan first.');
                return redirect()->back();
            }

            return view('seniorManager.view_project_plan', compact('projectPlan', 'project','data'));

        }
        //View project Plan Objective
        public function view_objective_of_project_plan($id)
        {
            $data = Auth::user();
            $objective = Project_Objective::where('plan_id', $id)->first();
            $projectPlan = Project_Plan::find($id);
            $project = Project:: where('id' ,$projectPlan->project_id )->first();
        
            if (!$objective) {
                toastr()->timeOut(10000)->closeButton()->warning('No project objective found for this project plan. Please create a project objective first.');
                return redirect()->back();
            }
        
            return view('seniorManager.view_objective_of_project_plan', compact('objective', 'projectPlan' , 'project','data'));
        }
        // View project plan scop
        public function view_project_plan_scope($id){
            $data = Auth::user();
            $scope = Project_Scope::where('plan_id', $id)->first();
            $projectPlan = Project_Plan::find($id);
            $project = Project:: where('id' ,$projectPlan->project_id )->first();
        
            if (!$scope) {
                toastr()->timeOut(10000)->closeButton()->warning('No project scope found for this project plan. Please create a project scope first.');
                return redirect()->back();
            }
        
            return view('seniorManager.view_project_plan_scope', compact('scope', 'projectPlan' , 'project','data'));
        }
        // View project  Deliverable
        public function view_project_deliverable($id)
        {
            $data = Auth::user();
            $deliverable = Project_Deliverable:: find($id);
            $projectPlan = Project_Plan::where('id' , $deliverable->plan_id)->first();
            $project = Project::where('id', $projectPlan->project_id)->first();


            return view('seniorManager.view_project_deliverable' , compact('deliverable','projectPlan', 'project','data'));
        }
        public function view_project_dependency($id)
        {
            $user = Auth::user();
            $data = User::find($user->id);
        
            // Find the project dependency
            $dependency = Project_Dependency::find($id);
        
            // Check if the dependency exists
            if (!$dependency) {
                toastr()->timeOut(10000)->closeButton()->warning('Dependency not found.');
                return redirect()->back();
            }
        
            // Find the project plan
            $projectPlan = Project_Plan::find($dependency->plan_id);
        
            // Check if the project plan exists
            if (!$projectPlan) {
                toastr()->timeOut(10000)->closeButton()->warning('Project plan not found.');
                return redirect()->back();
            }
        
            $project = Project::where('id', $projectPlan->project_id)->first();
        
            // Get all tasks related to the project
            $tasks = Task::where('project_id', $projectPlan->project_id)->get();
        
            // Return the view with the necessary data
            return view('seniorManager.view_project_dependency', compact('data', 'dependency', 'projectPlan', 'project', 'tasks'));
        }
        public function view_project_milestone($id)
        {
            $data = Auth::user();
            $milestone = Project_Milestone::find($id);
        
            if (!$milestone) {
                // Handle the case where the milestone is not found
                return redirect()->back()->with('error', 'Milestone not found');
                
            }
        
            $projectPlan = Project_Plan::where('id', $milestone->plan_id)->first();
        
            if (!$projectPlan) {
                // Handle the case where the project plan is not found
                return redirect()->back()->with('error', 'Project plan not found');
            }
        
            $project = Project::where('id', $projectPlan->project_id)->first();
        
            if (!$project) {
                // Handle the case where the project is not found
                return redirect()->back()->with('error', 'Project not found');
            }
        
            return view('seniorManager.view_project_milestone', compact('milestone', 'projectPlan', 'project', 'data'));
        }
        public function view_project_resource($id)
        {
            $user = Auth::user();
            $data = User::find($user->id);
            $resource = Project_Resource:: find($id);
            $projectPlan = Project_Plan::where('id' , $resource->plan_id)->first();
            $project = Project::where('id', $projectPlan->project_id)->first();
            return view('seniorManager.view_project_resource' , compact('resource','projectPlan', 'project','data'));
        }
         //    project aproved
        public function approve($id)
        {
        // Fetch the project plan by its ID
        $projectPlan = Project_Plan::find($id);
    
        // Check if the project plan exists and its status is 'draft'
        if ($projectPlan && $projectPlan->status === 'draft') {
            // Update the status to 'approved'
            $projectPlan->status = 'approved';
            $projectPlan->approved_by = auth()->user()->id;
            $projectPlan->approved_on = now();
    
            // Save the changes
            $projectPlan->save();
    
           
    
        // Display success notification and redirect to the approved project list page
        toastr()->timeOut(10000)->closeButton()->success('Project Plan approved and deleted successfully.');
        return redirect()->route('seniorManager.approved_project_page');
        }
    
    // If the project plan doesn't exist or isn't in draft status, display warning and redirect back
    toastr()->timeOut(10000)->closeButton()->warning('Project Plan not found or not in draft status.');
    return redirect()->route('seniorManager.approved_project_page');
    }
    // approvedProjectPage
    public function approvedProjectPage()
    {
        $data = Auth::user();
        // Count of approved projects
        $count = Project_Plan::where('status', 'approved')->count();

    
        // Fetch approved project plans with related project, category, and user data
        $approvedProjects = Project_Plan::where('status', 'approved')->with(['project.category', 'createdBy', 'approvedBy'])
            ->paginate(10);
    
        return view('seniorManager.approved_project_page', compact('data', 'approvedProjects','count'));
    }
    // rejectProject
    public function showRejectionForm($id)
    {
        $data = Auth::user();
        $projectPlan = Project_Plan::find($id);

        if ($projectPlan) {
            $showRejectionForm = true; // This will trigger the display of the form
            return view('seniorManager.reject_project', compact('projectPlan', 'showRejectionForm','data'));
        } else {
            return redirect()->back()->with('error', 'Project Plan not found.');
        }
    }
    // rejectProject
    public function rejectProject(Request $request, $id)
    {
        // Fetch the project plan by its ID
        $projectPlan = Project_Plan::find($id);
    
        // Check if the project plan exists and its status is 'draft'
        if ($projectPlan && $projectPlan->status === 'draft') {
            // Update the status to 'rejected'
            $projectPlan->status = 'rejected';
            $projectPlan->rejection_reason = $request->input('rejection_reason');
            $projectPlan->approved_by = auth()->user()->id;
            $projectPlan->approved_on = now();
    
            // Save the changes
            $projectPlan->save();
    
           
    
            // Display success notification and redirect to the rejected project list page
            toastr()->timeOut(10000)->closeButton()->success('Project Plan rejected and deleted successfully.');
            return redirect()->route('seniorManager.reject_project_list');
        }
    
        // If the project plan doesn't exist or isn't in draft status, display warning and redirect back
        toastr()->timeOut(10000)->closeButton()->warning('Project Plan not found or not in draft status.');
        return redirect()->route('seniorManager.rejected_project_list');
    }
    
    // rejectProjectPage
    public function rejectProjectPage()
    {
        $data = Auth::user();
        // Count of approved projects
        $count = Project_Plan::where('status', 'rejected')->count();

    
        // Fetch approved project plans with related project, category, and user data
        $rejectedProjects = Project_Plan::where('status', 'rejected')->with(['project.category', 'createdBy', 'approvedBy'])
            ->paginate(10);
    
        return view('seniorManager.reject_project_list', compact('data', 'rejectedProjects','count'));
    }
    
    public function reject_approved_project($id)
    {
        $data = Auth::user();
        $projectPlan = Project_Plan::find($id);

        if ($projectPlan) {
            $showRejectionForm = true; // This will trigger the display of the form
            return view('seniorManager.reject_approved_project', compact('projectPlan', 'showRejectionForm','data'));
        } else {
            return redirect()->back()->with('error', 'Project Plan not found.');
        }
    }
    // reject_approved_pp
    public function reject_approved_pp(Request $request, $id)
    {
        // Fetch the project plan by its ID
        $projectPlan = Project_Plan::find($id);
    
        // Check if the project plan exists and its status is 'approved'
        if ($projectPlan && $projectPlan->status === 'approved') {
            // Update the status to 'rejected'
            $projectPlan->status = 'rejected';
            $projectPlan->rejection_reason = $request->input('rejection_reason');
            $projectPlan->rejected_by = auth()->user()->id; // Track who rejected it
            $projectPlan->rejected_on = now();
    
            // Save the changes to the database
            $projectPlan->save();
    
            // Display success notification and redirect to the rejected project list page
            toastr()->timeOut(10000)->closeButton()->success('Project Plan status updated to "rejected" successfully.');
            return redirect()->route('seniorManager.reject_project_list');
        }
    
        // If the project plan doesn't exist or isn't in 'approved' status, display warning and redirect back
        toastr()->timeOut(10000)->closeButton()->warning('Project Plan not found or not in approved status.');
        return redirect()->route('seniorManager.reject_project_list');
    }
    public function approved_reject_project($id)
    {
    // Fetch the project plan by its ID
    $projectPlan = Project_Plan::find($id);

    // Check if the project plan exists and its status is 'draft'
    if ($projectPlan && $projectPlan->status === 'rejected') {
        // Update the status to 'approved'
        $projectPlan->status = 'approved';
        $projectPlan->approved_by = auth()->user()->id;
        $projectPlan->approved_on = now();

        // Save the changes
        $projectPlan->save();

       

    // Display success notification and redirect to the approved project list page
    toastr()->timeOut(10000)->closeButton()->success('Project Plan status updated to "approved" successfully.');
    return redirect()->route('seniorManager.approved_project_page');
    }

// If the project plan doesn't exist or isn't in draft status, display warning and redirect back
  toastr()->timeOut(10000)->closeButton()->warning('Project Plan not found or not in draft status.');
  return redirect()->route('seniorManager.approved_project_page');

}
    
    
 

    
}