<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Services\Localization\LocalizationService;
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

Route::group(['prefix'=> LocalizationService::locale()], function() {

    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

    });

    Route::middleware('auth')->group(function () {

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');

        Route::post('lots/{lot}/bid', [\App\Http\Controllers\BidController::class, 'store'])->name('lots.bid');

    });


    Route::group(['prefix' => 'my', 'middleware' => 'auth'], function () {
        Route::get('lots/favorites', [\App\Http\Controllers\Lots\FavoritesController::class, 'index'])->name('lots.favorites');
        Route::resource('lots', \App\Http\Controllers\Lots\LotResourceController::class);
        Route::post('lots/{lot}/add-images', [\App\Http\Controllers\Lots\ImageController::class, 'store'])->name('lots.add.images');
        Route::put('lots/{lot}/{image}/make-main', [\App\Http\Controllers\Lots\ImageController::class, 'makeMain'])->name('lots.images.make.main');
        Route::delete('lots/{lot}/{image}', [\App\Http\Controllers\Lots\ImageController::class, 'delete'])->name('lots.images.destroy');



    });

    Route::get('/', [\App\Http\Controllers\Lots\PublicLotController::class, 'index'])->name('home');
    Route::get('lots', [\App\Http\Controllers\Lots\PublicLotController::class, 'all'])->name('public.lots.all');
    Route::get('lots/{lot}', [\App\Http\Controllers\Lots\PublicLotController::class, 'show'])->name('public.lots.show');
    Route::get('lots/search/result', [\App\Http\Controllers\Lots\PublicLotController::class, 'search'])->name('public.lots.search');
    Route::get('actions', [\App\Http\Controllers\MessageController::class, 'index'])->name('public.actions');
});







