<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'index'])->middleware('guest');
Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/register', [AuthController::class, 'create'])->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest');
Route::get('/activate', [AuthController::class, 'activate'])->middleware('guest');

Route::middleware(['checkLevel:user'])->group(function () {
  Route::get('/logout', [AuthController::class, 'logout']);
  Route::get('/user', [UsersController::class, 'index']);
  Route::get('/user/account', [UsersController::class, 'account']);
  Route::get('/user/account/edit', [UsersController::class, 'editAccount']);
  Route::put('/user/account/edit', [UsersController::class, 'updateAccount']);

  Route::resource('/user/list', SettingsController::class);
  Route::resource('/user/list/item', ListsController::class);

  Route::get('/{id}', [ListsController::class, 'index']);
});
