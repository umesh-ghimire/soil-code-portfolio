<?php

namespace App\Filament\Resources\ThemeSettingResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ThemeSettingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->copyable()
                    ->copyMessage('Key copied'),
                
                TextColumn::make('value')
                    ->limit(50)
                    ->formatStateUsing(fn ($record) => match ($record->type) {
                        'boolean' => $record->value ? 'Yes' : 'No',
                        'image' => '📷 Image',
                        'json' => '🔧 JSON Data',
                        default => $record->value,
                    }),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'info',
                        'image' => 'warning',
                        'boolean' => 'success',
                        'integer' => 'primary',
                        'json' => 'danger',
                        default => 'gray',
                    }),
                
                TextColumn::make('group')
                    ->badge()
                    ->color('secondary'),
                
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                
                TextColumn::make('updated_at')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'hero' => 'Hero Section',
                        'projects' => 'Projects Section',
                        'skills' => 'Skills Section',
                        'about' => 'About Section',
                        'experience' => 'Experience Section',
                        'contact' => 'Contact Section',
                        'footer' => 'Footer',
                    ]),
                
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'image' => 'Image',
                        'boolean' => 'Yes/No',
                        'integer' => 'Number',
                        'json' => 'JSON',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('group', 'asc')
            ->reorderable('sort_order');
    }
}