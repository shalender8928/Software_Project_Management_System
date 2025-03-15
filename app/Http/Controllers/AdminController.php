<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Address;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\user_category;
use App\Models\Qualification;
use App\Models\user_has_qualification;
use App\Mail\EmployeeRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;







use App\Models\Category;


use Illuminate\Support\Facades\Auth;




class AdminController extends Controller
{
    public function dashboard()
    {
        $roles = ['Developer', 'Senior Manager', 'Project Manager','Admin'];

        // Assuming hasRole function checks if the user has any of the specified roles
        $employee = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })->count();
    
        $cust_roles = ['Customer'];
    
        // Assuming hasRole function checks if the user has any of the specified roles
        $customer = User::whereHas('roles', function ($query) use ($cust_roles) {
            $query->whereIn('name', $cust_roles);
        })->count();

        $roles_not = ['Developer', 'Senior Manager', 'Project Manager', 'Customer', 'Admin'];
  
        // Use whereDoesntHave instead of whereHas
        $unAssigned = User::whereDoesntHave('roles', function ($query) use ($roles_not) {
          $query->whereIn('name', $roles_not);
        })->count();
      
    
        $role_num = Role::all()->count();
        $permissions = Permission::all()->count();
        $category = Category::all()->count();
    
        return view('admin.dashboard', compact('employee','customer', 'role_num', 'permissions', 'category', 'unAssigned'));
    }
            // Show the form to edit the profile image
    public function admin_image_edit()
    {
                $user = Auth::user();
                $user_id = $user->id;    // logged in User Id
                $data = User::find($user_id);
                return view('admin.admin_image_edit', compact('data'));
                 // Ensure you have a corresponding view file
    }
    public function update_admin_profile_image(Request $request, $id)
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
    
            return redirect()->route('admin.dashboard');

        }
          //  changee password 
          public function changee_password_admin()
          {
              $user = Auth::user();
              $user_id = $user->id;    // logged in User Id
              $data = User::find($user_id);
              return view('admin.changee_password_admin', compact('data'));
      
          }
          //    change password update
        public function change_Password_admin(Request $request)
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
            return redirect()->route('admin.dashboard');
        }



    public function admin_edit_profile()
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged in User Id
        $data = User::find($user_id);

        return view('admin.admin_edit_profile', compact('data'));

    }

    public function admin_update_profile(Request $request, $id)
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
    // Logic to display the form or handle employee addition
    return view('admin.add_employee');
}


