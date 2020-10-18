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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified')->middleware('auth');

Route::post('/appointment/add',[App\Http\Controllers\HomeController::class, 'add'])->name('add')->middleware('verified')->middleware('auth');
Route::post('/appointment/delete',[App\Http\Controllers\HomeController::class, 'del'])->name('del')->middleware('verified')->middleware('auth');
Route::post('/appointment/mark',[App\Http\Controllers\HomeController::class, 'mark'])->name('mark')->middleware('verified')->middleware('auth');
