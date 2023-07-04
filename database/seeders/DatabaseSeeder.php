<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StatusSeeder::class);
        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => 'admin',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => 'user',
        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}
