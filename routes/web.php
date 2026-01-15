<?php

use App\Livewire\ContactPage;
use App\Livewire\EspacePro;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\ProfessionalSearch;
use App\Livewire\ProfessionalShow;
use App\Livewire\Questionnaire;
use App\Livewire\Results;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;

// ═══════════════════════════════════════════════════════════
// ROUTES PUBLIQUES (accessibles a tous)
// ═══════════════════════════════════════════════════════════

Route::get('/', HomePage::class)->name('home');
Route::view('/a-propos', 'pages.about')->name('about');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/faq', FaqPage::class)->name('faq');
Route::get('/espace-pro', EspacePro::class)->name('espace-pro');

Route::get('/temoignages', function () {
    return view('pages.temoignages', [
        'testimonials' => Testimonial::approved()->latest()->get(),
    ]);
})->name('temoignages');

// Pages legales
Route::view('/conditions-utilisation', 'pages.legal.conditions')->name('conditions');
Route::view('/politique-confidentialite', 'pages.legal.confidentialite')->name('confidentialite');
Route::view('/charte-ethique', 'pages.legal.charte-ethique')->name('charte-ethique');

// ═══════════════════════════════════════════════════════════
// PAGES ACCES MEMBRES
// ═══════════════════════════════════════════════════════════

Route::view('/acces-membre', 'pages.member-gate')->name('member.gate');
Route::view('/adhesion-en-attente', 'pages.member-pending')->name('member.pending');

// ═══════════════════════════════════════════════════════════
// ROUTES RESERVEES AUX MEMBRES (auth + member approved)
// ═══════════════════════════════════════════════════════════

Route::middleware(['member'])->group(function () {
    Route::get('/annuaire', ProfessionalSearch::class)->name('annuaire');
    Route::get('/professionnel/{professional:slug}', ProfessionalShow::class)->name('professional.show');
    Route::get('/questionnaire', Questionnaire::class)->name('questionnaire');
    Route::get('/resultats', Results::class)->name('results');
});

// ═══════════════════════════════════════════════════════════
// ROUTES AUTHENTIFIEES
// ═══════════════════════════════════════════════════════════

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// ═══════════════════════════════════════════════════════════
// ROUTE TEMPORAIRE - CREATION ADMIN (A SUPPRIMER APRES USAGE)
// ═══════════════════════════════════════════════════════════
Route::get('/setup-admin-secret-2026', function () {
    $adminEmail = 'admin@captoimaime.ch';

    // Creer le role admin si necessaire
    \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

    // Verifier si admin existe deja
    $existingUser = \App\Models\User::where('email', $adminEmail)->first();
    if ($existingUser) {
        // S'assurer qu'il a le role admin
        if (!$existingUser->hasRole('admin')) {
            $existingUser->assignRole('admin');
        }
        // Reset password au cas ou
        $existingUser->password = \Illuminate\Support\Facades\Hash::make('admin123');
        $existingUser->user_type = 'admin';
        $existingUser->save();

        return response()->json([
            'status' => 'fixed',
            'message' => 'Admin mis a jour avec role et password reset',
            'email' => $adminEmail,
            'password' => 'admin123',
            'user_type' => $existingUser->user_type,
            'roles' => $existingUser->getRoleNames(),
        ]);
    }

    // Creer le role admin si necessaire
    \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

    // Creer l'admin
    $user = \App\Models\User::create([
        'name' => 'Admin Cap Toi M\'aime',
        'email' => $adminEmail,
        'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
        'user_type' => 'admin',
        'is_active' => true,
    ]);

    $user->assignRole('admin');

    return response()->json([
        'status' => 'created',
        'message' => 'Admin cree avec succes!',
        'email' => $adminEmail,
        'password' => 'admin123',
        'warning' => 'CHANGEZ CE MOT DE PASSE! Et supprimez cette route!',
    ]);
});
