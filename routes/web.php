<?php

use App\Livewire\HomePage;
use App\Livewire\ProfessionalSearch;
use App\Livewire\ProfessionalShow;
use App\Livewire\Questionnaire;
use App\Livewire\Results;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
Route::get('/resultats', Results::class)->name('results');

Route::get('/annuaire', ProfessionalSearch::class)->name('annuaire');
Route::get('/professionnel/{professional:slug}', ProfessionalShow::class)->name('professional.show');

Route::view('/a-propos', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/faq', 'pages.faq')->name('faq');

Route::get('/temoignages', function () {
    return view('pages.temoignages', [
        'testimonials' => Testimonial::approved()->latest()->get(),
    ]);
})->name('temoignages');

// Pages legales
Route::view('/conditions-utilisation', 'pages.legal.conditions')->name('conditions');
Route::view('/politique-confidentialite', 'pages.legal.confidentialite')->name('confidentialite');
Route::view('/charte-ethique', 'pages.legal.charte-ethique')->name('charte-ethique');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
