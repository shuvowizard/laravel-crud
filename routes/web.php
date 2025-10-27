<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;

Route::get('/', function () {
    return view('layouts.index');
});

// Route::get('shop/list', [ShopController::class, 'index'])->name('shop.index');
// Route::get('shop/create', [ShopController::class, 'create'])->name('shop.create');
// Route::post('shop/store', [ShopController::class, 'store'])->name('shop.store');
// Route::get('shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
// Route::put('shop/update/{id}', [ShopController::class, 'update'])->name('shop.update');
// Route::delete('shop/delete/{id}', [ShopController::class, 'destroy'])->name('shop.delete');



Route::prefix('/shop')->name('shop.')->group(function(){
    Route::get('/list', [ShopController::class, 'index'])->name('index');
    Route::get('/create', [ShopController::class, 'create'])->name('create');
    Route::post('/store', [ShopController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ShopController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [ShopController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ShopController::class, 'destroy'])->name('delete');
});

