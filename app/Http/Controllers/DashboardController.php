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

class DashboardController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function __construct(){
        if(is_null(Auth::user())):
            return redirect(url('/user/signin'));
        endif;
    }

    public function index()
    {
        $username = '';
        if(Auth::check()){
        	$username = Auth::user()->title;
            $data = [
                'menuActive' => 'dashboard/',  
                'title' => 'Dashboard',
                'username' => $username
            ];
            return view('dashboard.index', $data);
        }
        return redirect("/user/signin")->with('status', 'Dashboard Throwback! You are not allowed to access');
    }
}