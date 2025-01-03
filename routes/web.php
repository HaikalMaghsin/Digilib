<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\BukuUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\admin\BukuController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\GenreController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\FacebookAuthController;
use App\Http\Controllers\admin\AdminTransaksiController;

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

Route::get('/', [DashboardController::class,'index'])->name('home');

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/coba', function () {
    return view('cobahome');
});

Route::get('/auth/redirect',[GoogleAuthController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleAuthController::class,'callback']);

Route::get('/auth/facebook',[FacebookAuthController::class, 'facebookpage']);
Route::get('/auth/facebook/callback', [FacebookAuthController::class,'callback']);


// Route::prefix('/admin')->group(function () {
//     Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::get('/transaction', [AdminController::class, 'transaction'])->name('admin.transaction');
//     Route::get('/comment', [AdminController::class, 'comment'])->name('admin.comment');
//     Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
// });



// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::resource('book', BookController::class);
// });

// Admin Routes
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     })->name('dashboard');

Route::middleware(['role:1'])->group(function () {
    Route::get('/admin', [AdminController::class,'dashboard']);
    Route::resource('buku', BukuController::class);
    Route::resource('kategori',KategoriController::class);
    Route::resource('genre',GenreController::class);
     Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::patch('/admin/transaksi/{id}', [AdminTransaksiController::class, 'update'])->name('admin.transaksi.update');
});

// Route::middleware(['role:2'])->group(function () {
//     Route::get('/editor/dashboard', 'EditorController@dashboard');
// });

Route::middleware(['role:3'])->group(function () {
    Route::resource('dashboard', BukuUserController::class);
    Route::get('/search',[BukuUserController::class,'search'])->name('search');
    Route::get('/bukushow/{id}', [BukuUserController::class, 'show'])->name('buku.show');
    Route::get('/transaksi/{id}/create', [TransaksiController::class, 'create'])->name('transaksi.create');
Route::post('/transaksi/{id}', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi/{id}', [TransaksiController::class, 'store'])->name('transaksi.store');
    
});