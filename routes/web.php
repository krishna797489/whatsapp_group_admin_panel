<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupsController;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// phpinfo(); die();
Route::get('/', function () {
    return view('authui.login');
});
//login route
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('verify', [AuthController::class, 'login'])->name('login.verify');

//dashboard route
Route::group(['middleware' => ['auth']], function () {
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('dashboard/get', [DashboardController::class, 'get'])->name('dashboard.get');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//groups route
Route::get('/groups', [GroupsController::class, 'index'])->name('groups.index');
Route::get('/groups/list', [GroupsController::class, 'list'])->name('groups.list');
Route::get('/groups/get', [GroupsController::class, 'get'])->name('groups.get');
Route::post('/groups/status', [GroupsController::class, 'status'])->name('groups.status');
//category
Route::get('/category', [GroupsController::class, 'categoryindex'])->name('category.index');
Route::get('/category/list', [GroupsController::class, 'categorylist'])->name('category.list');
Route::get('/category/get', [GroupsController::class, 'categoryget'])->name('category.get');



});