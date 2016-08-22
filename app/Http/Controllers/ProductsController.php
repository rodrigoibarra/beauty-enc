<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

use App\Family;

use App\Brand;

use App\Category;

use App\KeyWord;

use Auth;

use Log;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $user        = Auth::user();
        $user_brand  = $user->profile ? $user->profile->brand_id : null;
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        if($request->input('search')){
            $search = $request->input('search');
            $products = Product::where('item_name', 'like', '%' . $search . '%')
                ->orWhere('sku', 'like', '%' . $search . '%')
                ->orWhere('external_id', 'like', '%' . $search . '%')
                ->paginate(10);
        } else{
            $products = Product::paginate(10);
        }

        if($user->is_superuser || in_array('Admnistradores', $user_groups)){
            $products = $products;
        } else{
            $products = $products->where('brand_id', $user_brand);
        }

        // $products->whereIn('id', [19, 20])
        // $products   = Product::Paginate(10);
        $families   = Family::lists('name', 'id');
        $brands     = Brand::lists('brand', 'id');
        $categories = Category::lists('name', 'id');
        $key_words  = KeyWord::lists('name', 'id');

        return view('products.admin.index', [
            'products'   => $products,
            'families'   => $families,
            'brands'     => $brands,
            'categories' => $categories,
            'key_words'  => $key_words
        ]);
    }

    public function show(Request $request, Product $product)
    {

        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        if($request->ajax())
        {
            return response()->json([
                'product' => [
                    'id'                       => $product->id,
                    'family_id'                => $product->family_id,
                    'brand_id'                 => $product->brand_id,
                    'category_id'              => $product->category_id,
                    'currency'                 => $product->currency,
                    'mesurement_unit'          => $product->mesurement_unit,
                    'origin'                   => $product->origin,
                    'external_id_type'         => $product->external_id_type,
                    'provenance'               => $product->provenance,
                    'labeling_country'         => $product->labeling_contry,
                    'vendor_code'              => $product->vendor_code,
                    'supplier'                 => $product->supplier,
                    'sku_vendor'               => $product->sku_vendor,
                    'variation'                => $product->variation,
                    'variation_type'           => $product->variation_type,
                    'item_name'                => $product->item_name,
                    'sku'                      => $product->sku,
                    'cost_per_unit'            => $product->cost_per_unit,
                    'mesurement_unit_n'        => $product->mesurement_unit_n,
                    'included_expiration_date' => $product->included_expiration_date,
                    'life_span'                => $product->life_span,
                    'recomended_retail_price'  => $product->recomended_retail_price,
                    'external_id'              => $product->external_id,
                    'width'                    => $product->width,
                    'height'                   => $product->height,
                    'length'                   => $product->length,
                    'weight'                   => $product->weight,
                    'package_width'            => $product->package_width,
                    'package_height'           => $product->package_height,
                    'package_length'           => $product->package_length,
                    'short_description'        => $product->short_description,
                    'feature_1'                => $product->feature_1,
                    'feature_2'                => $product->feature_2,
                    'feature_3'                => $product->feature_3,
                    'safety_warnings'          => $product->safety_warnings,
                    'spray_gas'                => $product->spray_gas,
                    'number_of_parts'          => $product->number_of_parts,
                    'request_multiple'         => $product->request_multiple,
                    'image'                    => $product->image,
                    'video'                    => $product->video,
                    'status'                   => $product->status,
                    'mass'                     => $product->mass
                ],
                'keywords'          => KeyWord::all()->lists('name', 'id'),
                'keywords_selected' => $product->key_words->lists('id')
            ]);
        }
        else
        {
            App::abort(400, 'Error!');
        }

        return "Hi there!!!";

    }

    public function store(Request $request)
    {

        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        $product = new Product([
            'id'                       => $request->input("id"),
            'family_id'                => $request->input("family_id"),
            'brand_id'                 => $request->input("brand_id"),
            'category_id'              => $request->input("category_id"),
            'currency'                 => $request->input("currency"),
            'mesurement_unit'          => $request->input("mesurement_unit"),
            'origin'                   => $request->input("origin"),
            'external_id_type'         => $request->input("external_id_type"),
            'provenance'               => $request->input("provenance"),
            'labeling_contry'          => $request->input("labeling_contry"),
            'vendor_code'              => $request->input("vendor_code"),
            'supplier'                 => $request->input("supplier"),
            'sku_vendor'               => $request->input("sku_vendor"),
            'variation'                => $request->input("variation"),
            'variation_type'           => $request->input("variation_type"),
            'item_name'                => $request->input("item_name"),
            'sku'                      => $request->input("sku"),
            'cost_per_unit'            => $request->input("cost_per_unit"),
            'mesurement_unit_n'        => $request->input("mesurement_unit_n"),
            'included_expiration_date' => $request->input("included_expiration_date"),
            'life_span'                => $request->input("life_span"),
            'recomended_retail_price'  => $request->input("recomended_retail_price"),
            'external_id'              => $request->input("external_id"),
            'width'                    => $request->input("width"),
            'height'                   => $request->input("height"),
            'length'                   => $request->input("length"),
            'weight'                   => $request->input("weight"),
            'package_width'            => $request->input("package_width"),
            'package_height'           => $request->input("package_height"),
            'package_length'           => $request->input("package_length"),
            'short_description'        => $request->input("short_description"),
            'feature_1'                => $request->input("feature_1"),
            'feature_2'                => $request->input("feature_2"),
            'feature_3'                => $request->input("feature_3"),
            'safety_warnings'          => $request->input("safety_warnings"),
            'spray_gas'                => $request->input("spray_gas"),
            'number_of_parts'          => $request->input("number_of_parts"),
            'request_multiple'         => $request->input("request_multiple"),
            'image'                    => $request->input("image"),
            'video'                    => $request->input("video"),
            'status'                   => $request->input("status"),
            'mass'                     => $request->input("mass")
        ]);

        $product->save();


        if($request->hasFile('image')){

            $image               = $request->file('image');
            $file_original_name  = $image->getClientOriginalName();
            $file_name           = strval($product->sku) . substr($file_original_name, -4);
            $image_path          = public_path('uploads');

            $image->move($image_path, $file_name);

            $product->image = $file_name;
            $product->save();

        }

        $product->key_words()->attach($request->input('key_words'));

        $request->session()->flash('status', 'El product ha sido añadido exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Product Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Product $product)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $product->update([
            'vendor_code'              => $request->input("vendor_code"),
            'supplier'                 => $request->input("supplier"),
            'cost_per_unit'            => $request->input("cost_per_unit"),
            'origin'                   => $request->input("origin"),
            'included_expiration_date' => $request->input("included_expiration_date"),
            'life_span'                => $request->input("life_span"),
            'recomended_retail_price'  => $request->input("recomended_retail_price"),
            'short_description'        => $request->input("short_description"),
            'feature_1'                => $request->input("feature_1"),
            'feature_2'                => $request->input("feature_2"),
            'feature_3'                => $request->input("feature_3"),
            'safety_warnings'          => $request->input("safety_warnings"),
            'spray_gas'                => $request->input("spray_gas"),
            'provenance'               => $request->input("provenance"),
            'labeling_contry'          => $request->input("labeling_contry"),
            'number_of_parts'          => $request->input("number_of_parts"),
            'video'                    => $request->input("video")
        ]);

        if(!$request->input('key_words')){
            $product->key_words()->sync([]);
        } else{
            $product->key_words()->sync($request->input('key_words'));
        }

        $request->session()->flash('status', 'La palabra clave ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Product Update", [
            'Request' => $request->all(),
            'Object'  => $product->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Product $product)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('products.admin.destroy_confirmation', compact('product'));
    }

    public function destroy(Request $request, Product $product)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Product Delete", [
            'Request' => $request->all(),
            'Object' => $product->toArray()
        ]);

        $product->delete();
        return redirect('/admin/products');
    }
}
