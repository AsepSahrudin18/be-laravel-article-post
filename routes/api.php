<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ArticleController,

};

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/articles', [ArticleController::class, 'store'])->name('articles');
Route::get('/article/{limit}/{offset}', [ArticleController::class, 'index'])->name('article.index');
Route::get('/article/{id}', [ArticleController::class, 'show'])->name('article.show');
Route::put('/article/{id}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('/article/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');