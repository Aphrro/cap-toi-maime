<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Cree un compte administrateur pour Cap Toi M'aime
     */
    public function run(): void
    {
        // S'assurer que le role admin existe
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);

        // Creer ou mettre a jour l'admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@captoimaime.ch'],
            [
                'name' => 'Admin Cap Toi M\'aime',
                'password' => Hash::make('admin123'),
                'user_type' => 'admin',
                'is_active' => true,
            ]
        );

        // Assigner le role admin
        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $this->command->info('Admin cree avec succes!');
        $this->command->info('Email: admin@captoimaime.ch');
        $this->command->info('Mot de passe: admin123');
        $this->command->warn('IMPORTANT: Changez ce mot de passe apres la premiere connexion!');
    }
}
