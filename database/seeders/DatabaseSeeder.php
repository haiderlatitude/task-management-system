<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Task;
use App\Notifications\RoleAssigned;
use App\Notifications\WelcomeNotification;
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
        $userRole = Role::create(['name' => 'manager']);
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
        $admin->notify(new WelcomeNotification());
        $user->notify(new WelcomeNotification());
        $user->notify(new RoleAssigned());
        $this->call(StatusSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(DaysSeeder::class);

        // Task::factory(1000)->create();
    }
}
