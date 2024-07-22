<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Feedback;

class DeveloperController extends Controller
{
    public function dashboard()
    {
        // Fetch user data or any other relevant data
        $data = Auth::user(); // Assuming you are fetching the authenticated user's data

        // Pass the data to the view
        return view('developer.dashboard', compact('data'));
    }

   
    //view profile 
    public function dev_view_profile(){
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('developer.dev_view_profile', compact('data'));
    }
    //edit profile 
    public function edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);


        return view('developer.edit_profile', compact('data'));

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

}
