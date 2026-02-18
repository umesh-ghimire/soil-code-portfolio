<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\User;
use Carbon\Carbon;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $user = User::create([
                'name' => 'Umesh Ghimire',
                'email' => 'umesh@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        
        $posts = [
            [
                'title' => 'The Art of Slow Code',
                'content' => '<p>In the hills of Dhankuta, farmers don\'t rush the harvest. They watch, they wait, they listen to the soil. I\'ve come to believe that code, like rice, needs time to grow.</p><p>When I first started programming, I wanted to build everything at once. I\'d stay up late, fueled by instant noodles and ambition, pushing commits like a farmer planting seeds in a storm. But the code I wrote then was brittle—it cracked under pressure, it didn\'t weather well.</p><p>Slow code is code that thinks. It considers the next developer, the user in a low-bandwidth village, the teenager on a hand-me-down laptop. It\'s code that breathes.</p>',
                'excerpt' => 'In the hills of Dhankuta, farmers don\'t rush the harvest. I\'ve come to believe that code, like rice, needs time to grow.',
                'category' => 'reflections',
                'tags' => json_encode(['slow-code', 'philosophy', 'craft']),
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(5),
                'views_count' => 342,
                'user_id' => $user->id,
            ],
            [
                'title' => 'Building for the Next Billion Users',
                'content' => '<p>The next billion users won\'t have fiber optic. They won\'t have the latest iPhone. They\'ll have spotty connections and devices that are already old.</p><p>Building for them means rethinking everything we take for granted. It means progressive enhancement isn\'t a nice-to-have—it\'s the only way. It means measuring performance not in milliseconds but in moonshots—can they load your app before the moon rises?</p>',
                'excerpt' => 'The next billion users won\'t have fiber optic. Building for them means rethinking everything.',
                'category' => 'development',
                'tags' => json_encode(['web-dev', 'accessibility', 'performance']),
                'is_featured' => false,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(12),
                'views_count' => 187,
                'user_id' => $user->id,
            ],
            [
                'title' => 'माटोको मान्छे: A Reflection on Identity',
                'content' => '<p>They call me "माटोको मान्छे"—a person of the soil. It\'s a term my grandmother used for farmers who worked the same terraces for generations. When she first called me that, I was confused. I write code, I told her. I work with computers, not clay.</p><p>But she smiled and said, "You shape ideas the way we shape earth. You plant seeds that grow into things people use. You\'re a farmer, just with different tools."</p>',
                'excerpt' => 'They call me "माटोको मान्छे"—a person of the soil. I\'ve come to understand what that means.',
                'category' => 'personal',
                'tags' => json_encode(['identity', 'nepal', 'story']),
                'is_featured' => true,
                'is_published' => true,
                'published_at' => Carbon::now()->subDays(20),
                'views_count' => 521,
                'user_id' => $user->id,
            ],
        ];
        
        foreach ($posts as $post) {
            BlogPost::create($post);
        }
        
        $this->command->info('Blog posts seeded successfully!');
    }
}