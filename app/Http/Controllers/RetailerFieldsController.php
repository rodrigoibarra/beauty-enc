<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\RetailerField;

use Auth;

class RetailerFieldsController extends Controller
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
        $retailer_fields = RetailerField::Paginate(10);
        return view('retailer_fields.admin.index', compact('retailer_fields'));
    }

    public function show(Request $request, RetailerField $retailer_field)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        if($request->ajax())
        {
            return response()->json([
                'name' => $retailer_field->name,
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

        $retailer_field = new RetailerField($request->all());
        $retailer_field->save();

        $request->session()->flash('status', 'El campo ha sido añadida exitosamente.');

        return back();

    }

    public function update(Request $request, RetailerField $retailer_field)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $retailer_field->update($request->all());

        $request->session()->flash('status', 'El campo ha sido modificada exitosamente.');

        return back();
    }

    public function destroyConfirmation(Request $request, RetailerField $retailer_field)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('retailer_fields.admin.destroy_confirmation', compact('retailer_field'));
    }

    public function destroy(Request $request, RetailerField $retailer_field)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $retailer_field->delete();
        return redirect('/admin/retailer-fields');
    }
}
