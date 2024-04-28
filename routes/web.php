<?php

use App\Http\Controllers\DataAtletController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\NilaiSubKriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PerangkinganController;
use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SubKriteriaController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/tahun/{tahun}', [HomeController::class, 'tahun'])->name('tahun');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
	Artisan::call('route:clear');
	Artisan::call('config:clear');
	Artisan::call('view:clear');
    return 'Application cache has been cleared';
});

Route::get('/table', function () {
    return view('table');
});

// route middleware auth
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::resource('data-user', DataUserController::class);
    Route::resource('data-guru', DataAtletController::class);
    Route::resource('data-periode', PeriodeController::class);
    Route::resource('data-kriteria', KriteriaController::class);
    Route::resource('data-sub-kriteria', SubKriteriaController::class);
    Route::resource('nilai-sub-kriteria', NilaiSubKriteriaController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('perhitungan', PerhitunganController::class);
	Route::get('/cetak/{id}', [PerangkinganController::class, 'cetak'])->name('perangkingan.cetak');
    Route::resource('perangkingan', PerangkinganController::class)->only([
        'index', 'show'
    ]);

    Route::post('import-nilai', [PenilaianController::class, 'import'])->name('import-nilai');
});

require __DIR__.'/auth.php';
