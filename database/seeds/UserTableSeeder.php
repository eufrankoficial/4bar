<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        \DB::table('user')->delete();
        $users = [
            [
                'name' => 'Franke Developer',
                'email' => 'frankedeveloper@gmail.com',
                'password' => 123,
                'slug' => 'franke-developer'
            ],
            [
                'name' => 'Carlos Cony',
                'email' => 'cony.carlos@gmail.com',
                'password' => 123,
                'slug' => 'franke-cony'
            ],
            [
                'name' => 'Leandro Cardoso',
                'email' => 'cardoso.boni@gmail.com',
                'password' => 123,
                'slug' => 'leandro-cardoso'
            ],
        ];

        \DB::table('roles')->delete();
        $roles = [
            [
                'name' => 'SuperAdmin',
                'slug' => 'super-admin'
            ],
            [
                'name' => 'Admin',
                'theme' => 'light_version',
                'slug' => 'admin'
            ],
        ];

        \DB::table('permissions')->delete();
        $permissions = [
            [
                'name' => 'list',
                'slug' => 'list'
            ],
            [
                'name' => 'add',
                'slug' => 'add'
            ],
            [
                'name' => 'alter',
                'slug' => 'alter'
            ],
            [
                'name' => 'delete',
                'slug' => 'delete'
            ]
        ];

        foreach($permissions as $perm) {
            Permission::create($perm);
        }

        foreach($roles as $role) {
            Role::create($role);
        }

        foreach ($users as $user) {
            User::create($user);
        }

        $superAdmin = User::find(1);
        $superAdmin->assignRole('SuperAdmin');
    }
}
