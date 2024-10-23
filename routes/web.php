<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;

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



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->group(function(){
        //users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/add', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        //category
        Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/categories/add', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/categories/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::get('/categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
});

require __DIR__.'/auth.php';
