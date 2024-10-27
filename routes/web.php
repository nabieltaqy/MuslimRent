<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PenaltyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\dashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

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
        //unit
        Route::get('/units/add', [UnitController::class, 'create'])->name('unit.create');
        Route::post('/units/store', [UnitController::class, 'store'])->name('unit.store');
        Route::get('/units/edit/{id}', [UnitController::class, 'edit'])->name('unit.edit');
        Route::put('/units/update/{id}', [UnitController::class, 'update'])->name('unit.update');
        Route::get('/units/delete/{id}', [UnitController::class, 'destroy'])->name('unit.destroy');
        //borrow
        Route::get('/borrows/edit/{id}', [BorrowController::class, 'edit'])->name('borrow.edit');
        Route::put('/borrows/update/{id}', [BorrowController::class, 'update'])->name('borrow.update');
        //penalty
        Route::get('/penalties', [PenaltyController::class, 'index'])->name('penalty.index');
        Route::get('/penalties/add', [PenaltyController::class, 'create'])->name('penalty.create');
        Route::post('/penalties/store', [PenaltyController::class, 'store'])->name('penalty.store');
        Route::get('/penalties/edit/{id}', [PenaltyController::class, 'edit'])->name('penalty.edit');
        Route::put('/penalties/update/{id}', [PenaltyController::class, 'update'])->name('penalty.update');
        Route::get('/penalties/delete/{id}', [PenaltyController::class, 'destroy'])->name('penalty.destroy');
        //print to pdf
        Route::get('/print-pdf', [BorrowController::class, 'generatePDF'])->name('borrow.print');
        
    });
    // Route::get('/borrows/', [BorrowController::class, 'index'])->name('borrow.index');
    //all user can do
    Route::get('/units', [UnitController::class, 'index'])->name('unit.index');
    Route::get('/borrows', [BorrowController::class, 'index'])->name('borrow.index');
    Route::get('/borrows/add/{id}', [BorrowController::class, 'create'])->name('borrow.create');
    Route::post('/borrows/store', [BorrowController::class, 'store'])->name('borrow.store');
    Route::get('/borrows/delete/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
    Route::get('/borrows/return/{id}', [BorrowController::class, 'return'])->name('borrow.return');
    Route::put('/borrows/saveReturn/{id}', [BorrowController::class, 'saveReturn'])->name('borrow.saveReturn');

    //review
    Route::post('/review/{type}/{id}', [ReviewController::class, 'store']);
});

require __DIR__.'/auth.php';
