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

class MyController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function index()
    {
        $data = [
            'var_1' => 'Hello World!'
        ];
        return view('myview.index', $data);
    }

    public function mytry()
    {
        $data = [
            'var_1' => 'Hello World!'
        ];
        return view('myview.try-1', $data);
    }

    public function myresult(Request $request)
    {
        $var_1 = $request->var_1;
        $var_2 = $request->var_2;

        $data = [
            'var_1' => $var_1,
            'var_2' => $var_2,
        ];
        return view('myview.result', $data);
    }

    public function myresult_2(Request $request)
    {
        $var_1 = $request->var_1;
        $var_2 = $request->var_2;
        $var_3 = $request->var_3;
        
        $data = [
            'var_1' => $var_1,
            'var_2' => $var_2,
            'var_3' => $var_3,
        ];
        return view('myview.result-2', $data);
    }

    public function myresult_3(Request $request)
    {
        $data = [
            'var_1' => 'Hello World!'
        ];
        return view('myview.result-3', $data);
    }
}