<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Kwanjai\LpnController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('kwanjai/employee_resign_byDate', 'App\Http\Controllers\Api\Kwanjai\LpnController@getEmployeeResign_byDate');
Route::get('kwanjai/employee_resign', 'App\Http\Controllers\Api\Kwanjai\LpnController@getEmployeeResign');
Route::get('kwanjai/get_employee', 'App\Http\Controllers\Api\Kwanjai\LpnController@find_lpnEmployees');
