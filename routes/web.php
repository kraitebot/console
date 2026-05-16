<?php

use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Accounts\AccountsIndex;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserShow;
use App\Livewire\Users\UsersIndex;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', fn () => view('dashboard.index'))->name('dashboard');

    Route::get('/users', UsersIndex::class)->name('users.index');
    Route::get('/users/create', UserCreate::class)->name('users.create');
    Route::get('/users/{user}', UserShow::class)->name('users.show');

    Route::get('/accounts', AccountsIndex::class)->name('accounts.index');
});
