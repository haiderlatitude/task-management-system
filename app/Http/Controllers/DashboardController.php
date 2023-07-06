<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $tasks = Task::all();
            return view('admin.dashboard', compact('tasks'));
        } else
            return view('user.dashboard');
    }
}
