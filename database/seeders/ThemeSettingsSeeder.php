<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            ['key' => 'projects_page_title', 'value' => 'cultivated projects', 'type' => 'text', 'group' => 'projects', 'sort_order' => 4],
            ['key' => 'projects_page_subtitle', 'value' => 'Each project is a seed planted, watered, and tended with care. Here\'s the harvest.', 'type' => 'text', 'group' => 'projects', 'sort_order' => 5],
            
            // Skills Section
            ['key' => 'skills_section_title', 'value' => 'toolshed', 'type' => 'text', 'group' => 'skills', 'sort_order' => 1],
            ['key' => 'more_skills_text', 'value' => 'more organic tools', 'type' => 'text', 'group' => 'skills', 'sort_order' => 2],
            ['key' => 'show_skills_section', 'value' => '1', 'type' => 'boolean', 'group' => 'skills', 'sort_order' => 3],
            ['key' => 'skills_page_title', 'value' => 'toolshed', 'type' => 'text', 'group' => 'skills', 'sort_order' => 4],
            ['key' => 'skills_subtitle', 'value' => 'Tools I\'ve worn down, sharpened, and learned to trust. Some are new, some are heirlooms.', 'type' => 'text', 'group' => 'skills', 'sort_order' => 5],
            ['key' => 'skills_quote', 'value' => 'A good farmer knows their tools not by their brand, but by the weight in their hand.', 'type' => 'text', 'group' => 'skills', 'sort_order' => 6],
            ['key' => 'skills_quote_author', 'value' => '— Nepali farming wisdom', 'type' => 'text', 'group' => 'skills', 'sort_order' => 7],
            
            // About Section
            ['key' => 'about_section_title', 'value' => 'माटोको मान्छे', 'type' => 'text', 'group' => 'about', 'sort_order' => 1],
            ['key' => 'about_description', 'value' => 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.', 'type' => 'textarea', 'group' => 'about', 'sort_order' => 2],
            ['key' => 'years_label', 'value' => 'years craft', 'type' => 'text', 'group' => 'about', 'sort_order' => 3],
            ['key' => 'projects_label', 'value' => 'projects', 'type' => 'text', 'group' => 'about', 'sort_order' => 4],
            ['key' => 'skills_label', 'value' => 'open source', 'type' => 'text', 'group' => 'about', 'sort_order' => 5],
            ['key' => 'show_about_section', 'value' => '1', 'type' => 'boolean', 'group' => 'about', 'sort_order' => 6],
            ['key' => 'about_page_title', 'value' => 'about माटोको मान्छे', 'type' => 'text', 'group' => 'about', 'sort_order' => 7],
            ['key' => 'about_subtitle', 'value' => 'A maker, mentor, and mountain dweller who believes in slow technology.', 'type' => 'text', 'group' => 'about', 'sort_order' => 8],
            
            // Experience Section
            ['key' => 'show_experience_section', 'value' => '1', 'type' => 'boolean', 'group' => 'experience', 'sort_order' => 1],
            ['key' => 'experience_section_title', 'value' => 'recent seasons', 'type' => 'text', 'group' => 'experience', 'sort_order' => 2],
            ['key' => 'experience_page_title', 'value' => 'roots & branches', 'type' => 'text', 'group' => 'experience', 'sort_order' => 3],
            ['key' => 'experience_subtitle', 'value' => 'A journey through seasons of growth, from first lines of code to community-built systems.', 'type' => 'text', 'group' => 'experience', 'sort_order' => 4],
            ['key' => 'experience_quote', 'value' => 'The strongest roots grow slowly, reaching deep into the soil before breaking through to the sun.', 'type' => 'text', 'group' => 'experience', 'sort_order' => 5],
            ['key' => 'experience_quote_author', 'value' => '— Nepali farming wisdom', 'type' => 'text', 'group' => 'experience', 'sort_order' => 6],
            
            // Blog Section
            ['key' => 'show_blog_section', 'value' => '1', 'type' => 'boolean', 'group' => 'blog', 'sort_order' => 1],
            ['key' => 'blog_section_title', 'value' => 'field notes', 'type' => 'text', 'group' => 'blog', 'sort_order' => 2],
            ['key' => 'view_all_posts_text', 'value' => 'read all field notes', 'type' => 'text', 'group' => 'blog', 'sort_order' => 3],
            ['key' => 'read_more_text', 'value' => 'read more', 'type' => 'text', 'group' => 'blog', 'sort_order' => 4],
            
            // Contact Section
            ['key' => 'contact_section_title', 'value' => "let's grow together", 'type' => 'text', 'group' => 'contact', 'sort_order' => 1],
            ['key' => 'contact_subtitle', 'value' => "reach out, I reply within a moon cycle 🌙", 'type' => 'text', 'group' => 'contact', 'sort_order' => 2],
            ['key' => 'show_contact_section', 'value' => '1', 'type' => 'boolean', 'group' => 'contact', 'sort_order' => 3],
            ['key' => 'contact_page_title', 'value' => 'plant a seed', 'type' => 'text', 'group' => 'contact', 'sort_order' => 4],
            ['key' => 'response_time', 'value' => '1-28 days (I read everything)', 'type' => 'text', 'group' => 'contact', 'sort_order' => 5],
            ['key' => 'response_commitment', 'value' => '🌙 one moon cycle guarantee', 'type' => 'text', 'group' => 'contact', 'sort_order' => 6],
            ['key' => 'response_detail', 'value' => 'I read every message with care and will reply within a moon cycle. Your words matter to me.', 'type' => 'text', 'group' => 'contact', 'sort_order' => 7],
            
            // Site Settings
            ['key' => 'site_title', 'value' => 'Umesh Ghimire - Soil & Code', 'type' => 'text', 'group' => 'site', 'sort_order' => 1],
            ['key' => 'meta_description', 'value' => 'Personal portfolio blending organic wisdom with digital craft', 'type' => 'text', 'group' => 'site', 'sort_order' => 2],
            ['key' => 'meta_keywords', 'value' => 'portfolio, developer, himalayas, soil and code', 'type' => 'text', 'group' => 'site', 'sort_order' => 3],
            ['key' => 'site_author', 'value' => 'Umesh Ghimire', 'type' => 'text', 'group' => 'site', 'sort_order' => 4],
            ['key' => 'footer_tagline', 'value' => 'hand‑coiled code potter', 'type' => 'text', 'group' => 'site', 'sort_order' => 5],
            ['key' => 'copyright_text', 'value' => '© 2025 Umesh Ghimire — growing digital roots', 'type' => 'text', 'group' => 'site', 'sort_order' => 6],
        ];

        foreach ($settings as $setting) {
            DB::table('theme_settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ])
            );
        }
        
        $this->command->info('Theme settings seeded successfully!');
    }
}