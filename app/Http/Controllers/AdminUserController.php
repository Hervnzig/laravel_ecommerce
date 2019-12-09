<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(){
        
        return view('admin.login');
    }

    public function store(Request $request){
        
        // Validate the user
        $request->validate([
            'email'=> 'required|email',
            'password'=> 'required'
        ]);

        // Login the user
        $credentials = $request->only('email', 'password');
        if(! Auth::guard('admin')->attempt($credentials)){
            return back()->withErrors([
                'message'=>'Wrong credentials, please try again'
            ]);
        }

        // Session message
        session()->flash('msg', 'You have been logged in');

        // Redirect
        return redirect('/');
    }
}
