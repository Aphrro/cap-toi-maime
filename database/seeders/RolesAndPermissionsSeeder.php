<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // User management
            'manage-users',
            'view-users',
            'suspend-users',

            // Professional validation
            'validate-professionals',
            'view-pending-professionals',

            // Content management
            'manage-categories',
            'manage-specialties',
            'manage-locations',
            'manage-professionals',

            // Dashboard
            'view-dashboard',
            'view-stats',

            // Notifications
            'send-notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $professional = Role::firstOrCreate(['name' => 'professional']);
        $professional->givePermissionTo([
            'view-dashboard',
        ]);

        $parent = Role::firstOrCreate(['name' => 'parent']);
        // Parents have no special permissions

        // Create or update admin user
        // Note: password is auto-hashed by the 'hashed' cast in User model
        $adminUser = \App\Models\User::updateOrCreate(
            ['email' => 'admin@captoimaime.ch'],
            [
                'name' => 'Administrateur',
                'password' => 'password',
                'user_type' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $adminUser->assignRole('admin');
    }
}
