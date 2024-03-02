<?php

namespace Database\Seeders;

use App\Models\RoomLevelBackground;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomLevelBackgroundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (RoomLevelBackground::count() > 0) {
            return;
        }
        RoomLevelBackground::insert([
            ['level_id' => 1, 'image' => "public/uploads/level_background1.png"],
            ['level_id' => 2, 'image' => "public/uploads/level_background1.png"],
            ['level_id' => 3, 'image' => "public/uploads/level_background1.png"],
            ['level_id' => 4, 'image' => "public/uploads/level_background1.png"],
            ['level_id' => 5, 'image' => "public/uploads/level_background1.png"],
        ]);
    }
}
