<?php

declare(strict_types=1);

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas');

Route::prefix('ideas')->controller(IdeaController::class)->middleware('auth')->group(function(){
    Route::get('/', 'index')->name('ideas-index');
    Route::get('/create', 'create')->name('ideas-create');
    Route::post('/create', 'store');
    Route::get('/{idea}', 'show')->name('ideas-show');
    Route::get('/{idea}/edit', 'edit')->name('ideas-edit');
    Route::post('/{idea}/edit', 'update');
    Route::post('/{idea}/delete', 'destroy')->name('ideas-destroy');
});

Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
    
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');
