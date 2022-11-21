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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
    Route::get('pokemons/{id}', 'App\Http\Controllers\V1PokemonController@get');
    Route::get('pokemons', 'App\Http\Controllers\V1PokemonController@index');
    Route::get('search', 'App\Http\Controllers\V1PokemonController@search');
});

Route::prefix('v2')->group(function () {
    Route::get('pokemons', 'App\Http\Controllers\V2PokemonController@index')->name('v2-pokemon-index');
});
