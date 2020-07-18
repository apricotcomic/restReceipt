<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/receiptinfo/menu', 'MenuController@menu')->name('menu');

Route::get('/print/{id}', 'ReceiptPrintController@print')->name('print');
Route::get('/receiptinfo', 'ReceiptPrintController@index')->name('receiptinfo.index');
Route::get('/receiptinfo/{id}', 'ReceiptPrintController@show')->name('receiptinfo.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/receipt', 'ShowReceiptController@index')->name('receiptindex');

Route::post('/receipt/display', 'ShowReceiptController@display')->name('receiptdisplay');


