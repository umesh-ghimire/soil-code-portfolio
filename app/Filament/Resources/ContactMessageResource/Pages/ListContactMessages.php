<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Notification;

class ListContactMessages extends ListRecords
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_all_read')
                ->label('Mark All as Read')
                ->icon('heroicon-m-envelope-open')
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
        ];
    }
}