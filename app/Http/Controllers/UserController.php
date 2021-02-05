<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function show(User $user)
    {
        $posts = [];
        foreach($user->posts as $post){
            $posts[] = $post;
        }
        arsort($posts);
        return view('user.profile', compact('user', 'posts'));
    }

    public function follows(User $user)
    {
        return view('user.follows', compact('user'));
    }
}
