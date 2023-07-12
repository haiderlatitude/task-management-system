<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::all();
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
}
