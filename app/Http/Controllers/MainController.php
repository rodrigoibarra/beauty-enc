<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;
use App\Product;
use App\Brand;
use App\Category;
use App\Retailer;
use Auth;

class MainController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home(Request $request)
    {
        $brands     = Brand::all();
        $categories = Category::all();
        $divisions  = Brand::all()->groupBy('division');
        $products   = Product::orderBy('views', 'desc')->take(6)->get();


        return view('main_app.home', [
            'brands'     => $brands,
            'categories' => $categories,
            'divisions'  => $divisions,
            'products'   => $products
        ]);
    }

    public function productList(Request $request)
    {

        if($request->input('search')){
            $search = $request->input('search');
            $products = Product::where('item_name', 'like', '%' . $search . '%')
                ->orWhere('sku', 'like', '%' . $search . '%')
                ->orWhere('external_id', 'like', '%' . $search . '%')
                ->get();
        } else{
            $products = Product::all();
        }

        $user_roles = $request->user()->roles->lists('name')->toArray();

        // dd($user_brand);

        if(in_array('ReadOnly', $user_roles) || in_array('Marketing', $user_roles)){
            $user_brand = $request->user()->profile->brand_id;
            $products = $products->where('brand_id', $user_brand);
        }

        if($request->input('category_id') != ""){
            $products = $products->where('category_id', intval($request->input('category_id')));
        }

        if($request->input('brand_id') != ""){
            $products = $products->where('brand_id', intval($request->input('brand_id')));
        }

        // dd($request->input('min') != "" && $request->input('max') != "");
        if($request->input('min') != "" && $request->input('max') != ""){
            $products = $products->where('cost_per_unit', '>=', intval($request->input('min')));
            // $products = $products->where('cost_per_unit', '<=', intval($request->input('max')));
        }

        if(count($request->input('status')) > 0){
            $products = $products->whereIn('status', $request->input('status'));
        }

        if($request->ajax()){
            return view('main_app.product_list_ajax', [
                'products' => $products
            ]);
        }

        $brands     = Brand::all();
        $categories = Category::all();
        $divisions  = Brand::all()->groupBy('division');

        return view('main_app.product_list', [
            'brands'     => $brands,
            'categories' => $categories,
            'divisions'  => $divisions,
            'products'   => $products
        ]);
    }

    public function productDetail(Request $request, Product $product)
    {
        return view('main_app.product_detail', compact("product"));
    }


    public function retailerList(Request $request)
    {
        $user         = Auth::user();
        $user_country = $user->profile ? $user->profile->country_id : null;
        $user_groups  = $user->roles()->lists('name')->toArray();

        if($user->is_superuser || in_array('Admnistradores', $user_groups)){
            $retailers = Retailer::Paginate(10);
        } else{
            $retailers = Retailer::where('country_id', $user_country)->paginate(10);
        }

        // $retailers = Retailer::all();
        return view('main_app.retailer_list', compact('retailers'));
    }

    public function retailerDetail(Request $request, Retailer $retailer)
    {

        if($request->input('csv')){

            $table = $retailer->products;

            $output='';

            // foreach ($table as $row) {
            //     fputcsv($output, $row->to_array());
            // }

            foreach ($table as $row) {

                $array_data = $row->toArray();
                array_pop($array_data);
                $output .= iconv("UTF-8", "Windows-1252", implode(",", $array_data) . "\n");
            }

            $headers = array(
              'Content-Type' => 'text/csv',
              'Content-Disposition' => 'attachment; filename="retailer.csv"',
            );

            return Response::make(rtrim($output, "\n"), 200, $headers);

        } else{
            return view('main_app.retailer_detail', compact('retailer'));
        }
    }

}
