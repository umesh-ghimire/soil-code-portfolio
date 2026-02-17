<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ThemeSettingResource\Pages;
use App\Filament\Resources\ThemeSettingResource\Schemas\ThemeSettingForm;
use App\Filament\Resources\ThemeSettingResource\Tables\ThemeSettingTable;
use App\Models\ThemeSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ThemeSettingResource extends Resource
{
    protected static ?string $model = ThemeSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return ThemeSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ThemeSettingTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListThemeSettings::route('/'),
            'create' => Pages\CreateThemeSetting::route('/create'),
            'edit' => Pages\EditThemeSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }
}