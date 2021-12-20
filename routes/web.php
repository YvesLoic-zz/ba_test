<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get(
    '/',
    function () {
        return view('welcome');
    }
);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'userIs:owner'])->group(
    function () {

        Route::prefix('users')->group(
            function () {
                route::get(
                    'index',
                    [UserController::class, 'index']
                )->name('user_index');
                route::get(
                    'create',
                    [UserController::class, 'create']
                )->name('user_create');
                route::get(
                    '/{id}/show',
                    [UserController::class, 'show']
                )->name('user_show');
                route::post(
                    'store',
                    [UserController::class, 'store']
                )->name('user_store');
                route::post(
                    '/{id}/edit',
                    [UserController::class, 'edit']
                )->name('user_edit');
                route::put(
                    '/{id}/update',
                    [UserController::class, 'update']
                )->name('user_update');
                route::delete(
                    '/{id}/delete',
                    [UserController::class, 'destroy']
                )->name('user_delete');
            }
        );
    }
);
