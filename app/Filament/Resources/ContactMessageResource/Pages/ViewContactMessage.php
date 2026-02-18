<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_as_read')
                ->label('Mark as Read')
                ->icon('heroicon-m-envelope-open')
                ->color('success')
                ->action(function ($record) {
                    $record->markAsRead();
                })
                ->visible(fn ($record) => !$record->is_read),
            
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Mark as read when viewed
        if (!$this->record->is_read) {
            $this->record->markAsRead();
        }
        
        return $data;
    }
}