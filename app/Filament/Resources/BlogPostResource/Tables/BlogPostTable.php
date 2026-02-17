<?php

namespace App\Filament\Resources\BlogPostResource\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

class BlogPostTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('featured_image')
                    ->square()
                    ->size(50),
                
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),
                
                TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'development' => 'info',
                        'design' => 'purple',
                        'tutorial' => 'success',
                        'news' => 'warning',
                        'thoughts' => 'gray',
                        'case-study' => 'primary',
                        default => 'gray',
                    })
                    ->toggleable(),
                
                TextColumn::make('tags')
                    ->badge()
                    ->separator(',')
                    ->limitList(2)
                    ->toggleable(isToggledHiddenByDefault: true),
                
                TextColumn::make('views_count')
                    ->numeric()
                    ->sortable()
                    ->label('Views')
                    ->icon('heroicon-m-eye')
                    ->toggleable(),
                
                IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Featured')
                    ->trueIcon('heroicon-o-star')
                    ->falseIcon('heroicon-o-x-mark')
                    ->trueColor('warning'),
                
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Status')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),
                
                TextColumn::make('published_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->label('Published'),
                
                TextColumn::make('created_at')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'development' => 'Development',
                        'design' => 'Design',
                        'tutorial' => 'Tutorial',
                        'news' => 'News',
                        'thoughts' => 'Thoughts',
                        'case-study' => 'Case Study',
                    ]),
                
                Tables\Filters\Filter::make('is_featured')
                    ->label('Featured')
                    ->query(fn ($query) => $query->where('is_featured', true)),
                
                Tables\Filters\Filter::make('published')
                    ->label('Published')
                    ->query(fn ($query) => $query->where('is_published', true)),
                
                Tables\Filters\Filter::make('drafts')
                    ->label('Drafts')
                    ->query(fn ($query) => $query->where('is_published', false)),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil')
                    ->color('warning'),
                
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-m-eye'),
                
                Tables\Actions\Action::make('preview')
                    ->label('Preview')
                    ->icon('heroicon-m-eye')
                    ->url(fn ($record) => route('blog.show', $record->slug))
                    ->openUrlInNewTab()
                    ->visible(fn ($record) => $record->is_published),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }
}