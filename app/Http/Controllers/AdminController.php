<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index() {
        $users = User::withTrashed()->get();
        return view('admin.pages.users.index', compact('users'));
    }

    public function editUser(Request $request) {
        $user = User::find($request->userid);
        return view('admin.pages.users.edit', compact('user'));
    }

    public function storeEditedUser(Request $request) {
        $user = User::find($request->userid);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->cnic = $request->cnic;
        $user->save();

        return redirect('/admin/all-users')->with('message', 'User details have been updated successfully!');
    }

    public function deleteUser(Request $request) {
        $user = User::find($request->userid);
        if($user->hasRole('admin'))
            return back()->withErrors('Admin account cannot be deleted!');
        
        $user->delete();
        return back()->with('message', 'User account has been deleted successfully!');
    }

    public function restoreUser(Request $request) {
        User::withTrashed()->find($request->userid)->restore();

        return back()->with('message', 'User account has been restored successfully!');
    }
}
