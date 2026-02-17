<?php

namespace App\Filament\Resources\ThemeSettingResource\Pages;

use App\Filament\Resources\ThemeSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateThemeSetting extends CreateRecord
{
    protected static string $resource = ThemeSettingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}