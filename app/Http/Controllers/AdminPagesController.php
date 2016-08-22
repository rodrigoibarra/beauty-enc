<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use File;

use Auth;

class AdminPagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(Request $request)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        $content = File::get(storage_path('userlog.log'));
        return view('admin_pages.dashboard', ['log' => $content]);
    }
}
