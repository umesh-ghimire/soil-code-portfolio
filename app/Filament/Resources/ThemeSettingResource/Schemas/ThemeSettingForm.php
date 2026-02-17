<?php

namespace App\Filament\Resources\ThemeSettingResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class ThemeSettingForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Theme Setting')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('key')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true)
                                ->disabled(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\EditRecord),
                            
                            Forms\Components\Select::make('type')
                                ->required()
                                ->options([
                                    'text' => 'Text',
                                    'textarea' => 'Textarea',
                                    'image' => 'Image',
                                    'boolean' => 'Yes/No',
                                    'integer' => 'Number',
                                    'json' => 'JSON',
                                ])
                                ->default('text')
                                ->reactive(),
                            
                            Forms\Components\Select::make('group')
                                ->required()
                                ->options([
                                    'general' => 'General',
                                    'hero' => 'Hero Section',
                                    'projects' => 'Projects Section',
                                    'skills' => 'Skills Section',
                                    'about' => 'About Section',
                                    'experience' => 'Experience Section',
                                    'contact' => 'Contact Section',
                                    'footer' => 'Footer',
                                ])
                                ->default('general'),
                            
                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()
                                ->default(0),
                        ]),
                    
                    // Dynamic field based on type
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\TextInput::make('value')
                                ->visible(fn ($get) => $get('type') === 'text'),
                            
                            Forms\Components\Textarea::make('value')
                                ->rows(3)
                                ->visible(fn ($get) => $get('type') === 'textarea'),
                            
                            Forms\Components\Toggle::make('value')
                                ->visible(fn ($get) => $get('type') === 'boolean'),
                            
                            Forms\Components\TextInput::make('value')
                                ->numeric()
                                ->visible(fn ($get) => $get('type') === 'integer'),
                            
                            Forms\Components\FileUpload::make('value')
                                ->image()
                                ->directory('theme')
                                ->visibility('public')
                                ->visible(fn ($get) => $get('type') === 'image'),
                            
                            Forms\Components\Textarea::make('value')
                                ->rows(5)
                                ->json()
                                ->visible(fn ($get) => $get('type') === 'json'),
                        ])
                        ->columnSpanFull(),
                ]),
        ]);
    }
}