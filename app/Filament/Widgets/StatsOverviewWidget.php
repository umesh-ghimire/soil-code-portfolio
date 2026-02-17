<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\Profile;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $profile = Profile::first();
        
        return [
            Stat::make('Total Projects', Project::count())
                ->description($profile?->total_projects ? $profile->total_projects . ' featured' : 'No projects yet')
                ->descriptionIcon('heroicon-m-folder')
                ->color('success')
                ->chart([7, 3, 5, 2, 8, 4, 6]),
            
            Stat::make('Blog Posts', BlogPost::count())
                ->description(BlogPost::where('is_published', true)->count() . ' published')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning')
                ->chart([4, 7, 2, 5, 3, 6, 4]),
            
            Stat::make('Contact Messages', ContactMessage::count())
                ->description(ContactMessage::where('is_read', false)->count() . ' unread')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('danger')
                ->chart([2, 4, 3, 7, 5, 3, 2]),
            
            Stat::make('Years Experience', $profile?->years_experience ?? 0)
                ->description('Crafting digital solutions')
                ->descriptionIcon('heroicon-m-clock')
                ->color('info'),
        ];
    }
}