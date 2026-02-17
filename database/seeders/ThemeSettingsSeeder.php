<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemeSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero Section
            ['key' => 'hero_greeting', 'value' => "Hi, I'm", 'type' => 'text', 'group' => 'hero', 'sort_order' => 1],
            ['key' => 'hero_name', 'value' => 'Umesh Ghimire', 'type' => 'text', 'group' => 'hero', 'sort_order' => 2],
            ['key' => 'hero_title', 'value' => 'soil & code', 'type' => 'text', 'group' => 'hero', 'sort_order' => 3],
            ['key' => 'hero_description', 'value' => 'I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom.', 'type' => 'textarea', 'group' => 'hero', 'sort_order' => 4],
            ['key' => 'hero_badge', 'value' => 'from the himalayas', 'type' => 'text', 'group' => 'hero', 'sort_order' => 5],
            ['key' => 'hero_nepali_text', 'value' => 'माटो र माया', 'type' => 'text', 'group' => 'hero', 'sort_order' => 6],
            ['key' => 'hero_cta_primary', 'value' => 'view grown work', 'type' => 'text', 'group' => 'hero', 'sort_order' => 7],
            ['key' => 'hero_cta_secondary', 'value' => 'plant a seed', 'type' => 'text', 'group' => 'hero', 'sort_order' => 8],
            
            // Projects Section
            ['key' => 'projects_section_title', 'value' => 'cultivated projects', 'type' => 'text', 'group' => 'projects', 'sort_order' => 1],
            ['key' => 'project_link_text', 'value' => 'read case study', 'type' => 'text', 'group' => 'projects', 'sort_order' => 2],
            ['key' => 'show_projects_section', 'value' => '1', 'type' => 'boolean', 'group' => 'projects', 'sort_order' => 3],
            
            // Skills Section
            ['key' => 'skills_section_title', 'value' => 'toolshed', 'type' => 'text', 'group' => 'skills', 'sort_order' => 1],
            ['key' => 'more_skills_text', 'value' => 'more organic tools', 'type' => 'text', 'group' => 'skills', 'sort_order' => 2],
            ['key' => 'show_skills_section', 'value' => '1', 'type' => 'boolean', 'group' => 'skills', 'sort_order' => 3],
            
            // About Section
            ['key' => 'about_section_title', 'value' => 'माटोको मान्छे', 'type' => 'text', 'group' => 'about', 'sort_order' => 1],
            ['key' => 'about_description', 'value' => 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.', 'type' => 'textarea', 'group' => 'about', 'sort_order' => 2],
            ['key' => 'years_label', 'value' => 'years craft', 'type' => 'text', 'group' => 'about', 'sort_order' => 3],
            ['key' => 'projects_label', 'value' => 'projects', 'type' => 'text', 'group' => 'about', 'sort_order' => 4],
            ['key' => 'skills_label', 'value' => 'open source', 'type' => 'text', 'group' => 'about', 'sort_order' => 5],
            ['key' => 'show_about_section', 'value' => '1', 'type' => 'boolean', 'group' => 'about', 'sort_order' => 6],
            
            // Experience Section
            ['key' => 'show_experience_section', 'value' => '1', 'type' => 'boolean', 'group' => 'experience', 'sort_order' => 1],
            ['key' => 'experience_section_title', 'value' => 'recent seasons', 'type' => 'text', 'group' => 'experience', 'sort_order' => 2],
            
            // Contact Section
            ['key' => 'contact_section_title', 'value' => "let's grow together", 'type' => 'text', 'group' => 'contact', 'sort_order' => 1],
            ['key' => 'contact_subtitle', 'value' => "reach out, I reply within a moon cycle 🌙", 'type' => 'text', 'group' => 'contact', 'sort_order' => 2],
            ['key' => 'show_contact_section', 'value' => '1', 'type' => 'boolean', 'group' => 'contact', 'sort_order' => 3],
        ];

        foreach ($settings as $setting) {
            DB::table('theme_settings')->insert(array_merge($setting, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}