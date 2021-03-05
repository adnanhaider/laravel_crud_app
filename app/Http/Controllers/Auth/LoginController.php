<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']); //it means this class functions should only be visible to these middleware users
    }
    public function index()
    {  
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=> 'required',
        ]);

        // dd($request);
        if(!Auth::attempt($request->only('email','password'),$request->remember)){
            return back()->with('status', 'Invalid login details');
        }
        else{
            return redirect()->route('dashboard');
        }
    }
}
