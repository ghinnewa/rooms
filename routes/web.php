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
Route::auth();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('cards',  App\Http\Controllers\CardController::class);
    Route::get('requests',[ App\Http\Controllers\CardController::class,'requests'])->name('cards.requests');
    Route::resource('categories', App\Http\Controllers\CategoriesController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('attachments/download/{folder}/{name}', [App\Http\Controllers\CardController::class, 'downloadAttachment'])->name('attachments.downloadAttachment');
    // Your authorized routes here...
});
Route::post('store',[  App\Http\Controllers\CardController::class,'store'])->name('store');

Route::get('/card/{id}', [App\Http\Controllers\CardController::class, 'showpublic'])->name('card');
Route::get('publicForm',[ App\Http\Controllers\CardController::class,'publicForm'])->name('publicForm');


