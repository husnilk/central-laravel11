<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $system_roles = config('central.system_roles');

        $admin = null;
        $dosen = null;
        $gkm = null;

        foreach ($system_roles as $type => $role) {
            if ($type === 'administrator') {
                $admin = Role::create(['name' => $role, 'guard_name' => 'api']);
            } elseif ($type === 'lecturer') {
                $dosen = Role::create(['name' => $role, 'guard_name' => 'api']);
            } elseif ($type === 'gkm') {
                $gkm = Role::create(['name' => $role, 'guard_name' => 'api']);
            } else {
                Role::create(['name' => $role, 'guard_name' => 'api']);
            }
        }

        $arrayOfPermissionNames = [
            'users:manage',
            'roles:access',
            'roles:manage',
            'departments:access',
            'departments:manage',
            'faculties:access',
            'faculties:manage',
            'students:access',
            'students:manage',
            'lecturers:access',
            'lecturers:manage',
            // 'staffs:access',
            // 'staffs:manage',
            'rooms:access',
            'rooms:manage',
            // 'researches:access',
            // 'researches:manage',
            // 'communityservices:access',
            // 'communityservices:manage',
            // 'theses:access',
            // 'theses:manage'
            'curricula:access',
            'curricula:manage',
            'courses:access',
            'courses:manage',
            'courseplans:access',
            'courseplans:manage',
            'classes:access',
            'classes:manage',
            'bap:access',
            'bap:manage',
            'bap:verify',
            'assessments:access',
            'assessments:manage',
            'monev:access',
        ];

        foreach ($arrayOfPermissionNames as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }

        // give permission to role
        $admin->givePermissionTo(['users:manage', 'roles:manage', 'departments:manage', 'students:manage', 'lecturers:manage', 'curricula:manage', 'courses:manage', 'classes:manage', 'monev:access']);

        $gkm->givePermissionTo(['monev:access', 'bap:verify']);

        $dosen->givePermissionTo(['departments:access', 'faculties:access', 'rooms:access', 'students:access', 'lecturers:access', 'curricula:access', 'courses:access', 'courseplans:manage', 'classes:access', 'bap:manage', 'assessments:manage']);
    }
}
