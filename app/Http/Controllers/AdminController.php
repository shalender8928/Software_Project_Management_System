<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Address;
use Spatie\Permission\Models\Role;
use App\Models\Category;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);

        return view('admin.edit_profile', compact('data'));

    }

    public function update(Request $request, $id)
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
    $user->firstname = $request->firstname;
    $user->lastname = $request->lastname;
    $user->phone = $request->phone;
    $user->gender = $request->gender;
    $user->age = $request->age;

    if ($request->hasFile('image')) {
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $user->image = $imageName;
    }

    $user->save();

    toastr()->timeOut(10000)->closeButton()->addSuccess('Your Profile has been Successfully Updated');

    return redirect()->route('admin.dashboard');
}

    public function add_employee()
    {
        return view('admin.add_employee');
    }

    public function register_employee(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

    $reg_user = Auth::user();
    $reg_user_id = $reg_user->id; // logged in User Id

    // Check if the user already exists
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        // Create new user if not exists
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->registered_by = $reg_user_id;
        $user->updated_by = $reg_user_id;
        $user->save();
    } else {
        // Update existing user details
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->updated_by = $reg_user_id;
        $user->save();
    }

    // Check if address already exists for the user
    $address = Address::where('user_id', $user->id)->first();

    if (!$address) {
        // Create new address if not exists
        $address = new Address;
        $address->user_id = $user->id;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip_code = $request->zip_code;
        $address->country = $request->country;
    } else {
        // Update existing address details
        $address->street = $request->street;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip_code = $request->zip_code;
        $address->country = $request->country;
    }

    $address->save();
    toastr()->timeOut(10000)->closeButton()->addSuccess('New Employee Added Successfully.');
    return redirect()->route('admin.dashboard');

}    
public function edit()
{
    $roles = ['Developer', 'Senior Manager', 'Project Manager'];

    // Assuming hasRole function checks if the user has any of the specified roles
    $data = User::whereHas('roles', function ($query) use ($roles) {
        $query->whereIn('name', $roles);
    })->orderBy('created_at', 'desc')->get();

    return view('admin.edit', compact('data'));
}

public function update_employee($id){
    $data = User::find($id);
    return view('admin.update_employee', compact('data'));
    
}

