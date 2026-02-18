<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('profiles')->updateOrInsert(
            ['email' => 'umesh@example.com'],
            [
                'name' => 'Umesh Ghimire',
                'title' => 'soil & code',
                'bio' => 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.',
                'email' => 'umesh@example.com',
                'location' => 'Lalitpur, Nepal',
                'greeting' => "Hi, I'm",
                'nepali_text' => 'माटो र माया',
                'years_experience' => 8,
                'total_projects' => 24,
                'open_source_contributions' => 12,
                'social_links' => json_encode([
                    ['platform' => 'github', 'url' => 'https://github.com/umesh'],
                    ['platform' => 'linkedin', 'url' => 'https://linkedin.com/in/umesh'],
                    ['platform' => 'twitter', 'url' => 'https://twitter.com/umesh'],
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        
        $this->command->info('Profile seeded successfully!');
    }
}