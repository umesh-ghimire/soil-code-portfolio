<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Filament\Resources\ContactMessageResource\Pages\ListContactMessages;
use App\Filament\Resources\ContactMessageResource\Pages\ViewContactMessage;
use App\Filament\Resources\ContactMessageResource\Schemas\ContactMessageForm;
use App\Filament\Resources\ContactMessageResource\Tables\ContactMessageTable;
use App\Models\ContactMessage;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationGroup = 'Messages';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'subject';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?string $pluralModelLabel = 'Contact Messages';

    public static function form(Form $form): Form
    {
        return ContactMessageForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return ContactMessageTable::configure($table);
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
            'index' => ListContactMessages::route('/'),
            'view' => ViewContactMessage::route('/{record}'), // Changed from CreateContactMessage to ViewContactMessage
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('is_read', false)->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('is_read', false)->count() > 0 ? 'warning' : 'success';
    }

    public static function canCreate(): bool
    {
        return false;
    }
}