<?php

namespace App\Filament\Resources\SiteSettingResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;

class SiteSettingTable
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
                    ->wrap()
                    ->formatStateUsing(fn ($state, $record) => match ($record->type) {
                        'boolean' => $state ? 'Yes' : 'No',
                        'json' => 'JSON Data',
                        'image' => 'Image File',
                        default => $state,
                    }),
                
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'text' => 'gray',
                        'textarea' => 'info',
                        'number' => 'warning',
                        'boolean' => 'success',
                        'json' => 'danger',
                        'image' => 'purple',
                        default => 'gray',
                    }),
                
                TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'gray',
                        'seo' => 'success',
                        'social' => 'info',
                        'contact' => 'warning',
                        'footer' => 'purple',
                        'analytics' => 'danger',
                        default => 'gray',
                    }),
                
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('updated_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->since()
                    ->toggleable(),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'general' => 'General',
                        'seo' => 'SEO',
                        'social' => 'Social Media',
                        'contact' => 'Contact',
                        'footer' => 'Footer',
                        'analytics' => 'Analytics',
                    ]),
                
                SelectFilter::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Text Area',
                        'number' => 'Number',
                        'boolean' => 'Yes/No',
                        'json' => 'JSON',
                        'image' => 'Image',
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
            ->defaultSort('group', 'asc');
    }
}