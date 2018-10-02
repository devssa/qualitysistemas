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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// Route::apiResource('pessoas', 'PessoaController');
Route::get('pessoas', 'PessoaController@index');
Route::get('pessoas/{id}', 'PessoaController@show');
Route::post('pessoas', 'PessoaController@store');
Route::post('pessoas/{id}/foto', 'PessoaController@uploadImage');
Route::put('pessoas/{id}', 'PessoaController@update');
Route::delete('pessoa/{id}', 'PessoaController@destroy');

// Route::apiResource('dependente', 'DependenteController');
Route::get('dependente/{id}', 'DependenteController@getAll');
Route::post('dependente', 'DependenteController@store');
Route::delete('dependente/{id}', 'DependenteController@destroy');
