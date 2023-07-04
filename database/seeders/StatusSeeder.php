<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Status::create(['name' => 'pending']);
        \App\Models\Status::create(['name' => 'in-progress']);
        \App\Models\Status::create(['name' => 'completed']);
    }
}
