<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return redirect()->route('home');
});
Route::get('home',[HomeController::class, 'index'])->name('home');
Route::post('add-data',[HomeController::class, 'addData'])->name('add-data');
Route::get('get-data',[HomeController::class, 'getData'])->name('get-data');
Route::get('train', [HomeController::class, 'train'])->name('train');
Route::get('new-data', [HomeController::class, 'addDataUpdateHistory'])->name('new-data');
Route::post('new-predictions', [HomeController::class, 'addPredictions'])->name('new-predictions');
