<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function followUserRequest(Request $request){
        $user = User::find($request->user_id);
        $response = auth()->user()->toggleFollow($user);

        return back();
    }
}
