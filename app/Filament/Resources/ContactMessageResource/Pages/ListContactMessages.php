<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_all_read')
                ->label('Mark All as Read')
                ->icon('heroicon-o-envelope-open')
                ->color('success')
                ->action(function () {
                    $count = ContactMessage::where('is_read', false)->count();
                    ContactMessage::where('is_read', false)->update(['is_read' => true]);
                    
                    Notification::make()
                        ->title("{$count} messages marked as read")
                        ->success()
                        ->send();
                })
                ->visible(fn () => ContactMessage::where('is_read', false)->count() > 0),
            
            Actions\Action::make('export')
                ->label('Export Messages')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('gray')
                ->action(function () {
                    // Implement export functionality
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Contact Messages';
    }
}