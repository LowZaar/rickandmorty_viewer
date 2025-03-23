<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;

Route::get('/', function () {
    return redirect()->route('characters.list');
});

Route::get('dashboard', function () {
    return redirect()->route('characters.list');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'characters', 'controller' => CharacterController::class], function () {
    Route::get('/', 'index')->name('characters.list');
    Route::get('/{id}', 'characterProfile')->name('character.profile');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
