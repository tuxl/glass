<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
/*
Route::prefix('v1')->group(function () {
    Route::post('/partner/account/login', 'api_partner@accountLogin');
    Route::post('/partner/account/add', 'api_partner@addAccount');
    Route::post('/partner/account/update', 'api_partner@updatePartnerAccount');
    Route::post('/partner/account/resetpsw', 'api_partner@resetAccountPassword');
    Route::get('/partner/account/detail/{pid}/{id}', 'api_partner@accountDetail')->where('pid', '[0-9]+')->where('id', '[0-9]+');
    Route::get('/partner/account/list/{pid}/{offset}/{pagesize}', 'api_partner@partnerAccountList')
        ->where('pid', '[0-9]+')
        ->where('offset', '[0-9]+')
        ->where('pagesize', '[0-9]+');

});*/
