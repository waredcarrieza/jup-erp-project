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

class ProdukController extends Controller
{
    /**
     * Show the profile for a given user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */

    public function create()
    {
        $option_category = DB::table('produk_category')
                ->selectRaw('
                    produk_category.*
                ')
                ->orderBy('produk_category.nama_category', 'ASC')
                ->get();

    	$data = [
            'menuActive' => '', 
            'option_category' => $option_category,
            'title' => 'Input Produk Item',
        ];
        return view('produk.insert', $data);
    }

    public function delete($id)
    {
        $query = DB::table('inventory_details')
                ->leftJoin('produk', 'inventory_details.product_id', '=', 'produk.id')
                ->where('produk.code', $id)->get()->first();

        if(count( (array)$query ) > 0){
            return redirect( '/car' )
                ->with('status', "Failed");
        }else{
            DB::beginTransaction();

            try{
                DB::table('produk')->where('code', $id )->delete();

                DB::commit();

                return redirect( '/produk' )
                        ->with('status', "Success");
            } catch(\Exception $e) {
                dd($e->getMessage()); exit;
                DB::rollBack();
                return redirect( '/produk' )
                    ->with('status', "Failed");
            }
        }
    }

    public function detail($id)
    {
        $query = DB::table('produk')
                ->selectRaw('
                    produk.*,
                    produk_category.nama_category, produk_category.no_category
                ')
                ->leftJoin('produk_category', 'produk.category_id', '=', 'produk_category.id')
                ->orderBy('produk.nama_produk', 'DESC')
                ->where('produk.code', $id)
                ->get()
                ->first();
        
        $data = [
            'dbrow' => (array) $query,
            'menuActive' => '', 
            'title' => 'Rincian Produk Item',
        ];
        return view('produk.detail', $data);
    }

    public function edit($id)
    {
        $query = DB::table('produk')
                ->selectRaw('
                    produk.*
                ')
                ->orderBy('produk.nama_produk', 'DESC')
                ->where('produk.code', $id)
                ->get()
                ->first();

        $option_category = DB::table('produk_category')
                ->selectRaw('
                    produk_category.*
                ')
                ->orderBy('produk_category.nama_category', 'ASC')
                ->get();
        
        $data = [
            'dbrow' => (array) $query,
            'menuActive' => '', 
            'option_category' => $option_category,
            'title' => 'Edit Produk Item',
        ];
        return view('produk.update', $data);
    }

    public function index()
    {
        $query = DB::table('produk')
                ->selectRaw('
                    produk.*,
                    produk_category.nama_category, produk_category.no_category
                ')
                ->leftJoin('produk_category', 'produk.category_id', '=', 'produk_category.id')
                ->orderBy('produk.nama_produk', 'DESC')
                ->get();
        
        $data = [
            'dataTables' => $query,
            'menuActive' => '', 
            'title' => 'Produk Item',
        ];
        return view('produk.index', $data);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();

        try{
            $insertcar = DB::table('produk')
                            ->insertGetId([
                                'code' => Uuid::uuid4(),
                                'no_produk' => ($request->no_produk != '' ? $request->no_produk : NULL),
                                'nama_produk' => ($request->nama_produk != '' ? $request->nama_produk : NULL),
                                'category_id' => ($request->category_id != '' ? $request->category_id : NULL),
                                'created_at' => Carbon::now()
                            ]);
            $car_id = $insertcar;

            DB::commit();

            return redirect( '/produk' )
                    ->with('status', "Success");

        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/produk/create' )
                    ->with('status', "Failed"); 
        }
    }

    public function update(Request $request)
    {
        DB::beginTransaction();

        try{
            $updateTransaction = DB::table('produk')
                ->where('id', $request->inputId)
                ->update([
                    'no_produk' => ($request->no_produk != '' ? $request->no_produk : NULL),
                    'nama_produk' => ($request->nama_produk != '' ? $request->nama_produk : NULL),
                    'category_id' => ($request->category_id != '' ? $request->category_id : NULL),
                    'updated_at' => Carbon::now()
                ]);

            DB::commit();

            return redirect( '/produk' )
                ->with('status', "Success");
        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/produk/edit/' . $id )
                    ->with('status', "Failed"); 
        }
    }
}