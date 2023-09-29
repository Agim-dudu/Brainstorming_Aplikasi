<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TabelDataController;

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
    return view('login');
});


Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {

    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product{id}', [ProductController::class, 'addToCart'])->name('add_to_cart');
    Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
    Route::delete('/remove-from-cart', [ProductController::class, 'remove'])->name('remove_from_cart');

    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.'
    ], function () {
        Route::resource('tambah_data', ProductController::class)->name('*','tambah_data');
        Route::resource('tabel_data', TabelDataController::class)->name('*','tabel_data');
        Route::resource('/product', ProductController::class)->name('*','product');
        // Route::resource('table_data', ProductController::class)->name('*','tabel_data');
        
    });
});
