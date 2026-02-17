<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Filament\Resources\SiteSettingResource\Schemas\SiteSettingForm;
use App\Filament\Resources\SiteSettingResource\Tables\SiteSettingTable;
use App\Models\SiteSetting;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'key';

    protected static ?string $navigationLabel = 'Site Settings';

    public static function form(Form $form): Form
    {
        return SiteSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return SiteSettingTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }
}