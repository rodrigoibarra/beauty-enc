<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;

use Log;

use Auth;

class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $groups = Group::Paginate(10);
        return view('groups.admin.index', compact('groups'));
    }

    public function show(Request $request, Group $group)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'name' => $group->name,
            ]);
        }
        else
        {
            App::abort(400, 'Error!');
        }

    }

    public function store(Request $request)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $group = new Group($request->all());
        $group->save();

        $request->session()->flash('status', 'El grupo ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Group Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Group $group)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $group->update($request->all());

        $request->session()->flash('status', 'El grupo ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Group Update", [
            'Request' => $request->all(),
            'Object'  => $group->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Group $group)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('groups.admin.destroy_confirmation', compact('group'));
    }

    public function destroy(Request $request, Group $group)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Group Delete", [
            'Request' => $request->all(),
            'Object' => $group->toArray()
        ]);

        $group->delete();
        return redirect('/admin/groups');
    }
}
