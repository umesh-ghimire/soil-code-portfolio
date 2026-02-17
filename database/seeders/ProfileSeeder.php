<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->insert([
            'name' => 'Umesh Ghimire',
            'title' => 'soil & code',
            'bio' => 'I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom.',
            'email' => 'umesh@example.com',
            'location' => 'from the himalayas',
            'greeting' => "Hi, I'm",
            'nepali_text' => 'माटो र माया',
            'years_experience' => 8,
            'total_projects' => 24,
            'open_source_contributions' => 12,
            'social_links' => json_encode([
                'github' => 'https://github.com/umesh',
                'linkedin' => 'https://linkedin.com/in/umesh',
                'twitter' => 'https://twitter.com/umesh',
                'dribbble' => 'https://dribbble.com/umesh',
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}