<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\TodoController;

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
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::get('/all', [TodoController::class, 'index'])->name('data.all');
    Route::post('/store', [TodoController::class, 'store'])->name('data.store');
    Route::get('/show/{id}', [TodoController::class, 'show'])->name('data.show');
    Route::post('/update', [TodoController::class, 'update'])->name('data.update');
    Route::get('/delete/{id}', [TodoController::class, 'destroy'])->name('data.delete');
    Route::post('/logout', [AuthController::class, 'logout']);
});
