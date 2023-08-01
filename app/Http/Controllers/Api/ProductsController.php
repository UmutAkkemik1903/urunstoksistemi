<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productQuery = DB::table('products_list')->where(['products_list.deleted_at' => null])->orderBy('products_list.id', 'desc')
            ->join('product_definitions', function ($join) {

                $join->on('products_list.product_id', '=', 'product_definitions.id');
            })
            ->paginate(10,['product_definitions.product_name as product_id',
                'product_definitions.product_num as product_num',
                'product_definitions.product_bar as product_bar',
                'product_definitions.product_name as product_name',
                'products_list.product_skt as product_skt',
                'products_list.product_id as product_id',
                'products_list.id as id',]);
        return $productQuery;
    }

    public function productSearch($name)
    {
        if ($name) {
            $query = DB::table('products_list')
                ->where(['products_list.deleted_at' => null])
                ->join('product_definitions', function ($join) {

                    $join->on('products_list.product_id', '=', 'product_definitions.id');
                })
                ->where('product_definitions.product_name', 'LIKE', "%{$name}%")
                ->orderByDesc('products_list.id')
                ->paginate(10);
            return $query;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         DB::table('products_list')->insertGetId([

            'product_skt' => $request->input('product_skt'),
            'product_id' => $request->input('product_id'),
            'created_at' => date('Y-m-d H:i:s')
           /* 'created_by' =>  Auth::user()->id*/]);

        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'

        ]);



       /* $data = $request->only('product_num','product_bar','product_name','product_skt');
        $data['product_skt']=$data(date('Y-m-d','product_skt'));
        Products::create($data);
       */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productQuery = DB::table('products_list')->where('products_list.id',$id)
            ->join('product_definitions', function ($join) {

                $join->on('products_list.product_id', '=', 'product_definitions.id');
            })->get(['product_definitions.product_name as product_id',
                'product_definitions.product_num as product_num',
                'product_definitions.product_bar as product_bar',
                'product_definitions.product_name as product_name',
                'products_list.product_skt as product_skt',
                'products_list.product_id as product_id',
                'products_list.id as id',
                ]);

        return response()->json($productQuery,200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('products_list')->where(['id' =>$id])->update([
            'product_skt'=>$request->input('product_skt'),
            'updated_at' => date('Y-m-d H:i:s')
            /*'created_by' =>  Auth::user()->id*/]);
        DB::table('product_definitions')->where(['id'=> $id ])->update([
            'product_num' => $request->input('product_num'),
            'product_bar' => $request->input('product_bar'),
            'product_name' =>  $request->input('product_name'),
            'updated_at' => date('Y-m-d')
        ]);

        return response()->json([
            'success'=>true,
            'message'=>'Kaydedildi'

        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products_list')->where('id','=',$id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json([
            'success'=>true,
            'message'=>'Silindi'
        ]);
    }
}
