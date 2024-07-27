<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;


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
        
   return view('seniorManager.dashboard', compact('data', 'projects', 'pending', 'completed','tasks','projectManagerRole','developers'));
      
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
     public function view_project_list()
     {
         $user = Auth::user();
         $user_id = $user->id; // Logged in User ID
         $data = User::find($user_id);
     
         // Fetch project plans from the database
         $projects = Project::all();  // Ensure Project model is correctly imported
         
         return view('seniorManager.view_project_list', compact('data', 'projects'));
     }
     public function view_project_details($id)
     {
         $user = Auth::user();
         $data = User::find($user->id);
         $project = Project::find($id);

 
         return view('seniorManager.view_project_details', compact('data','project'));
 
         
     }
     public function approveProject($id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);
        
        // Update the status to "Approved"
        $project->status = 'Approved';
        $project->save();
        
        // Redirect back with a success message
        return redirect()->route('seniorManager.view_project_list')->with('success', 'Project approved successfully.');
    }
    public function rejectProject($id)
    {
        // Find the project by ID
        $project = Project::findOrFail($id);
        
        // Update the status to "Rejected"
        $project->status = 'Rejected';
        $project->save();
        
        // Redirect back with a success message
        return redirect()->route('seniorManager.view_project_list')->with('success', 'Project rejected successfully.');
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
    
}
