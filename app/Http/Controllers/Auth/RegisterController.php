<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $getDiv = DB::table('divs')->get();
        return view('register', compact('getDiv'));
    }

    public function registerPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:users',
            'password' => 'required|min:8',
            'flag' => 'required',

        ]);

        $data =  new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->flag = $request->flag;

        $data->password = bcrypt($request->password);
        $data->save();  
        Pegawa::create([
            'user_id' => $data->id,
            'role_id' => 4,
        ]);
        return redirect('login')->with('alert-success', 'You have been enrolled');
    }
}
