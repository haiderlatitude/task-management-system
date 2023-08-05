<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Day::create(['name' => 'Monday']);
        Day::create(['name' => 'Tuseday']);
        Day::create(['name' => 'Wednesday']);
        Day::create(['name' => 'Thursday']);
        Day::create(['name' => 'Friday']);
        Day::create(['name' => 'Saturday']);
    }
}
