<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ThemeSettingsSeeder::class,
            ProfileSeeder::class,
            BlogPostSeeder::class,
        ]);
        
        $this->command->info('Database seeded successfully!');
    }
}