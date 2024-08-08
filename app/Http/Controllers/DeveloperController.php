<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

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
        $projects = Project::all();  // Ensure Project model is correctly imported
        
        return view('developer.view_project_plans', compact('data', 'projects'));
    }
    public function view_details_project($id)
    {
        $user = Auth::user();
        $data = User::find($user->id);
        $project = Project::find($id);
        $project = Project::find($id);

        return view('developer.view_details_project', compact('data','project'));

        
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
