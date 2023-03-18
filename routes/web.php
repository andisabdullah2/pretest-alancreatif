<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ListController;

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

// Route::get('/', function () {
//     return view('products.index');
// });
Route::get('/list', [ListController::class, 'index'])->name('produk.index');


// Menampilkan daftar produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Menampilkan form tambah produk
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Menyimpan produk yang baru ditambahkan
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Menampilkan detail produk berdasarkan ID
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Menampilkan form edit produk berdasarkan ID
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Mengupdate produk berdasarkan ID
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Menghapus produk berdasarkan ID
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');