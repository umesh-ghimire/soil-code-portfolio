<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestMessagesWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                ContactMessage::query()
                    ->where('is_read', false)
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope'),
                
                Tables\Columns\TextColumn::make('subject')
                    ->limit(30)
                    ->wrap(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->badge()
                    ->color('gray'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->icon('heroicon-m-eye')
                    ->url(fn ($record) => route('filament.admin.resources.contact-messages.view', $record)),
                
                Tables\Actions\Action::make('mark_read')
                    ->icon('heroicon-m-envelope-open')
                    ->color('success')
                    ->action(fn ($record) => $record->markAsRead()),
            ])
            ->heading('Latest Unread Messages')
            ->defaultPaginationPageOption(5)
            ->emptyStateHeading('No unread messages')
            ->emptyStateIcon('heroicon-o-envelope')
            ->emptyStateDescription('All caught up!');
    }
}