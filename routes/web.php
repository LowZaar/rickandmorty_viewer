<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CharacterController;


Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'characters', 'controller' => CharacterController::class,'middleware' => 'auth'], function () {
    Route::get('/', 'index');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
