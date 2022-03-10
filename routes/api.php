<?php

use App\Http\Controllers\CommentController;
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

Route::middleware('api')
    ->get('/comments/{post}/{parent_comment?}', [CommentController::class, 'getComments'])
    ->name('api.get-comments');

Route::middleware('api')
    ->post('/comments', [CommentController::class, 'store'])
    ->name('api.store-comment');
