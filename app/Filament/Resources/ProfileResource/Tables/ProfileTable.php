<?php

namespace App\Filament\Resources\ProfileResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class ProfileTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_image')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->copyable()
                    ->copyMessage('Email address copied'),
                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->icon('heroicon-m-map-pin'),
                Tables\Columns\TextColumn::make('years_experience')
                    ->numeric()
                    ->sortable()
                    ->suffix(' yrs')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('total_projects')
                    ->numeric()
                    ->sortable()
                    ->suffix(' projects')
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('has_social_links')
                    ->query(fn ($query) => $query->whereNotNull('social_links')),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil')
                    ->color('warning'),
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No profile found')
            ->emptyStateDescription('Create your profile to get started.')
            ->emptyStateIcon('heroicon-o-user-circle');
    }
}