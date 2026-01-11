<?php

use App\Livewire\ProfessionalSearch;
use App\Livewire\ProfessionalShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::get('/annuaire', ProfessionalSearch::class)->name('annuaire');
Route::get('/professionnel/{professional:slug}', ProfessionalShow::class)->name('professional.show');

Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
