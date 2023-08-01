<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductDefinitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  DB::table('product_definitions')->where([
            'deleted_at' => null,
            /* 'created_by' =>  Auth::user()->id*/
        ])->paginate(10);
    }
    public function defSearch($name){
        if($name){
            $defList = DB::table('product_definitions')
                ->where(['product_definitions.deleted_at'=> null])
                ->where('product_definitions.product_name','LIKE', "%{$name}%")
                ->orderByDesc('product_definitions.id')
                ->paginate(10);
            return $defList;
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
        $validator = Validator::make($request->all(), [
            'product_num' => 'required|string|max:8',
            'product_bar' => 'required|string',
            'product_name' => 'required|string'


        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::table('product_definitions')->insert([

            'product_num' => $request->input('product_num'),
            'product_bar' => $request->input('product_bar'),
            'product_name' => $request->input('product_name'),
            'created_at' => date('Y-m-d H:i:s')
            /*'created_by' =>  Auth::user()->id*/]);
        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = DB::table('product_definitions')->where(['id' => $id])->get();
        return $products;
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
        $validator = Validator::make($request->all(), [
            'product_num' => 'required|string|max:8',
            'product_bar' => 'required|string',
            'product_name' => 'required|string'


        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Bir hata oluştu',
                'errors' => $validator->errors()
            ], 422);
        }
        DB::table('product_definitions')->where(['id' => $id])->update([

            'product_num' => $request->input('product_num'),
            'product_bar' => $request->input('product_bar'),
            'product_name' => $request->input('product_name'),
            'updated_at' => date('Y-m-d H:i:s')
            /*'created_by' =>  Auth::user()->id*/]);
        return response()->json([
            'success' => true,
            'message' => 'Kaydedildi'

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
        DB::table('product_definitions')->where('id', '=', $id)->update([
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Silindi'
        ]);

    }
}
