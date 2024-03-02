<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InterestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (\App\Models\Interest::count() > 0) {
            return;
        }
        \App\Models\Interest::insert([
            ['name' => 'Action'],
            ['name' => 'Adventure'],
            ['name' => 'Animation'],
            ['name' => 'Biography'],
            ['name' => 'Comedy'],
            ['name' => 'Crime'],
            ['name' => 'Documentary'],
            ['name' => 'Drama'],
            ['name' => 'Family'],
            ['name' => 'Fantasy'],
            ['name' => 'Film-Noir'],
            ['name' => 'Game-Show'],
            ['name' => 'History'],
            ['name' => 'Horror'],
            ['name' => 'Music'],
            ['name' => 'Musical'],
            ['name' => 'Mystery'],
            ['name' => 'News'],
            ['name' => 'Reality-TV'],
            ['name' => 'Romance'],
            ['name' => 'Sci-Fi'],
            ['name' => 'Sport'],
            ['name' => 'Talk-Show'],
            ['name' => 'Thriller'],
            ['name' => 'War'],
            ['name' => 'Western'],
        ]);
    }
}
