<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Country;

use Log;

use Auth;

class CountriesController extends Controller
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
        $countries = Country::Paginate(10);
        return view('countries.admin.index', compact('countries'));
    }

    public function show(Request $request, Country $country)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'country' => $country->country,
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
            'country' => 'required|max:100',
        ]);

        $country = new Country($request->all());
        $country->save();

        $request->session()->flash('status', 'El país ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Country Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Country $country)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        $this->validate($request, [
            'country' => 'required|max:100',
        ]);

        $country->update($request->all());

        $request->session()->flash('status', 'El país ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Country Update", [
            'Request' => $request->all(),
            'Object'  => $country->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Country $country)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('countries.admin.destroy_confirmation', compact('country'));
    }

    public function destroy(Request $request, Country $country)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Country Delete", [
            'Request' => $request->all(),
            'Object' => $country->toArray()
        ]);

        $country->delete();
        return redirect('/admin/countries');
    }
}
