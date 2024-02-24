<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminsCount = Admin::count();
        if ($adminsCount === 0) {
            Admin::create([
                'name' => 'Super admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
            ]);
        }
    }
}
