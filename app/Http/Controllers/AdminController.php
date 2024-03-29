<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Notifications\RoleAssigned;
use App\Notifications\WelcomeNotification;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    // All Users
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('admin.pages.users.index', compact('users'));
    }

    // Listing Deleted or Active Users
    public function deletedOrActiveUsers(Request $request)
    {
        if (($request->active == 'on' && $request->deleted == 'on') || ($request->active == NULL && $request->deleted == NULL)) {
            return redirect('/admin/all-users');
        } elseif ($request->deleted == 'on') {
            $users = User::onlyTrashed()->get();
            return view('admin.pages.users.index', compact('users'));
        } else {
            $users = User::all();
            return view('admin.pages.users.index', compact('users'));
        }
    }

    // View for adding user
    public function addUser()
    {
        $roles = Role::all();
        return view('admin.pages.users.add', compact('roles'));
    }

    // Storing the new user data
    public function storeUser(UserStoreRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'dob' => $request->dob,
                'email_verified_at' => now(),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
            ]);

            $user->assignRole(Role::findById($request->roleId));
            $user->notify(new RoleAssigned());

            $user->notify(new WelcomeNotification());

            return back()->with('message', 'User has been registered successfully!');
        } catch (\Exception $e) {
            return back()->withErrors('Something went wrong please try again later!');
        }
    }

    // View for editing user details
    public function editUser($id)
    {
        $user = User::find($id);
        return view('admin.pages.users.edit', compact('user'));
    }

    // Store the edited user details
    public function storeEditedUser(UserUpdateRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email,' . $request->userid,
        ]);
        $user = User::find($request->userid);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'cnic' => $request->cnic,
        ]);

        if (!$request->roles == null) {
            foreach ($request->roles as $roleId) {
                $role = Role::find($roleId);
                $user->removeRole($role);
            }
        }
        $user->save();

        return redirect('/admin/all-users')->with('message', 'User details have been updated successfully!');
    }

    // Soft Delete User
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user->hasRole('admin'))
            return back()->withErrors('Admin account cannot be deleted!');

        $user->delete();
        return redirect('/admin/all-users')->with('message', 'User account has been deleted successfully!');
    }

    // Restore the soft deleted User
    public function restoreUser($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect('/admin/all-users')->with('message', 'User account has been restored successfully!');
    }
}
