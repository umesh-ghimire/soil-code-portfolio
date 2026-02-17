<?php

namespace App\Filament\Resources\ContactMessageResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class ContactMessageForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Message Details')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->disabled(),
                            Forms\Components\TextInput::make('email')
                                ->email()
                                ->required()
                                ->maxLength(255)
                                ->disabled(),
                            Forms\Components\TextInput::make('phone')
                                ->tel()
                                ->maxLength(255)
                                ->disabled(),
                            Forms\Components\TextInput::make('subject')
                                ->required()
                                ->maxLength(255)
                                ->disabled(),
                        ]),
                    
                    Forms\Components\Textarea::make('message')
                        ->required()
                        ->rows(8)
                        ->disabled()
                        ->columnSpanFull(),
                    
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('ip_address')
                                ->disabled()
                                ->label('IP Address'),
                            Forms\Components\TextInput::make('user_agent')
                                ->disabled()
                                ->label('User Agent')
                                ->columnSpanFull(),
                        ]),
                ]),
            
            Forms\Components\Section::make('Reply')
                ->schema([
                    Forms\Components\Textarea::make('reply_message')
                        ->label('Your Reply')
                        ->rows(5)
                        ->placeholder('Type your reply here...')
                        ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\ViewRecord),
                    
                    Forms\Components\Placeholder::make('replied_at')
                        ->label('Replied On')
                        ->content(fn ($record) => $record->replied_at?->format('M d, Y H:i') ?? 'Not replied yet')
                        ->visible(fn ($record) => $record->is_replied),
                ])
                ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\ViewRecord),
            
            Forms\Components\Section::make('Status')
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\Toggle::make('is_read')
                                ->label('Read')
                                ->disabled()
                                ->inline(false),
                            Forms\Components\Toggle::make('is_replied')
                                ->label('Replied')
                                ->disabled()
                                ->inline(false),
                            Forms\Components\Placeholder::make('received_at')
                                ->label('Received')
                                ->content(fn ($record) => $record->created_at->format('M d, Y H:i')),
                        ]),
                ]),
        ]);
    }
}