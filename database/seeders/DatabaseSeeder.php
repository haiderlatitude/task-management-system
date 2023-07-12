<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $this->call(StatusSeeder::class);
        $admin = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'dob' => '1990-01-01',
            'phone' => '+92-312-3456789',
            'cnic' => '34101-1234567-1',
            'email_verified_at' => now(),
            'password' => 'admin',
        ]);

        $user = \App\Models\User::factory()->create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'dob' => '1990-01-01',
            'phone' => '+92-312-3456789',
            'cnic' => '34101-1234567-1',
            'email_verified_at' => now(),
            'password' => 'user',
        ]);

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);
    }
}
