<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Brand;

use App\Group;

use App\Profile;

use App\Country;

use Log;

use Validator;

use Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $users     = User::Paginate(10);
        $brands    = Brand::lists('brand', 'id');
        $groups    = Group::lists('name', 'id');
        $countries = Country::lists('country', 'id');

        return view('users.admin.index', [
            'users'     => $users,
            'brands'    => $brands,
            'groups'    => $groups,
            'countries' => $countries
        ]);
    }

    public function show(Request $request, User $user)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'name'         => $user->name,
                'is_superuser' => $user->is_superuser,
                'email'        => $user->email,
                'profile'    => [
                    'first_name' => $user->profile->first_name,
                    'last_name'  => $user->profile->last_name,
                    'country_id' => $user->profile->country_id,
                    'brand_id'   => $user->profile->brand_id
                ],
                'groups'          => Group::all()->lists('name', 'id'),
                'groups_selected' => $user->roles->lists('id')->toArray(),
                'brands'          => Brand::all()->lists('brand', 'id'),
                'countries'       => Country::all()->lists('country', 'id')
            ]);
        }
        else
        {
            App::abort(400, 'Error!');
        }
    }

    public function store(Request $request)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }

        $rules = [
            'name' => 'required|alpha_num|min:3|max:32',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
            'first_name' => 'required',
            'last_name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = new User([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'password'     => bcrypt($request->input('password')),
            'is_superuser' => $request->input('is_superuser') ? true : false
        ]);

        $user->save();

        $profile = new Profile($request->all());
        $profile->user_id = $user->id;

        $profile->save();

        $user->roles()->attach($request->input('groups'));

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("User Creation", [
            'Request' => [
                'name'  => $request->input('name'),
                'email' => $request->input('email'),
                'is_superuser' => $request->input('is_superuser')
            ]
        ]);

        return back();

    }


    public function update(Request $request, User $user)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $rules = [
            'name' => 'required|alpha_num|min:3|max:32',
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update($request->all());

        if(!$request->input('is_superuser')){
            $user->is_superuser = false;
            $user->save();
        }

        if(!$request->input('groups')){
            $user->roles()->sync([]);
        } else{
            $user->roles()->sync($request->input('groups'));
        }


        $profile = $user->profile;
        $profile->update($request->all());


        $request->session()->flash('status', 'El retailer ha sido modificado exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("User Update", [
            'Request' => [
                'name'  => $request->input('name'),
                'email' => $request->input('email'),
                'is_superuser' => $request->input('is_superuser')
            ],
            'Object' => $user->toArray()
        ]);

        return back();
    }

    public function changePassword(Request $request, User $user)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $rules = [
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->update([
            'password' => bcrypt($request->input('password')),
        ]);
        return back();
    }

    public function destroyConfirmation(Request $request, User $user)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('users.admin.destroy_confirmation', compact('user'));
    }

    public function destroy(Request $request, User $user)
    {
        $loged_user  = Auth::user();
        $user_groups = $loged_user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("User Delete", [
            'Request' => $request->all(),
            'Object' => $user->toArray()
        ]);

        $user->delete();
        return redirect('/admin/users');
    }
}
