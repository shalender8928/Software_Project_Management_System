<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Address;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
            'gender' => 'required|string|max:10',
            'age' => 'required|integer|min:1|max:120',
            'street' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:10',
            'country' => 'nullable|string|max:255',
        ]);
    
    
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
        toastr()->timeOut(10000)->closeButton()->addSuccess('You Have Successfully Registered.');
        // Assign role to user
        $user->assignRole('Customer'); // Assign the role as required
        toastr()->timeOut(10000)->closeButton()->addSuccess('You Have Successfully Registered.');
        return redirect()->route('login');
    }
}
