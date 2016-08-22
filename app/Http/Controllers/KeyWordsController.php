<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\KeyWord;

use Log;

use Auth;

class KeyWordsController extends Controller
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
        $key_words = KeyWord::Paginate(10);
        return view('key_words.admin.index', compact('key_words'));
    }

    public function show(Request $request, KeyWord $key_word)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        if($request->ajax())
        {
            return response()->json([
                'name' => $key_word->name,
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

        $key_word = new KeyWord($request->all());
        $key_word->save();

        $request->session()->flash('status', 'La palabra clave ha sido añadida exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("KeyWord Created", [
            'Request' => $request->all()
        ]);

        return back();

    }

    public function update(Request $request, KeyWord $key_word)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $key_word->update($request->all());

        $request->session()->flash('status', 'La palabra clave ha sido modificada exitosamente.');

        Log::useFiles(storage_path().'/userlog.log');
        Log::info("KeyWord Update", [
            'Request' => $request->all(),
            'Object'  => $key_word->toArray()
        ]);

        return back();
    }

    public function destroyConfirmation(Request $request, KeyWord $key_word)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        return view('key_words.admin.destroy_confirmation', compact('key_word'));
    }

    public function destroy(Request $request, KeyWord $key_word)
    {
        $user        = Auth::user();
        $user_groups = $user->roles()->lists('name')->toArray();

        if(in_array('ReadOnly', $user_groups)){
            abort(403, 'Unauthorized action.');
        }
        Log::useFiles(storage_path().'/userlog.log');
        Log::info("KeyWord Delete", [
            'Request' => $request->all(),
            'Object' => $key_word->toArray()
        ]);

        $key_word->delete();
        return redirect('/admin/key-words');
    }
}
