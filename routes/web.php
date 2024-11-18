<?php

use App\Http\Controllers\PersonalDetailsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::post('personal_information', [PersonalDetailsController::class, 'store'])->name('personal_information.store');

Route::post('/import', [PersonalDetailsController::class, 'import'])->name('import');

Route::get('data', [PersonalDetailsController::class, 'index'])->name('data.index')->middleware('auth');

Route::get('/data/{id}', [PersonalDetailsController::class, 'edit'])->name('data.edit')->middleware('auth');
Route::put('/data/{id}', [PersonalDetailsController::class, 'update'])->name('personal_information.update')->middleware('auth');
