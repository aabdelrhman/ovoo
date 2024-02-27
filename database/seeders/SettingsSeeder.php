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
        if (\App\Models\Setting::count() > 0) {
            return;
        }
        \App\Models\Setting::insert([[
            'key' => 'site_name_ar',
            'category' => 'general',
            'value' => "ovoo"
        ] ,[
            'key' => 'site_name_en',
            'category' => 'general',
            'value' => "ovoo"
        ] , [
            'key' => 'site_logo',
            'category' => 'general',
            'value' => 'logo.png'
        ] ,[
            'key' => 'splash_logo',
            'category' => 'general',
            'value' => "logo.png"
        ] ,[
            'key' => 'splash_video',
            'category' => 'general',
            'value' => "logo.png"
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
