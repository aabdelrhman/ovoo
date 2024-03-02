<?php

namespace Database\Seeders;

use App\Models\RoomLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (RoomLevel::count() > 0) {
            return;
        }
        RoomLevel::insert([
            ['title' => 'level 1'],
            ['title' => 'level 2'],
            ['title' => 'level 3'],
            ['title' => 'level 4'],
            ['title' => 'level 5']
        ]);
    }
}
