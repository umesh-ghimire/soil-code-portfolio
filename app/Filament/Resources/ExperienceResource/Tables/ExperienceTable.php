<?php

namespace App\Filament\Resources\ExperienceResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class ExperienceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('company_logo')
                    ->square()
                    ->size(40)
                    ->defaultImageUrl(url('/images/default-company.png')),
                
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                
                TextColumn::make('company')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('location')
                    ->searchable()
                    ->icon('heroicon-m-map-pin')
                    ->toggleable(),
                
                TextColumn::make('duration')
                    ->badge()
                    ->color('info')
                    ->getStateUsing(fn ($record) => $record->duration),
                
                TextColumn::make('technologies')
                    ->badge()
                    ->separator(',')
                    ->limitList(3)
                    ->toggleable(),
                
                IconColumn::make('is_current')
                    ->boolean()
                    ->label('Current')
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('gray'),
                
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->toggleable(),
                
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('is_current')
                    ->label('Current Positions')
                    ->query(fn ($query) => $query->where('is_current', true)),
                
                Tables\Filters\Filter::make('past_positions')
                    ->label('Past Positions')
                    ->query(fn ($query) => $query->where('is_current', false)),
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
            ->defaultSort('start_date', 'desc')
            ->reorderable('sort_order');
    }
}