<?php

namespace App\Filament\Resources\ContactMessageResource\Pages;

use App\Filament\Resources\ContactMessageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Notifications\Notification;

class CreateContactMessage extends ViewRecord
{
    protected static string $resource = ContactMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('reply')
                ->label('Reply')
                ->icon('heroicon-m-reply')
                ->color('success')
                ->form([
                    \Filament\Forms\Components\Textarea::make('reply_message')
                        ->label('Your Reply')
                        ->required()
                        ->rows(8),
                ])
                ->action(function (array $data) {
                    $this->record->markAsReplied($data['reply_message']);
                    
                    // Send email logic here
                    // Mail::to($this->record->email)->send(new ContactReply($this->record, $data['reply_message']));
                    
                    Notification::make()
                        ->title('Reply sent successfully')
                        ->success()
                        ->send();
                }),
            
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
                ->label('Back to List')
                ->icon('heroicon-m-arrow-left')
                ->url(ContactMessageResource::getUrl('index')),
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