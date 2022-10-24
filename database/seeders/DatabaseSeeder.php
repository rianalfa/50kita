<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'superadmin',
            'username' => 'superadmin',
            'email' => 'superadmin@50kita.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password' => Hash::make('superadmin'),
        ]);
    }
}
