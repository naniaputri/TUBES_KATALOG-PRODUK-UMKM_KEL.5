
<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('katalog.index');
});

Route::get('/produk', [ProdukController::class, 'katalog'])
    ->name('katalog.index');

Route::get('/produk/{produk}', [ProdukController::class, 'show'])
    ->name('katalog.show');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/produk', [ProdukController::class, 'index'])
        ->name('produk.index');

    Route::get('/produk/create', [ProdukController::class, 'create'])
        ->name('produk.create');

    Route::post('/produk', [ProdukController::class, 'store'])
        ->name('produk.store');

    Route::get('/produk/{produk}/edit', [ProdukController::class, 'edit'])
        ->name('produk.edit');

    Route::put('/produk/{produk}', [ProdukController::class, 'update'])
        ->name('produk.update');

    Route::delete('/produk/{produk}', [ProdukController::class, 'destroy'])
        ->name('produk.destroy');
});
