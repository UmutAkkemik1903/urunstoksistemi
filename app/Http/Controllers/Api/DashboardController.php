<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date=date('yyyy-mm-dd',strtotime('-1 day'));
        $productQuery = DB::table('products_list')->where(['products_list.product_skt' =>$date ])->orderBy('products_list.id', 'desc')
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
