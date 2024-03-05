<?php

namespace Database\Seeders;

use App\Models\Rank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Rank::count() > 0) {
            return;
        }
        Rank::insert([
            ['name' => 'Silver'],
            ['name' => 'Gold'],
            ['name' => 'Platinum'],
            ['name' => 'Diamond'],
            ['name' => 'Crown'],
            ['name' => 'Crown Plus'],
        ])
    }
}
