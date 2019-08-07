<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function store(Request $request)
    {
        // validate the user
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // log the user in
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('admin')->attempt($credentials)) {
            return back()->withErrors([
                'message' => 'wrong credentials please try again'
            ]);
        }

        // session message
        session()->flash('msg', 'You have be been logged in');

        // redirect
        return redirect('/admin');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        session()->flash('msg', 'You have been logout');

        return redirect('admin/login');
    }
}
