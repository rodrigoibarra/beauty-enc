<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Brand;

use App;

use Log;

use Auth;

class BrandsController extends Controller
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
        $brands = Brand::Paginate(10);
        return view('brands.admin.index', compact('brands'));
    }

    public function show(Request $request, Brand $brand)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'division' => $brand->division,
                'brand'    => $brand->brand,
                'type'     => $brand->type
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
            'division' => 'required|max:100',
            'brand'    => 'required|max:100',
            'type'     => 'required|max:100',
        ]);

        $brand = new Brand($request->all());
        $brand->save();

        $request->session()->flash('status', 'La marca ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Brand Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Brand $brand)
    {

        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'division' => 'required|max:100',
            'brand'    => 'required|max:100',
            'type'     => 'required|max:100',
        ]);

        $brand->update($request->all());

        $request->session()->flash('status', 'La marca ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Brand Update", [
            'Request' => $request->all(),
            'Object'  => $brand->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Brand $brand)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('brands.admin.destroy_confirmation', compact('brand'));
    }

    public function destroy(Request $request, Brand $brand)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Brand Delete", [
            'Request' => $request->all(),
            'Object' => $brand->toArray()
        ]);
        $brand->delete();
        return redirect('/admin/brands');
    }
}
