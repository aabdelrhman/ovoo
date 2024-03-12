<?php

namespace Database\Seeders;

use App\Models\MedalType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedalTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (MedalType::count() > 0) {
            return;
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        MedalType::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        MedalType::insert([
            [
                'name' => 'General Medals'
            ],
            [
                'name' => 'General Medals'
            ]
        ]);
    }
}
