<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Category;

use Log;

use Auth;

class CategoriesController extends Controller
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

        $categories = Category::Paginate(10);
        return view('categories.admin.index', compact('categories'));
    }

    public function show(Request $request, Category $category)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        if($request->ajax())
        {
            return response()->json([
                'name' => $category->name,
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

        $category = new Category($request->all());
        $category->save();

        $request->session()->flash('status', 'La categoría ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Category Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, Category $category)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $category->update($request->all());

        $request->session()->flash('status', 'La categoria ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Category Update", [
            'Request' => $request->all(),
            'Object'  => $category->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, Category $category)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('categories.admin.destroy_confirmation', compact('category'));
    }

    public function destroy(Request $request, Category $category)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("Category Delete", [
            'Request' => $request->all(),
            'Object' => $category->toArray()
        ]);

        $category->delete();
        return redirect('/admin/categories');
    }
}
