<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*,'throttle:60,1','auth'*/
Route::group(['middleware' => ['web','throttle:60,1','auth']], function () {

    Route::apiResources([
        'product'=>'Api\ProductsController',
        'productDefinition'=> 'Api\ProductDefinitionController',
        ''=> 'Api\DashboardController'
    ]);

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('defSearch/{data}','Api\ProductDefinitionController@defSearch');
    Route::get('productSearch/{data}','Api\ProductsController@productSearch');


});






