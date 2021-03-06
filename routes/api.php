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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('receipt', 'ReceiptController@store')->name('receipt.store');

Route::get('receipt', 'ReceiptController@show')->name('receipt.show');

Route::put('receipt', 'ReceiptController@update')->name('receipt.update');

Route::delete('receipt', 'ReceiptController@destroy')->name('receipt.destroy');

Route::patch('receipt', 'ReceiptController@certify')->name('receipt.certify');

