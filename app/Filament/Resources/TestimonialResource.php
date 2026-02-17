<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Filament\Resources\TestimonialResource\Schemas\TestimonialForm;
use App\Filament\Resources\TestimonialResource\Tables\TestimonialTable;
use App\Models\Testimonial;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return TestimonialForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return TestimonialTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }
}