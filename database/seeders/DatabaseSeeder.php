<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            SettingsSeeder::class,
            RoomLevelSeeder::class,
            RoomLevelBackgroundSeeder::class,
            BannerSeeder::class,
            GiftsSeeder::class,
            RankSeeder::class,
            VipTypeSeeder::class,
            MedalTypesSeeder::class,
        ]);
    }
}
