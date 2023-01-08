<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['user', 'admin', 'mitra'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $users = User::get();
        foreach ($users as $user) {
            $user->assignRole('mitra');
        }
    }
}
