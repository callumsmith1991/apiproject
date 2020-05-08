<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', 'ApiController@index');
Route::get('/author/{name}', 'ApiController@author_filter');
Route::get('/categories/', 'ApiController@all_categories');
Route::get('/categories/{category}', 'ApiController@category_filter');
Route::get('/categories/{category}/author/{name}', 'ApiController@category_and_author_filter');

Route::post('/create/', 'ApiController@create_book');

Route::get('/{any}', function ($any) {

    return response()->json('message: 404 not found');

})->where('any', '.*');





