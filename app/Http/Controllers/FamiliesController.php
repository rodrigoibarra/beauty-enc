<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Family;

use Log;

use Auth;

class FamiliesController extends Controller
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
        $families = Family::Paginate(10);
        return view('families.admin.index', compact('families'));
    }

    public function show(Request $request, Family $family)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'name' => $family->name,
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

        $family = new Family($request->all());
        $family->save();

        $request->session()->flash('status', 'La familia ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Family Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Family $family)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $family->update($request->all());

        $request->session()->flash('status', 'La familia ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Family Update", [
            'Request' => $request->all(),
            'Object'  => $family->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Family $family)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('families.admin.destroy_confirmation', compact('family'));
    }

    public function destroy(Request $request, Family $family)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Family Delete", [
            'Request' => $request->all(),
            'Object' => $family->toArray()
        ]);

        $family->delete();
        return redirect('/admin/families');
    }
}
