<?php

namespace App\Filament\Resources\ProfileResource\Pages;

use App\Filament\Resources\ProfileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Route; // ADD THIS IMPORT

class EditProfile extends EditRecord
{
    protected static string $resource = ProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            
            // ===== FIXED: Added proper imports and syntax =====
            Actions\Action::make('generate_resume')
                ->label('Generate Resume')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->url(function () {
                    // Check which resume route exists
                    if (Route::has('resume.one-page')) {
                        return route('resume.one-page');
                    } elseif (Route::has('resume.download-simple')) {
                        return route('resume.download-simple');
                    } elseif (Route::has('resume.download')) {
                        return route('resume.download');
                    }
                    // Fallback - return null to disable the button
                    return null;
                })
                ->openUrlInNewTab()
                ->visible(function () {
                    // Only show if at least one resume route exists
                    return Route::has('resume.one-page'); 
                        //    Route::has('resume.download-simple') || 
                        //    Route::has('resume.download');
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterSave(): void
    {
        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }
}