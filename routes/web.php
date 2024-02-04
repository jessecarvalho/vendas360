<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/encerrar-dia', [AdminController::class, 'finishDay'])->name('finish-day');
    Route::post('/enviar-relatorio-para-vendedor', [AdminController::class, 'generateReportForUniqueSeller'])->name('send-report-to-seller');
});

Route::middleware(['auth', 'verified'])->prefix('vendedores')->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('sellers.index');
    Route::get('/criar', [SellerController::class, 'create'])->name('sellers.create');
    Route::post('/criar', [SellerController::class, 'store'])->name('sellers.store');
    Route::get('/editar/{seller}', [SellerController::class, 'edit'])->name('sellers.edit');
    Route::put('editar/{seller}', [SellerController::class, 'update'])->name('sellers.update');
    Route::delete('/{seller}', [SellerController::class, 'destroy'])->name('sellers.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('vendas')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/criar', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/criar', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/editar/{sale}', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('/editar/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
