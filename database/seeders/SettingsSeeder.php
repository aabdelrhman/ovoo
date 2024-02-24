<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (\App\Models\Setting::where('key', 'site_name')->exists()) {
            return;
        }
        \App\Models\Setting::insert([[
            'key' => 'site_name',
            'category' => 'general',
            'value' => json_encode([
                'en' => 'Ovoo',
                'ar' => 'Ovoo',
            ])
        ] , [
            'key' => 'site_description',
            'category' => 'general',
            'value' => json_encode([
                'en' => 'Ovoo',
                'ar' => 'Ovoo',
            ])
        ] , [
            'key' => 'site_logo',
            'category' => 'general',
            'value' => 'logo.png'
        ] , [
            'key' => 'facebook',
            'category' => 'social',
            'value' => 'https://facebook.com'
        ] , [
            'key' => 'twitter',
            'category' => 'social',
            'value' => 'https://twitter.com'
        ] , [
            'key' => 'snapchat',
            'category' => 'social',
            'value' => 'https://snapchat.com'
        ] , [
            'key' => 'instgram',
            'category' => 'social',
            'value' => 'https://instgram.com'
        ] , [
            'key' => 'website',
            'category' => 'social',
            'value' => 'https://ovoo.app'
        ] , [
            'key' => 'splach_photo',
            'category' => 'splach',
            'value' => 'logo.png'
        ] , [
            'key' => 'splach_video',
            'category' => 'splach',
            'value' => 'logo.png'
        ] , [
            'key' => 'privacy_policy',
            'category' => 'app_rules',
            'value' => json_encode([
                'en' => '<h1>Privacy Policy</h1>',
                'ar' => '<h1>Privacy Policy</h1>',
            ])
        ] , [
            'key' => 'terms_and_conditions',
            'category' => 'app_rules',
            'value' => json_encode([
                'en' => '<h1>Terms and conditions</h1>',
                'ar' => '<h1>Terms and conditions</h1>',
            ])
        ]]);
    }
}
