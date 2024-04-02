<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/film', [FilmController::class, 'index'])->name('film');
Route::Post('/Addfilm', [FilmController::class, 'store'])->name('store');
Route::get('/Showfilm/{id}', [FilmController::class, 'show'])->name('show');
Route::Post('/updateFilm/{id}', [FilmController::class, 'update'])->name('update');
Route::delete('/deletefilm/{id}', [FilmController::class, 'destroy'])->name('delete');