public function register_employee(Request $request)
{

    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID
    
    // Check if the user has the 'add-employee' permission
    // $hasPermission = $user->permissions()->where('name', 'add employee')->exists();
    
    if (!$user->can('add employee')) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add new employee');
        return redirect()->back();
    }
    

    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'phone' => 'required|string|max:15',
        'gender' => 'required|string|max:10',
        'age' => 'required|integer',
    ]);

    // Generate a random password
    $randomPassword = Str::random(8); // Adjust the length as needed

    DB::beginTransaction();

    try {
        $user = new User;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($randomPassword);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->save();

        $address = new Address;
        $address->user_id = $user->id;
        $address->street = $request->street;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->zip_code = $request->zip_code;
        $address->country = $request->country;
        $address->save();

        // Send registration email with the generated password
        Mail::to($user->email)->send(new EmployeeRegistered($user, $randomPassword));

        DB::commit();
        toastr()->timeOut(10000)->closeButton()->addSuccess('Employee registered successfully.');
        return redirect()->route('admin.dashboard');

    } catch (\Exception $e) {
        DB::rollback();
        Log::error($e->getMessage());
        return redirect()->back()->with('error', 'Registration failed.');
    }
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

    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID
    
    // Check if the user has the 'add-employee' permission
    // $hasPermission = $user->permissions()->where('name', 'edit employee')->exists();
    
    if (!$user->can('edit employee')) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit employee details');
        return redirect()->back();
    }
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

        $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID
    
    // Check if the user has the 'add-employee' permission
    // $hasPermission = $user->permissions()->where('name', 'delete employee')->exists();
    
    if (!$user->can('delete employee')) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete employee');
        return redirect()->back();
    }
        $data = User:: find($id);
        if ($data) {
            $data->delete();
            toastr()->timeOut(10000)->closeButton()->success('Employee Successfully Deleted');
        $data = User:: find($id);
        if ($data) {
            $data->delete();
            toastr()->timeOut(10000)->closeButton()->success('Category Successfully Deleted');
        } else {
            toastr()->timeOut(10000)->closeButton()->error('Category Not Found');
        }
        return redirect()->back();
    }
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
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID
        
        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'view employee detail')->exists();
        
        if (!$user->can('view employee detail')) {
    
            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view employee details');
            return redirect()->back();
        }
        $data = User::find($id);
        return view('admin.view_employee_detail', compact('data'));

    }

    public function add_category(){

        $data = Category::orderBy('created_at', 'desc');
        return view('admin.add_category', compact('data'));
    }

    public function add_new_category(Request $request){
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID
        
        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'add category')->exists();
        
        if (!$user->can('add category')) {
    
            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add  new project category');
            return redirect()->back();
        }
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
        $data = Category::orderBy('cat_name','asc')->get();
        $data = Category::orderBy('created_at','desc')->get();
        return view('admin.edit_category',compact('data'));
    }

    public function update_category($id){
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID
        
        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'edit category')->exists();
        
        if (!$user->can('edit category')) {
    
            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit project category');
            return redirect()->back();
        }
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

    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID
    
    // Check if the user has the 'add-employee' permission
    // $hasPermission = $user->permissions()->where('name', 'delete category')->exists();
    
    if (!$user->can('delete category')) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete project category');
        return redirect()->back();
    }
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
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID
        
        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'view category')->exists();
        
        if (!$user->can('view category')) {
    
            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view project category details');
            return redirect()->back();
        }
        $data = Category::find($id);

        return view('admin.view_category_detail', compact('data'));
    }

    public function add_role(){
        return view('admin.add_role');
    }



public function create_role(Request $request)
{
    $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'add role')->exists();

        if (!$user->can('add role')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add  new role');
            return redirect()->back();
        }
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
    $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'assign role')->exists();

        if (!$user->can('assign role')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to assign role to employee');
            return redirect()->back();
        }

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


public function edit_role(){
    $data = Role::orderBy('created_at', 'desc')->get();

    return view('admin.edit_role' , compact('data'));
}

public function update_role($id){
    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID

    // Check if the user has the 'add-employee' permission
    // $hasPermission = $user->permissions()->where('name', 'edit role')->exists();

    if (!$user->can('edit role')) {

        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit role');
        return redirect()->back();
    }
    $data = Role::find($id);

    return view('admin.update_role' , compact('data'));
}

