<?php

use App\Http\Controllers\SiteController;
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

Route::get('/', [SiteController::class, 'homepage'])->name('/');
Route::get('/post/{post}', [SiteController::class, 'post'])->name('post');
/*
Route::get('{any}', function () {
    return view('app');
})->where('any', '.*');*/
