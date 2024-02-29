<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;

use Session;

class UserController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('status', 'Login berhasil!');
        }

        return redirect("/")->with('status', 'Detil login tidak sesuai!')->with('status_alert', 'danger');
    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
  
        return Redirect('/user/signin')->with('status', 'Anda telah berhasil Logout!');
    }

    /*
     * Halaman Login User
    */
    public function signin()
    {
    	$username = '';
    	if(Auth::check()){
    		$username = Auth::user()->nama;
    	}else{
    		$username = 'unknown';
    	}

        $data = [
            'menuActive' => '', 
            'title' => 'User Login',
            'newpass' => Hash::make('p@ssw0rd'),
            'username' => $username
        ];
        return view('user.login', $data);
    }
}