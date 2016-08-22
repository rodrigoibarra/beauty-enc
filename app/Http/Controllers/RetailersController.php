<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Retailer;

use App\RetailerField;

use App\Country;

use App\Product;

use Auth;

use Log;

class RetailersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user         = Auth::user();
        $user_country = $user->profile ? $user->profile->country_id : null;
        $user_groups  = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        if($user->is_superuser || in_array('Admnistradores', $user_groups)){
            $retailers = Retailer::Paginate(10);
        } else{
            $retailers = Retailer::where('country_id', $user_country)->paginate(10);
        }
        // $retailers       = Retailer::Paginate(10);
        $retailer_fields = RetailerField::lists('name', 'id');
        $countries       = Country::lists('country', 'id');
        $products        = Product::lists('item_name', 'id');

        return view('retailers.admin.index', [
            'retailers'       => $retailers,
            'retailer_fields' => $retailer_fields,
            'countries'       => $countries,
            'products'        => $products
        ]);
    }

    public function show(Request $request, Retailer $retailer)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $retailer_fields_selected = $retailer->retailer_fields()->lists('retailer_fields.id');
        $products_selected        = $retailer->products()->lists('products.id');
        $retailer_fields          = RetailerField::lists('name', 'id');
        $countries                = Country::lists('country', 'id');
        $products                 = Product::lists('item_name', 'id');

        if($request->ajax())
        {
            return response()->json([
                'retailer'                 => [
                    'name'       => $retailer->name,
                    'country_id' => $retailer->country_id
                ],
                'retailer_fields_selected' => $retailer_fields_selected,
                'products_selected'        => $products_selected,
                'retailer_fields'          => $retailer_fields,
                'countries'                => $countries,
                'products'                 => $products
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
            'name'            => 'required|max:100',
            'country_id'      => 'required',
            'retailer_fields' => 'required'
        ]);

        $retailer = new Retailer($request->all());
        $retailer->save();

        $retailer->retailer_fields()->attach($request->retailer_fields);
        $retailer->products()->attach($request->products);

        $request->session()->flash('status', 'El Retailer ha sido añadido exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Retailer Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Retailer $retailer)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $retailer->update($request->all());
        $retailer->retailer_fields()->sync($request->retailer_fields);
        $retailer->products()->sync($request->products);

        $request->session()->flash('status', 'El retailer ha sido modificado exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Retailer update", [
            'Request' => $request->all(),
            'Object' => $retailer->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Retailer $retailer)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('retailers.admin.destroy_confirmation', compact('retailer'));
    }

    public function destroy(Request $request, Retailer $retailer)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Retailer Delete", [
            'Request' => $request->all(),
            'Object' => $retailer->toArray()
        ]);

        $retailer->delete();
        return redirect('/admin/retailers');
    }
}
