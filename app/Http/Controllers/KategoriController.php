<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

use Session;

class KategoriController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function create()
    {
    	$data = [
            'menuActive' => '', 
            'title' => 'Input Produk Kategori',
        ];
        return view('kategori.insert', $data);
    }

    public function delete($id)
    {
        $query = DB::table('produk')
                ->leftJoin('produk_category', 'produk.category_id', '=', 'produk_category.id')
                ->where('produk_category.code', $id)->get()->first();

        if(count( (array)$query ) > 0){
            return redirect( '/kategori' )
                ->with('status', "Failed");
        }else{
            DB::beginTransaction();

            try{
                DB::table('produk_category')->where('code', $id )->delete();

                DB::commit();

                return redirect( '/kategori' )
                        ->with('status', "Success");
            } catch(\Exception $e) {
                dd($e->getMessage()); exit;
                DB::rollBack();
                return redirect( '/kategori' )
                    ->with('status', "Failed");
            }
        }
    }

    public function detail($id)
    {
        $query = DB::table('produk_category')
                ->selectRaw('
                    produk_category.*
                ')
                ->orderBy('produk_category.nama_category', 'DESC')
                ->where('produk_category.code', $id)
                ->get()
                ->first();
        
        $data = [
            'dbrow' => (array) $query,
            'menuActive' => '', 
            'title' => 'Rincian Produk Kategori',
        ];
        return view('kategori.detail', $data);
    }

    public function edit($id)
    {
        $query = DB::table('produk_category')
                ->selectRaw('
                    produk_category.*
                ')
                ->orderBy('produk_category.nama_category', 'DESC')
                ->where('produk_category.code', $id)
                ->get()
                ->first();
        
        $data = [
            'dbrow' => (array) $query,
            'menuActive' => '', 
            'title' => 'Edit Produk Kategori',
        ];
        return view('kategori.update', $data);
    }

    public function index()
    {
        $query = DB::table('produk_category')
                ->selectRaw('
                    produk_category.*
                ')
                ->orderBy('produk_category.nama_category', 'DESC')
                ->get();
        
        $data = [
            'dataTables' => $query,
            'menuActive' => '', 
            'title' => 'Produk Kategori',
        ];
        return view('kategori.index', $data);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();

        try{
            $insertcar = DB::table('produk_category')
                            ->insertGetId([
                                'code' => Uuid::uuid4(),
                                'no_category' => ($request->no_category != '' ? $request->no_category : NULL),
                                'nama_category' => ($request->nama_category != '' ? $request->nama_category : NULL),
                                'created_at' => Carbon::now()
                            ]);
            $car_id = $insertcar;

            DB::commit();

            return redirect( '/kategori' )
                    ->with('status', "Success");

        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/kategori/create' )
                    ->with('status', "Failed"); 
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try{
            $updateTransaction = DB::table('produk_category')
                ->where('id', $request->inputId)
                ->update([
                    'no_category' => ($request->no_category != '' ? $request->no_category : NULL),
                    'nama_category' => ($request->nama_category != '' ? $request->nama_category : NULL),
                    'updated_at' => Carbon::now()
                ]);

            DB::commit();

            return redirect( '/kategori' )
                ->with('status', "Success");
        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/kategori/edit/' . $id )
                    ->with('status', "Failed"); 
        }
    }
}