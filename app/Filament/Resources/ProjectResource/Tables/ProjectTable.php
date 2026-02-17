<?php

namespace App\Filament\Resources\ProjectResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class ProjectTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->square()
                    ->size(60),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),
                TextColumn::make('client')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('technologies')
                    ->badge()
                    ->separator(',')
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
                TextColumn::make('project_date')
                    ->date('M Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('is_featured')
                    ->label('Featured Status')
                    ->options([
                        '1' => 'Featured',
                        '0' => 'Not Featured',
                    ]),
                SelectFilter::make('is_published')
                    ->label('Publish Status')
                    ->options([
                        '1' => 'Published',
                        '0' => 'Draft',
                    ]),
                Filter::make('has_github')
                    ->label('Has GitHub')
                    ->query(fn ($query) => $query->whereNotNull('github_url')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil')
                    ->color('warning'),
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye'),
                Tables\Actions\Action::make('visit')
                    ->label('Visit')
                    ->icon('heroicon-m-globe-alt')
                    ->url(fn ($record) => $record->project_url)
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->project_url),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order');
    }
}