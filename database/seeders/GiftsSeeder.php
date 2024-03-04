<?php

namespace Database\Seeders;

use App\Models\Gift;
use App\Models\GiftType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GiftsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Gift::count() > 0 && GiftType::count() > 0) {
            return;
        }
        GiftType::insert([
            ['name' => 'Gifts'],
            ['name' => 'CP'],
            ['name' => 'VIP'],
            ['name' => 'Customized']
        ]);

        Gift::insert([
            ['name' => 'Gift 1', 'gift_type_id' => 1],
            ['name' => 'Gift 2', 'gift_type_id' => 1],
            ['name' => 'Gift 3', 'gift_type_id' => 1],
            ['name' => 'Gift 4', 'gift_type_id' => 1]
        ]);
    }
}
