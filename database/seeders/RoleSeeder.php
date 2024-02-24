<?php
namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(Role::where('name', 'super-admin')->exists()) {
            return;
        }
        $permissions = [
            [
                'name' => 'show configurations',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'edit configurations',
                'guard_name' => 'admin'
            ]
        ];

        $superAdminRole = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);

        foreach ($permissions as $permissionData) {
            $permission = Permission::create([
                'name' => $permissionData['name'],
                'guard_name' => $permissionData['guard_name']
            ]);
            $superAdminRole->givePermissionTo($permission);
        }

        $superAdminUser = Admin::first();
        $superAdminUser->assignRole($superAdminRole);
    }
}

