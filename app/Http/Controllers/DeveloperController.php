<?php
namespace App\Http\Controllers;

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

class DeveloperController extends Controller
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

        return view('developer.dashboard', compact('data','projects','pending','completed','tasks'));
    }

   
    //view profile 
    public function dev_view_profile(){
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('developer.dev_view_profile', compact('data'));
    }
    //edit profile 
    public function edit_developer_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);

        return view('developer.edit_developer_profile', compact('data'));

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

        return redirect()->route('developer.dashboard');

    }
       //  changee password 
       public function changee_password_dt()
       {
           $user = Auth::user();
           $user_id = $user->id;    // logged in User Id
           $data = User::find($user_id);
           return view('developer.changee_password_dt', compact('data'));
   
       }
        //    change password update
        public function changePassword_dev_team(Request $request)
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
            return redirect()->route('developer.dashboard');
        }


     // Method to view feedback
    public function view_feedback()
    { 
         $user = Auth::user();
         $user_id = $user->id; // Logged in User ID
         $data = User::find($user_id);
 
         // Fetch feedbacks from the database
         $feedbacks = Feedback::with(['customer', 'project'])->get();
 
         // Pass both variables to the view
         return view('developer.view_feedback', compact('data', 'feedbacks'));
     }

     // Method to view feedback detalis
    public function view_feedback_details($id)
    {
        $data = Category::find($id);

        return view('developer.view_feedback_details', compact('data'));
    }
    public function view_project_plans()
    {
        $user = Auth::user();
        $user_id = $user->id; // Logged in User ID
        $data = User::find($user_id);

        // Fetch project plans from the database
        $category  = Category::orderBy('created_at','desc')->get();  // Ensure Project model is correctly imported
        
        return view('developer.view_project_plans', compact('data', 'category'));
    }
    


    public function viewProjectsByCategory_DT($id)
    {
        // Get the logged-in user
        $user = Auth::user();
        $user_id = $user->id; // Logged in User ID
         $data = User::find($user_id);
    
        // Fetch the category and its projects, excluding those with unapproved project plans
        $category = Category::with(['projects' => function ($query) {
            $query->whereHas('projectPlans', function($subQuery) {
                $subQuery->where('status', 'approved');
            });
        }])->findOrFail($id);
    
        // Check if the category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }
    
        // Fetch projects under this category where the project plans are approved
        $projects = $category->projects;
    
        // Loop through the projects to get the assigned tasks and check if the logged-in user is assigned
        foreach ($projects as $project) {
           // $project->assignedTasks = $project->tasks()->where('assigned_to', $user_id)->get();
            $project->planStatus = $project->projectPlans->first()->status ?? 'Not Approved';
        }

        return view('developer.view_projects_by_category_developer', compact('data', 'projects','category'));
    }
    


    public function view_project_details_developer($id)
    {
        $user = Auth::user();
        $data = User::find($user->id);
        $project = Project::find($id);


        return view('developer.view_project_details_developer', compact('data','project'));

        
    }
     //view List the task
     public function view_task_list()
     {
         $user = Auth::user();
         $user_id = $user->id; // Logged in User ID
         $data = User::find($user_id);
 
         $tasks = Task::all();
         return view('developer.view_task_list', compact('data','tasks'));
     }
         //Veiw details of the task list
    public function view_task_detail($id)
    {
        $user = Auth::user();
        $user_id = $user->id; // Logged in User ID
        $data = User::find($user_id);
        $task = Task::find($id);
  
        return view('developer.view_task_detail', compact('data','task'));
    }
    // edite developer 
    public function developer_image_edit()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('developer.developer_image_edit', compact('data'));
         // Ensure you have a corresponding view file
    }
        // developer Image edit
    public function update_developer_image(Request $request, $id)
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
    
              return redirect()->route('developer.dashboard');
        }

}
