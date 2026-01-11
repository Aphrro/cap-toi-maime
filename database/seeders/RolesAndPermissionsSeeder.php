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

        // Assign admin role to existing admin user
        $adminUser = \App\Models\User::where('email', 'admin@captoimaime.ch')->first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
            $adminUser->update(['user_type' => 'admin']);
        }
    }
}
