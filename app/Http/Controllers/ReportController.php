<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Report};
Use Alert;

class ReportController extends Controller
{
    public function index(Type $var = null)
    {

        $reports = Report::with('reporter', 'target')->latest()->paginate(10);
        return view('admin.report', compact('reports'));
    }
    public function store(Request $request)
    {
        if(!isset($request->message)){
            Alert::error('Error', "Message's field can't be null");
            return back();
        }

        auth()->user()->reports()->create([
            'target_id' => $request->target_id,
            'message' => $request->message,
        ]);

        Alert::success('Success', 'User reported successfuly');

        return back();
    }

    public function block(User $user)
    {
        $user->update([
            'banned_at' => date('Y-m-d H:i:s')
        ]);

        Alert::success('Success', 'User banned successfuly');

        return back();
    }

    public function unblock(User $user)
    {
        $user->update([
            'banned_at' => null
        ]);

        Alert::success('Success', 'User unbanned successfuly');

        return back();
    }
}
