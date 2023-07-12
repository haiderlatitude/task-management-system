<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userTasks() {
        $tasks = auth()->user()->tasks;
        $statuses = Status::all();
        return view('user.pages.tasks.index', compact('tasks', 'statuses'));
    }

    public function userRoles() {
        $roles = auth()->user()->roles;
        return view('user.pages.roles.index', compact('roles'));
    }

    public function userPermissions() {
        $permissions = auth()->user()->permissions;
        return view('user.pages.permissions.index', compact('permissions'));
    }
}
