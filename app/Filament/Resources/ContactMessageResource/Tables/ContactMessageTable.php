<?php

namespace App\Filament\Resources\ContactMessageResource\Tables;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminReplyNotification;

class ContactMessageTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->description(fn ($record) => $record->email),
                
                TextColumn::make('subject')
                    ->searchable()
                    ->limit(40)
                    ->wrap(),
                
                TextColumn::make('message')
                    ->limit(60)
                    ->wrap()
                    ->toggleable(),
                
                IconColumn::make('is_read')
                    ->boolean()
                    ->label('Read')
                    ->trueIcon('heroicon-o-envelope-open')
                    ->falseIcon('heroicon-o-envelope')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->sortable(),
                
                IconColumn::make('is_replied')
                    ->boolean()
                    ->label('Replied')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),
                
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->since()
                    ->badge()
                    ->color('gray'),
                
                TextColumn::make('ip_address')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->copyable()
                    ->copyMessage('IP copied'),
                
                TextColumn::make('user_agent')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(50),
            ])
            ->filters([
                SelectFilter::make('is_read')
                    ->label('Read Status')
                    ->options([
                        '0' => 'Unread',
                        '1' => 'Read',
                    ]),
                
                SelectFilter::make('is_replied')
                    ->label('Reply Status')
                    ->options([
                        '0' => 'Not Replied',
                        '1' => 'Replied',
                    ]),
                
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('from'),
                        DatePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->mutateRecordDataUsing(function (array $data): array {
                        $data['is_read'] = true;
                        return $data;
                    }),
                
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Mark as Read')
                    ->icon('heroicon-m-envelope-open')
                    ->color('success')
                    ->action(function ($record) {
                        $record->markAsRead();
                    })
                    ->visible(fn ($record) => !$record->is_read),
                
                // ===== FIXED: Changed icon from 'heroicon-m-reply' to 'heroicon-m-chat-bubble-left-ellipsis' =====
                Tables\Actions\Action::make('mark_as_replied')
    ->label('Reply via Email')
    ->icon('heroicon-m-chat-bubble-left-ellipsis')
    ->color('success')
    ->form([
        Textarea::make('reply_message')
            ->label('Your Reply Message')
            ->required()
            ->rows(8)
            ->helperText('This will be sent to the user\'s email address'),
    ])
    ->action(function ($record, array $data) {
        try {
            // Send email to the user with the corrected parameter names
            Mail::to($record->email)->send(new \App\Mail\AdminReplyNotification($record, $data['reply_message']));
            
            // Mark as replied in database
            $record->markAsReplied($data['reply_message']);
            
            // Show success notification
            \Filament\Notifications\Notification::make()
                ->title('Reply Sent Successfully')
                ->body("Your reply has been sent to {$record->email}")
                ->success()
                ->send();
        } catch (\Exception $e) {
            // Show error notification if email fails
            \Filament\Notifications\Notification::make()
                ->title('Failed to Send Reply')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    })
    ->visible(fn ($record) => !$record->is_replied),
                
                Tables\Actions\DeleteAction::make()
                    ->icon('heroicon-m-trash')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Mark as Read')
                        ->icon('heroicon-m-envelope-open')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each->markAsRead();
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->poll('10s')
            ->defaultPaginationPageOption(25);
    }
}