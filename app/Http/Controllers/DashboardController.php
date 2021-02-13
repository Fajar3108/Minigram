<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Post};

class DashboardController extends Controller
{
    public function dashboard()
    {
        $users = User::where('role', 'user')->count();
        $admins = User::where('role', 'admin')->count();
        $posts = Post::count();

        return view('admin.dashboard', compact('users', 'admins', 'posts'));
    }

    public function manageUsers()
    {
        $users = User::latest()->paginate(5);
        return view('admin.users', compact('users'));
    }
}