public function update_employee_profile(Request $request, $id)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed',
        'phone' => 'required|string|max:15',
        'gender' => 'required|string|max:10',
        'age' => 'required|integer|min:1|max:120',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $reg_user = Auth::user();
    $reg_user_id = $reg_user->id; // logged in User Id

    $user = User::find($id);

    if ($user) {
        // Update existing user details
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->updated_by = $reg_user_id;

        // // Update password if provided
        // if ($request->filled('password')) {
        //     $user->password = Hash::make($request->password);
        // }

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $user->image = $imageName;
        }

        $user->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Employee Details Updated Successfully.');
    } else {
        toastr()->timeOut(10000)->closeButton()->addError('User not found.');
    }

    return redirect()->route('admin.edit');
}



    public function view_profile(){
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);
        return view('admin.view_profile', compact('data'));
    }

    public function delete(){

        $roles = ['Developer', 'Senior Manager', 'Project Manager'];

        // Assuming hasRole function checks if the user has any of the specified roles
        $data = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })->orderBy('created_at', 'desc')->get();
    
        return view('admin.delete', compact('data'));
    }

    public function delete_employee($id){
        $data = User:: find($id);
        if ($data) {
            $data->delete();
            toastr()->timeOut(10000)->closeButton()->success('Category Successfully Deleted');
        } else {
            toastr()->timeOut(10000)->closeButton()->error('Category Not Found');
        }
        return redirect()->back();
    }

    public function view_employee_list(){
        $roles = ['Developer', 'Senior Manager', 'Project Manager'];

        // Assuming hasRole function checks if the user has any of the specified roles
        $data = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })->orderBy('created_at', 'desc')->get();
    
        return view('admin.view_employee_list', compact('data'));
    }

    public function view_employee_detail($id){
        $data = User::find($id);
        return view('admin.view_employee_detail', compact('data'));

    }

    public function add_category(){

        $data = Category::orderBy('created_at', 'desc');
        return view('admin.add_category', compact('data'));
    }

    public function add_new_category(Request $request){
        $request->validate([
            'cat_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            
        ]);

        $logged_user = Auth::user();
        $logged_id  = $logged_user->id;

        $there = $request->cat_name;
        $count = Category::where('cat_name',$there)->count();

        if($count>0){
            toastr()->timeOut(10000)->closeButton()->warning('This Category Already Exists.');
            return redirect()->route('admin.dashboard');
        }

        else{
        $user =  new Category;
        $user->cat_name = $request->cat_name;
        $user->description = $request->description;
        $user->created_by = $logged_id;
        $user->updated_by = $logged_id;

        $user->save();
        toastr()->timeOut(10000)->closeButton()->addSuccess('New Category Added Successfully.');
        return redirect()->back();
        }

        


    }



    public function edit_category(){
        $data = Category::orderBy('created_at','desc')->get();
        return view('admin.edit_category',compact('data'));
    }

    public function update_category($id){
        $data = Category::find($id);

        return view('admin.update_category',compact('data'));
    }

    public function update_pro_category(Request $request, $id)
{
    $request->validate([
        'cat_name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
    ]);

    $reg_user = Auth::user();
    $reg_user_id = $reg_user->id; // logged in User Id

    $category = Category::find($id); // Assuming the model name is Category

    if ($category) {
        $category->cat_name = $request->cat_name;
        $category->description = $request->description;
        $category->updated_by = $reg_user_id; // Assuming 'updated_by' column exists in the 'categories' table

        $category->save();

        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Successfully Updated .');

    } else {
        toastr()->timeOut(10000)->closeButton()->addError('Category not found.');
        return redirect()->back();

    }
    return redirect()->route('admin.edit_category');
}

public function delete_category(){
    $data = Category::orderBy('created_at','desc')->get();
    return view('admin.delete_category',compact('data'));
}


public function delete_pro_category($id){
    $category = category::find($id);

    if(!$category){
            toastr()->timeOut(10000)->closeButton()->error('category does not exist.');
            return redirect()->back();
    }

    else{
        $category->delete();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Category Successfully Deleted.');

    }

    return redirect()->back();
}

    public function view_category_list(){
        $category  = Category::orderBy('created_at','desc')->get();
        return view('admin.view_category_list', compact('category'));
    }

    public function view_category_detail($id){
        $data = Category::find($id);

        return view('admin.view_category_detail', compact('data'));
    }

    public function add_role(){
        return view('admin.add_role');
    }


public function create_role(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255|unique:roles,name',
    ]);

    $there = $request->name;
    $count = Role::where('name',$there)->count();

    if($count>0){
        toastr()->timeOut(10000)->closeButton()->warning('This Role Already Exists.');
        return redirect()->route('admin.dashboard');
    }
    else{
        $role = Role::create(['name' => $request->name]);
    toastr()->timeOut(10000)->closeButton()->addSuccess('Role created successfully.');
    }
    return redirect()->back();    
}

public function assign_role() {
    $roles = ['Developer', 'Senior Manager', 'Project Manager', 'Customer', 'Admin'];
  
    // Use whereDoesntHave instead of whereHas
    $data = User::whereDoesntHave('roles', function ($query) use ($roles) {
      $query->whereIn('name', $roles);
    })->orderBy('created_at', 'desc')->get();
  
    return view('admin.assign_role', compact('data'));
  }

  public function showAssignRoleForm($id){
    $user = User::findOrFail($id);
    $roles = Role::all();
    return view('admin.assign_role_to_employee', compact('user', 'roles'));
  }


  public function assign_role_finally(Request $request, $id)
{
    $request->validate([
        'role' => 'required|exists:roles,name',
    ]);

    $user = User::findOrFail($id);
    $user->syncRoles([$request->role]);

    toastr()->success('Role assigned successfully.');
    return redirect()->route('admin.view_employee_list');
}


}
