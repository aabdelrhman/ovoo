<?php

namespace Database\Seeders;

use App\Models\ExclusivePrivilege;
use App\Models\Identification;
use App\Models\VipType;
use App\Models\VipTypeExclusivePrivilege;
use App\Models\VipTypeIdentification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (VipType::count() > 0) {
            return;
        }
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        // VipTypeIdentification::truncate();
        // VipTypeExclusivePrivilege::truncate();
        // VipType::truncate();
        // Identification::truncate();
        // ExclusivePrivilege::truncate();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
        VipType::insert([
            [
                'name' => 'Vip1',
                'active' => 1
            ],
            [
                'name' => 'Vip2',
                'active' => 1
            ],
            [
                'name' => 'Vip3',
                'active' => 1
            ],
            [
                'name' => 'Vip4',
                'active' => 1
            ],
        ]);

        Identification::insert([
            [
                'name' => 'title1',
                'description' => 'description1',
            ],
            [
                'name' => 'title2',
                'description' => 'description2',
            ],
            [
                'name' => 'title3',
                'description' => 'description3',
            ],
            [
                'name' => 'title4',
                'description' => 'description4',
            ],
            [
                'name' => 'title5',
                'description' => 'description5',
            ],
            [
                'name' => 'title6',
                'description' => 'description6',
            ],
        ]);

        ExclusivePrivilege::insert([
            [
                'name' => 'title1',
                'description' => 'description1',
            ],
            [
                'name' => 'title2',
                'description' => 'description2',
            ],
            [
                'name' => 'title3',
                'description' => 'description3',
            ],
            [
                'name' => 'title4',
                'description' => 'description4',
            ],
            [
                'name' => 'title5',
                'description' => 'description5',
            ],
            [
                'name' => 'title6',
                'description' => 'description6',
            ],
        ]);

        $vipType = VipType::first();
        $vipType->vipTypeIdentifications()->createMany([
            ['identification_id' => 1],
            ['identification_id' => 2],
            ['identification_id' => 3],
        ]);
        $vipType->vipTypeExclusivePrivileges()->createMany([
            ['exclusive_privilege_id' => 1],
            ['exclusive_privilege_id' => 2],
            ['exclusive_privilege_id' => 3],
        ]);


    }
}
