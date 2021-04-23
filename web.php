<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AdoptionController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('animals',AnimalController::class);
Route::resource('adoptions',AdoptionController::class);
Route::get('/adoptions', [App\Http\Controllers\AdoptionController::class, 'index'])->name('requests');

Route::get('/requestHistory', [App\Http\Controllers\AdoptionController::class, 'indexAdmin'])->name('requestsAdmin');

Route::get('/pendingRequests', [App\Http\Controllers\AdoptionController::class, 'pendingView'])->name('pendingView');

Route::get('/viewAll', [App\Http\Controllers\AdoptionController::class, 'viewAll'])->name('viewAll');

Route::group(['middleware' => ['auth']], function() {

Route::get('/store/{status}', 'App\Http\Controllers\AdoptionController@store');
Route::get('/accept/{status}', 'App\Http\Controllers\AdoptionController@accept');
Route::get('/deny/{status}', 'App\Http\Controllers\AdoptionController@deny');

});