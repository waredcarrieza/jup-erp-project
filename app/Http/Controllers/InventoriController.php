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

class InventoriController extends Controller
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
        return view('inventori.insert', $data);
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
        return view('inventori.detail', $data);
    }

    public function edit($id)
    {
        $query = DB::table('inventory')
                ->selectRaw('
                    inventory.*
                ')
                ->orderBy('inventory.no_inventory', 'DESC')
                ->where('inventory.code', $id)
                ->get()
                ->first();
        $row = (array) $query;

        $query_details = DB::table('inventory_details')
                ->selectRaw('
                    inventory_details.*,
                    produk.nama_produk, produk.no_produk
                ')
                ->leftJoin('produk', 'inventory_details.product_id', '=', 'produk.id')
                ->orderBy('inventory_details.id', 'ASC')
                ->where('inventory_details.inventory_id', $row['id'])
                ->get();
        
        $data = [
            'dbrow' => (array) $query,
            'dbrow_detail' => $query_details,
            'menuActive' => '', 
            'title' => 'Edit Barang Inventory',
        ];
        return view('inventori.update', $data);
    }

    public function getproducts(Request $request)
    {
        $key = $request->q;
        $csrftoken = $request->csrftoken;
        $result = '';
        if($request->q != ''):
            $query = DB::table('produk')
                    ->selectRaw('produk.*')
                    ->where(DB::raw('lower(produk.nama_produk)'), 'like', '%'. $request->q. '%')
                    ->orderBy('produk.nama_produk', 'ASC')
                    ->get();
            if($query):
                foreach($query as $row):
                    echo $row->nama_produk ."|". $row->id ."|". $row->no_produk . "\n";
                endforeach;
            endif;
        else:
           echo ''; 
        endif;
        exit;
    }

    public function index()
    {
        $query = DB::table('inventory_details')
                ->selectRaw('
                    inventory_details.*,
                    inventory.no_inventory, inventory.code as inventory_code,
                    produk.nama_produk
                ')
                ->leftJoin('inventory', 'inventory_details.inventory_id', '=', 'inventory.id')
                ->leftJoin('produk', 'inventory_details.product_id', '=', 'produk.id')
                ->orderBy('inventory.tanggal_inventory', 'DESC')
                ->get();
        
        $data = [
            'dataTables' => $query,
            'menuActive' => '', 
            'title' => 'Barang Inventory',
        ];
        return view('inventori.index', $data);
    }

    public function insert(Request $request)
    {
        DB::beginTransaction();

        try{
            $insert_inventory = DB::table('inventory')
                            ->insertGetId([
                                'code' => Uuid::uuid4(),
                                'tanggal_inventory' => ($request->tanggal_inventory != '' ? convertDateTime($request->tanggal_inventory, 'Y-m-d') : NULL),
                                'no_inventory' => ($request->no_inventory != '' ? $request->no_inventory : NULL),
                                'no_referensi' => ($request->no_referensi != '' ? $request->no_referensi : NULL),
                                'note' => ($request->note != '' ? $request->note : NULL),
                                'created_at' => Carbon::now()
                            ]);
            $inventory_id = $insert_inventory;

            $input_id = $request->product_id;
            $input_qty = $request->item_qty;
            $input_length = count($input_id);
            $exists_id = [];

            if($input_length > 0):
                for($x=0 ; $x<$input_length ; $x++):
                    if($input_id[$x] != ''):
                        //$findkey = null;
                        if(count($exists_id) == 0):
                            $exists_id[] = [
                                'code' => Uuid::uuid4(),
                                'inventory_id' => $inventory_id,
                                'product_id' => $input_id[$x],
                                'qty' => $input_qty[$x]
                            ];
                        elseif(count($exists_id) > 0):
                            $key = array_search($input_id[$x], array_column($exists_id, 'product_id'));
                            $findkey = $key;

                            //dump($findkey);

                            if($findkey):
                                $exists_id[$key]['qty'] += $input_qty[$x];
                            else:
                                $exists_id[] = [
                                    'code' => Uuid::uuid4(),
                                    'inventory_id' => $inventory_id,
                                    'product_id' => $input_id[$x],
                                    'qty' => $input_qty[$x]
                                ];
                            endif;
                        endif;
                    endif;
                endfor;
            endif;

            try{
                if(count($exists_id) > 0):
                    for($x=0 ; $x<count($exists_id) ; $x++):
                        try{
                            $insertInventoryDetail = DB::table('inventory_details')
                                                ->insertGetId([
                                            'inventory_id' => $inventory_id,
                                            'product_id' => $exists_id[$x]['product_id'],
                                            'qty' => $exists_id[$x]['qty'],
                                            'code' => $exists_id[$x]['code'],
                                            'created_at' => Carbon::now()
                                        ]);
                        } catch(\Exception $e) {
                            dd($e->getMessage()); exit;
                            DB::rollBack();
                        }
                    endfor;
                endif;

                DB::commit();

                return redirect( '/inventori' )
                    ->with('status', "Success");

            } catch(\Exception $e) {
                dd($e->getMessage()); exit;
                DB::rollBack();
                return redirect( '/inventori/create' )
                    ->with('status', "Failed");
            }

            DB::commit();

            return redirect( '/inventori' )
                    ->with('status', "Success");

        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/inventori/create' )
                    ->with('status', "Failed"); 
        }
    }

    public function update(Request $request)
    {
        $id = $request->inputId;
        $data_code = $request->inputCode;
        $avail_id = [];
        $avail_detail_id = [];
        $exists_id = [];
        //$findkey = null;

        $query_detail = DB::table('inventory_details')
                ->selectRaw('
                    inventory_details.*,
                    produk.nama_produk
                ')
                ->join('produk', 'inventory_details.product_id', '=', 'produk.id')
                ->where('inventory_details.inventory_id', $id)
                ->orderBy('inventory_details.id', 'ASC')
                ->get();
        if(count($query_detail) > 0):
            foreach($query_detail as $row):
                array_push($avail_id, $row->product_id);
                array_push($avail_detail_id, $row->id);
            endforeach;
        endif;

        DB::beginTransaction();

        try{
            $detail_id = $request->detail_id;
            $input_id = $request->product_id;
            $input_qty = $request->item_qty;
            $input_length = count($input_id);
            $remove_id = [];

            if($input_length > 0):
                for($x=0 ; $x<$input_length ; $x++):
                    if($input_id[$x] != ''):
                        //$findkey = null;
                        if(count($exists_id) == 0):
                            $exists_id[] = [
                                'detail_id' => $detail_id[$x],
                                'product_id' => $input_id[$x],
                                'qty' => $input_qty[$x]
                            ];
                            //array_push($exists_id, $newarr);
                        elseif(count($exists_id) > 0):
                            $key = array_search($input_id[$x], array_column($exists_id, 'product_id'));
                            $findkey = $key;

                            if($findkey):
                                $exists_id[$key]['qty'] += $input_qty[$x];
                            else:
                                $exists_id[] = [
                                    'detail_id' => $detail_id[$x],
                                    'product_id' => $input_id[$x],
                                    'qty' => $input_qty[$x]
                                ];
                                //array_push($exists_id, $newarr);
                            endif;
                        endif;
                    endif;
                endfor;
            endif;

            if(count($exists_id) > 0):
                for($x=0 ; $x<count($exists_id) ; $x++):
                    if($exists_id[$x]['product_id'] != '' && $exists_id[$x]['detail_id'] == ''):
                        try{
                            $insert_inventory_detail = DB::table('inventory_details')
                                                ->insertGetId([
                                            'inventory_id' => $id,
                                            'product_id' => $exists_id[$x]['product_id'],
                                            'qty' => $exists_id[$x]['qty'],
                                            'created_at' => Carbon::now()
                                        ]);
                        } catch(\Exception $e) {
                            dd($e->getMessage()); exit;
                            DB::rollBack();
                            $data = [
                                'menuActive' => '', 
                                'title' => 'INPUT BARANG INVENTORY',
                            ];
                        }
                    elseif($exists_id[$x]['product_id'] != '' && $exists_id[$x]['detail_id'] != ''):
                        try{
                            $update_inventory_detail = DB::table('inventory_details')
                                                ->where('id', $exists_id[$x]['detail_id'])
                                                ->update([
                                            'product_id' => $exists_id[$x]['product_id'],
                                            'qty' => $exists_id[$x]['qty'],
                                            'updated_at' => Carbon::now()
                                        ]);
                        } catch(\Exception $e) {
                            dd($e->getMessage()); exit;
                            DB::rollBack();
                            $data = [
                                'menuActive' => '', 
                                'title' => 'INPUT BARANG INVENTORY',
                            ];
                        }
                    endif;
                endfor;
            endif;

            if(count($avail_id) > 0):
                for($x=0 ; $x<count($avail_id) ; $x++):
                    if(!in_array($avail_id[$x], $input_id)):
                        try{
                            $delete_inventory_detail = DB::table('inventory_details')->where('id', $avail_detail_id[$x])->where('product_id', $avail_id[$x])->delete();
                        } catch(\Exception $e) {
                            dd($e->getMessage()); exit;
                            DB::rollBack();
                            $data = [
                                'menuActive' => '', 
                                'title' => 'INPUT BARANG INVENTORY',
                            ];
                        }
                    endif;
                endfor;
            endif;

            $update_inventory = DB::table('inventory')
                ->where('id', $request->inputId)
                ->update([
                    'tanggal_inventory' => ($request->tanggal_inventory != '' ? convertDateTime($request->tanggal_inventory, 'Y-m-d') : NULL),
                    'no_inventory' => ($request->no_inventory != '' ? $request->no_inventory : NULL),
                    'no_referensi' => ($request->no_referensi != '' ? $request->no_referensi : NULL),
                    'note' => ($request->note != '' ? $request->note : NULL),
                    'updated_at' => Carbon::now()
                ]);

            DB::commit();

            return redirect( '/inventori' )
                ->with('status', "Success");
        } catch(\Exception $e) {
            dd($e->getMessage()); exit;
            DB::rollBack();
            return redirect( '/inventori/edit/' . $data_code )
                    ->with('status', "Failed"); 
        }
    }
}