public function update_role_db(Request $request, $id){

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $role = Role::find($id);
    $role->name = $request->name;

    $role->save();
    toastr()->timeOut(10000)->closeButton()->addSuccess('Role Successfully Updated.');
    return redirect()->route('admin.edit_role');


}

    public function delete_role()
    {
        $data = Role::orderBy('created_at', 'desc')->get();
        return view('admin.delete_role', compact('data'));
    }

    public function delete_role_added($id)
    {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'delete role')->exists();

        if (!$user->can('delete role')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete role');
            return redirect()->back();
        }

        $role = Role::find($id);

        if (!$role) {
            toastr()->timeOut(10000)->closeButton()->error('Role does not exist.');
        } else {
            $role->delete();
            toastr()->timeOut(10000)->closeButton()->addSuccess('Role Successfully Deleted.');
        }

        return redirect()->route('admin.delete_role');
    }


    public function view_role_list(){
        $data = Role:: orderBy('name' , 'asc')->get();
        $data = Role:: orderBy('created_at' , 'desc')->get();

        return view('admin.view_role_list' , compact('data'));
    }
    
        public function view_assined_user($id)
    {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'view role')->exists();

        if (!$user->can('view role')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view user assigned to this role');
            return redirect()->back();
        }

        $role = Role::find($id);

        if (!$role) {
            Toastr::timeOut(10000)->closeButton()->error('Role does not exist.');
            return redirect()->back();
        }

        // Assuming 'roles' is the relationship name in the User model
        $employees = User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->get();

        return view('admin.view_assined_user', compact('employees', 'role'));
    }

    public function select_role_to_update(){
        $data = Role:: orderBy('name', 'asc')->get();
        return view('admin.select_role_to_update' , compact('data'));
    }



    public function update_user_assigned_role($id) {
        $user = Auth::user();
        $user_id = $user->id; 
        $roles = Role:: find($id);
        
        $data = User::whereHas('roles', function ($query) use ($roles) {
            $query->whereIn('name', $roles);
        })
        ->where('id', '!=', $user_id)
        ->orderBy('created_at', 'desc')
        ->get();
        
        return view('admin.update_user_assigned_role', compact('data'));
    }
    

    public function update_rolllee($id)
    {
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'update assigned role')->exists();

        if (!$user->can('update assigned role')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to update assigned role to employee');
            return redirect()->back();
        }

        $user = User::find($id);
        $roles = Role::orderBy('name', 'asc')->get();
        return view('admin.update_rolllee', compact('user', 'roles'));
    }

    public function submit_role_update(Request $request, $id) {
        $user = User::find($id);
    
        if (!$user) {
            toastr()->error('User not found!');
            return redirect()->route('admin.view_role_list');
        }
    
        $currentRoleName = $user->getRoleNames()->first();
    
        if ($currentRoleName) {
            $user->removeRole($currentRoleName); // Detach the current role
        }
    
        $newRoleName = $request->role;
    
        if (!Role::where('name', $newRoleName)->exists()) {
            toastr()->error('Role does not exist!');
            return redirect()->route('admin.view_role_list');
        }
    
        $user->assignRole($newRoleName); // Assign the new role
    
        toastr()->persistent()->closeButton()->addSuccess('Role Successfully Updated From  ' .$currentRoleName.' to '. $newRoleName.  ' for User: ' . $user->firstname . ' ' .$user->lastname );
        return redirect()->route('admin.view_role_list');
    }


    public function add_new_permission(){
        return view('admin.add_new_permission');
    }

    public function add_permission(Request $request){
        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'add permission')->exists();

        if (!$user->can('add permission')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add  new permission');
            return redirect()->back();
        }


        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
    
        $there = $request->name;
        $count = Permission::where('name',$there)->count();
    
        if($count>0){
            toastr()->timeOut(10000)->closeButton()->warning('This Permission Already Exists.');
            return redirect()->back();
        }
        else{
            $permission = Permission::create(['name' => $request->name]);
        toastr()->timeOut(10000)->closeButton()->addSuccess('New Permission created Successfully.');
        }
        return redirect()->back();    
    }

    public function edit_permission(){


        $permission = Permission::orderBy('name' , 'asc')->get();

        $permission = Permission::orderBy('created_at' , 'desc')->get();

        return view('admin.edit_permission', compact('permission'));
    }

    public function update_permission($id){

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'edit permission')->exists();

        if (!$user->can('edit permission')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit permission');
            return redirect()->back();
        }



        $permission = Permission::find($id);
        return view('admin.update_permission',  compact('permission'));
    }

    public function update_permission_db(Request $request, $id){
        $permission = Permission::find($id);
        $count = Permission::where('name' , $request->name)->count();

        if($count>0){
        toastr()->timeOut(10000)->closeButton()->warning('This Permission has already exist');
        return redirect()->back();

        }

        else{
             $permission->name = $request->name;
             $permission->save();
            toastr()->timeOut(10000)->closeButton()->addSuccess('Permission Updated Successfully');

        return redirect()->route('admin.edit_permission');
        }       
    }

    public function delete_permission(){
        $permission = Permission::orderBy('name' , 'asc')->get();
        return view('admin.delete_permission' , compact('permission'));
    } 

    public function delete_permission_added($id){

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'delete permission')->exists();

        if (!$user->can('delete permission')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete permission');
            return redirect()->back();
        }

        

        {

            $permission = Permission::find($id);
    
            if (!$permission) {
                toastr()->timeOut(10000)->closeButton()->error('Permission does not exist.');
            } else {
                $permission->delete();
                toastr()->timeOut(10000)->closeButton()->addSuccess('Permission Successfully Deleted.');
            }
    
            return redirect()->back();

        

        }

    }

    public function assign_permission(){
        $data = Role:: orderBy('name' , 'asc')->get();

        return view('admin.assign_permission' , compact('data'));
    }


    public function view_user_of_such_role($id)
{
    $user = Auth::user();
    $user_id = $user->id;    // logged-in User ID

    // Check if the user has the 'assign permission' permission
    // $hasPermission = $user->permissions()->where('name', 'assign permission')->exists();

    if (!$user->can('assign permission')) {
        toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to assign permission');
        return redirect()->back();
    }

    $role = Role::find($id);

    if (!$role) {
        Toastr::timeOut(10000)->closeButton()->error('Role does not exist.');
        return redirect()->back();
    }

    // Get users with the selected role, excluding the logged-in user
    $employees = User::whereHas('roles', function ($query) use ($role) {
        $query->where('name', $role->name);
    })
    ->where('id', '!=', $user_id) // Exclude the logged-in user
    ->get();

    return view('admin.view_user_of_such_role', compact('employees', 'role'));
}


    public function assign_permission_for_selected_user($id) {
        $permissions = Permission::orderBy('name', 'asc')->get();
        $user = User::find($id);
        $userPermissions = $user->permissions->pluck('id')->toArray(); // Get IDs of assigned permissions
        
        return view('admin.assign_permission_for_selected_user', compact('permissions', 'user', 'userPermissions'));
    }


    public function update_permissions_for_selected_user(Request $request, $id) {
        $user = User::find($id);
        $user->permissions()->sync($request->permissions); // Sync the selected permissions
        toastr()->timeOut(10000)->closeButton()->addSuccess('Permission Assigned Successfully.');
        return redirect()->back();
    }

    public function view_permission_list(){
        $permission = Permission:: orderBy('name' , 'asc')->get();

        return view('admin.view_permission_list' , compact('permission'));
    }

    public function view_permitted_user($id)
    {

        $user = Auth::user();
        $user_id = $user->id;    // logged-in User ID

        // Check if the user has the 'add-employee' permission
        // $hasPermission = $user->permissions()->where('name', 'view permission')->exists();

        if (!$user->can('view permission')) {

            toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view users permitted for this permission ');
            return redirect()->back();
        }



        // Find the permission by its ID
        $permission = Permission::find($id);
    
        // Check if the permission exists
        if (!$permission) {
            return redirect()->back()->with('error', 'Permission not found.');
        }
    
        // Get users who have the specified permission
        $users = User::whereHas('permissions', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
         
    
        // Return the view with the users and permission
        return view('admin.view_permitted_user', compact('permission', 'users'));
    }

        public function assign_category()
        {
            $roles = ['Developer', 'Project Manager'];

            // Get users with specified roles who don't have any categories
            $users = User::whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('name', $roles);
            })->doesntHave('categories')->get();

            return view('admin.assign_category', compact('users'));
        }

        public function assign_category_to_selected_user($id){


            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID
            
            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'assign category')->exists();
            
            if (!$user->can('assign category')) {
        
                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to assign project category to employee');
                return redirect()->back();
            }


            $user = User::findOrFail($id);
            $category = Category::orderBy('cat_name' , 'asc')->get();
            return view('admin.assign_category_to_selected_user', compact('user', 'category'));
        }

        public function assign_category_post(Request $request, $id)
        {
            $user = User::find($id);
            $category_id = $request->category;
        
            // Assign the new category
            $user->categories()->attach($category_id);
        
            toastr()->success('Category assigned successfully.');
            return redirect()->route('admin.assign_category');
        }
        

        public function view_employee_category($id)


        
        {
            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID
            
            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'view category')->exists();
            
            if (!$user->can('view category')) {
        
                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view employee assigned under this project category category');
                return redirect()->back();
            }

        

            // Find the category by ID
            $category = Category::find($id);
        
            // Define the roles you want to filter by
            $roles = ['Developer', 'Project Manager'];
        
            // Get users with specified roles who are assigned to the selected category
            $users = User::whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('name', $roles);
            })->whereHas('categories', function ($query) use ($id) {
                $query->where('category_id', $id);
            })->get();

            if ($users->isEmpty()) {
                toastr()->timeOut(10000)->closeButton()->warning('There is no Assigned Employee Under this Category Yet.');
                return redirect()->back();
            }
            

                return view('admin.view_employee_category', compact('users', 'category'));

        
        }

        public function update_assigned_category()
        {
            $roles = ['Developer', 'Project Manager'];
        
            // Get users with specified roles and their single category
            $users = User::whereHas('roles', function ($query) use ($roles) {
                $query->whereIn('name', $roles);
            })->whereHas('categories')->with('categories')->get();
        
            return view('admin.update_assigned_category', compact('users'));
        }

        public function update_category_assigned($id){

            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID
            
            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'update assigned category')->exists();
            
            if (!$user->can('update assigned category')) {
        
                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to update assigned project category to employee');
                return redirect()->back();
            }


            $user = User:: find($id);
            $categories = Category::orderBy('cat_name' , 'asc')->get();
            return view('admin.update_category_assigned' , compact('user' , 'categories'));
        }
        
        public function submit_category_update(Request $request, $id)
        {
            $user = User::find($id);
            $category_id = $request->category;

            // Assuming you have a UserCategory model to manage the pivot table
            // First, remove the current category if exists
            $user->categories()->detach();

            // Then, assign the new category
            $user->categories()->attach($category_id);

            toastr()->success('Category Updated successfully.');
            return redirect()->route('admin.update_assigned_category');
        }


        public function add_new_qualification(){
            return view('admin.add_new_qualification');
        }

        public function create_qualification(Request $request){


            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID

            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'add qualification')->exists();

            if (!$user->can('add qualification')) {

                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to add  new qualification');
                return redirect()->back();
            }



            $request->validate([
                'qualification' => 'required|string|max:255',
            ]);
    
            $logged_user = Auth::user();
            $logged_id  = $logged_user->id;
    
            $there = $request->qualification;
            $count = Qualification::where('name',$there)->count();
    
            if($count>0){
                toastr()->timeOut(10000)->closeButton()->warning('This Qualification Already Exists.');
                return redirect()->back();
            }
    
            else{
            $user =  new Qualification;
            $user->name = $request->qualification;
            $user->created_by = $logged_id;
            $user->updated_by = $logged_id;
    
            $user->save();
            toastr()->timeOut(10000)->closeButton()->addSuccess('New Qualification Added Successfully.');
            return redirect()->back();
            }
        }

        public function edit_qualification(){
            $qualification = Qualification::orderBy('name' , 'asc')->get();
            return view('admin.edit_qualification' , compact('qualification'));
        }

        public function update_qualifications($id){

            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID

            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'edit qualification')->exists();

            if (!$user->can('edit qualification')) {

                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to edit qualification');
                return redirect()->back();
            }



            $qualification = Qualification:: find($id);
            return view('admin.update_qualifications' , compact('qualification'));
        }

        public function update_qualification_db(Request $request , $id){
            $qualification = Qualification::find($id);
            $count = Qualification::where('name' , $request->qualification)->count();

            if($count>0){
            toastr()->timeOut(10000)->closeButton()->warning('This Qualification has already exist');
            return redirect()->back();

        }

        else{
             $qualification->name = $request->qualification;
             $qualification->save();
            toastr()->timeOut(10000)->closeButton()->addSuccess('Qualification Updated Successfully');

        return redirect()->route('admin.edit_qualification');
        }   
        }

        public function delete_qualification(){
            $qualification = Qualification:: orderBy('name' , 'asc')->get();
            return view('admin.delete_qualification' , compact('qualification'));
        }

        public function delete_qualifications_added($id){

            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID

            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'delete qualification')->exists();

            if (!$user->can('delete qualification')) {

                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to delete qualification');
                return redirect()->back();
            }



            $qualification = Qualification:: find($id);
            $qualification->delete();
            toastr()->timeOut(10000)->closeButton()->addSuccess('Qualification Deleted Successfully');

            return redirect()->back();
        }

        public function view_qualification_list(){
            $qualification = Qualification:: orderBy('name' , 'asc')->get();
            return view('admin.view_qualification_list' , compact('qualification'));
        }


        public function assign_qualification(){
            $roles = ['Developer', 'Project Manager'];

            // Get users with specified roles who don't have any categories
            $role = Role::whereIn('name', ['Project Manager', 'Developer'])->get();

            return view('admin.assign_qualification', compact('role'));
        }

        public function view_user_of_such_role_qualification($id){

            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID

            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'assign qualification')->exists();

            if (!$user->can('assign qualification')) {

                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to assign qualification to employee');
                return redirect()->back();
            }


            $role = Role::find($id);

        if (!$role) {
            Toastr::timeOut(10000)->closeButton()->error('Role does not exist.');
            return redirect()->back();
        }

        // Assuming 'roles' is the relationship name in the User model
        $employees = User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role->name);
        })->get();

              return view('admin.view_user_of_such_role_qualification' , compact('employees', 'role'));
        }

        public function assign_qualifiaction_for_selected_user($id){

            


            $qualification = Qualification::orderBy('name', 'asc')->get();
            $user = User::find($id);
            $userQualification = $user->qualifications->pluck('id')->toArray(); // Get IDs of assigned permissions
            
            return view('admin.assign_qualifiaction_for_selected_user', compact('qualification', 'user', 'userQualification'));
        }
        
        public function update_qualification_for_selected_user(Request $request , $id){
            $user = User::find($id);
            $user->qualifications()->sync($request->qualification); // Sync the selected qualifications
            toastr()->timeOut(10000)->closeButton()->addSuccess('Qualification Assigned Successfully.');
            return redirect()->back();
        }

        public function view_qualified_user($id){

            $user = Auth::user();
            $user_id = $user->id;    // logged-in User ID

            // Check if the user has the 'add-employee' permission
            // $hasPermission = $user->permissions()->where('name', 'view qualification')->exists();

            if (!$user->can('view qualification')) {

                toastr()->timeOut(10000)->closeButton()->warning('You are not permitted to view qualified user for this qualification');
                return redirect()->back();
            }



            // Find the permission by its ID
            $qualification = Qualification::find($id);
        
            // Check if the permission exists
            if (!$qualification) {
                toastr()->timeOut()->closeButton()->error('Qualification not found.');
                return redirect()->back();
            }
        
            // Get users who have the specified permission
            $users = User::whereHas('qualifications', function ($query) use ($id) {
                $query->where('qualifications.id', $id); // Specify the table for the id column
            })->get();
        
            // Return the view with the users and permission
            return view('admin.view_qualified_user', compact('qualification', 'users'));
        }
        

}
