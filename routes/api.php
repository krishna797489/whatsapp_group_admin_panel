<?php

use App\Http\Controllers\groupsapiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */


// add group 
Route::post('addgroup',[groupsapiController::class,'addgroup']);
Route::get('getgroup',[groupsapiController::class,'index']);
Route::get('getwhatsapp',[groupsapiController::class,'getwhatsapp']);
Route::get('gettelegram',[groupsapiController::class,'telegram']);
Route::post('message/{id}',[groupsapiController::class,'update']);
Route::get('count/{id}',[groupsapiController::class,'count']);
Route::get('newgroups',[groupsapiController::class,'newshow']);







//category
Route::post('category',[groupsapiController::class,'category']);
Route::get('getcategory',[groupsapiController::class,'getcategory']);
Route::get('category/{categoryId}', [groupsapiController::class, 'getGroupsByCategoryId']);
Route::get('/getGroupsByCategorywhatsapp/{category_id}', [groupsapiController::class, 'getGroupsByCategorywhatsapp']);
Route::get('/getGroupsByCategorytelegram/{category_id}', [groupsapiController::class, 'getGroupsByCategorytelegram']);


