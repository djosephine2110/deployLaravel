<?php

use Illuminate\Support\Facades\Route;
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

// Route::group(['namespace' => 'App\Api\v1\Controllers'], function () {
//     Route::group(['middleware' => 'auth:api'], function () {
//         Route::get('users', ['uses' => 'UserController@index']);
//     });
// });
// Route::get('/api/v1/customers', 'App\Http\Controllers\ApiController@getCustomers')->name('api.customers.index');
Route::prefix('v1')->group(function () {

    Route::group(['middleware' => 'auth-static-token'], function () {
        Route::get('/report/task/monthly', 'App\Http\Controllers\Api\ReportController@monthlyTask');
        Route::get('/report/task/total', 'App\Http\Controllers\Api\ReportController@totalTask');
        Route::get('/report/task/completed', 'App\Http\Controllers\Api\ReportController@taskCompleted');
        Route::get('/report/task/incomplete', 'App\Http\Controllers\Api\ReportController@taskIncomplete');
        Route::get('/report/task/overdue', 'App\Http\Controllers\Api\ReportController@taskOverdue');
        Route::get('/report/project/total', 'App\Http\Controllers\Api\ReportController@totalProject');
        Route::get('/divisions', 'App\Http\Controllers\Api\DivisionController@index');
        Route::get('/report/task/division', 'App\Http\Controllers\Api\ReportController@taskByDivision');
    });
});

//Route::get('/v1/report/task/annualy/{year}', 'App\Http\Controllers\Api\ReportController@annualyTask');
