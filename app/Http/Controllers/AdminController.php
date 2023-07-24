<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // All Users
    public function index() {
        $users = User::withTrashed()->get();
        return view('admin.pages.users.index', compact('users'));
    }

    // Listing Deleted or Active Users
    public function deletedOrActiveUsers(Request $request) {
        if(($request->active == 'on' && $request->deleted == 'on') || ($request->active == NULL && $request->deleted == NULL)){
            return redirect('/admin/all-users');
        }

        elseif($request->deleted == 'on'){
            $users = User::onlyTrashed()->get();
            return view('admin.pages.users.index', compact('users'));
        }

        else{
            $users = User::all();
            return view('admin.pages.users.index', compact('users'));
        }
    }

    // View for adding user
    public function addUser() {
        $roles = Role::all();
        return view('admin.pages.users.add', compact('roles'));
    }

    // Storing the new user data
    public function storeUser(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'dob' => 'required',
            'phone' => 'required|max:11',
            'cnic' => 'required|max:15',
        ]);

        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'dob' => $request->dob,
                'email_verified_at' => now(),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
            ]);

            $user->notify(new WelcomeNotification());
            if(!$request->roleId == 'role')
                $user->assignRole(Role::findById($request->roleId));
    
            return back()->with('message', 'User has been registered successfully!');
        }
        catch(\Exception $e){
            return back()->withErrors('Something went wrong please try again later!');
        }
    }

    // View for editing user details
    public function editUser(Request $request) {
        $user = User::find($request->userid);
        return view('admin.pages.users.edit', compact('user'));
    }

    // Store the edited user details
    public function storeEditedUser(Request $request) {
        $user = User::find($request->userid);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->cnic = $request->cnic;
        if(!$request->roles == null){
            foreach($request->roles as $roleId){
                $role = Role::find($roleId);
                $user->removeRole($role);
            }
        }
        $user->save();

        if(!$user->hasRole('admin'))
            return redirect('/dashboard');

        return redirect('/admin/all-users')->with('message', 'User details have been updated successfully!');
    }

    // Soft Delete User
    public function deleteUser(Request $request) {
        $user = User::find($request->userid);
        if($user->hasRole('admin'))
            return back()->withErrors('Admin account cannot be deleted!');
        
        $user->delete();
        return redirect('/admin/all-users')->with('message', 'User account has been deleted successfully!');
    }

    // Restore the soft deleted User
    public function restoreUser(Request $request) {
        User::withTrashed()->find($request->userid)->restore();

        return redirect('/admin/all-users')->with('message', 'User account has been restored successfully!');
    }
}
