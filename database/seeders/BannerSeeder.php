<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Banner::count() > 0) {
            return;
        }
        Banner::create([
            'image' => 'public/uploads/banner.png',
        ]);
    }
}
