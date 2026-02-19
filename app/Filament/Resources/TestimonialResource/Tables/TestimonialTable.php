<?php

namespace App\Filament\Resources\TestimonialResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class TestimonialTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(url('/images/default-avatar.png')),
                
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('position')
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('company')
                    ->searchable()
                    ->toggleable(),
                
                TextColumn::make('rating')
                    ->formatStateUsing(fn ($state) => str_repeat('⭐', $state ?? 5))
                    ->badge()
                    ->color('warning'),
                
                TextColumn::make('content')
                    ->limit(50)
                    ->wrap()
                    ->toggleable(),
                
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured')
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('warning'),
                
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_featured')
                    ->label('Featured')
                    ->options([
                        '1' => 'Featured',
                        '0' => 'Not Featured',
                    ]),
                Tables\Filters\SelectFilter::make('is_published')
                    ->label('Published')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
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
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }
}