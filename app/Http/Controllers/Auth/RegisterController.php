<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public  function index()
    {
        return view('auth.register');
    }
    public function store(Request $request){
        // dd($request); 
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email|max:255',
            'password'=>'required|confirmed',
        ]);
        
        User::create([
            'email'=>$request->email, 
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
        ]);
       
        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('dashboard');
    }
}
