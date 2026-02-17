<?php

namespace App\Filament\Resources\ProfileResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class ProfileForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Profile')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Personal Information')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('Umesh Ghimire'),
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('soil & code'),
                                    Forms\Components\TextInput::make('greeting')
                                        ->required()
                                        ->maxLength(255)
                                        ->default("Hi, I'm"),
                                    Forms\Components\TextInput::make('nepali_text')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('माटो र माया'),
                                    Forms\Components\TextInput::make('email')
                                        ->email()
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('phone')
                                        ->tel()
                                        ->maxLength(255)
                                        ->placeholder('+977 98XXXXXXXX'),
                                    Forms\Components\TextInput::make('location')
                                        ->required()
                                        ->maxLength(255)
                                        ->default('from the himalayas'),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Bio & About')
                        ->schema([
                            Forms\Components\Textarea::make('bio')
                                ->rows(5)
                                ->required()
                                ->maxLength(65535)
                                ->default('I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom. Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Statistics')
                        ->schema([
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\TextInput::make('years_experience')
                                        ->numeric()
                                        ->default(8)
                                        ->suffix('years')
                                        ->required(),
                                    Forms\Components\TextInput::make('total_projects')
                                        ->numeric()
                                        ->default(24)
                                        ->suffix('projects')
                                        ->required(),
                                    Forms\Components\TextInput::make('open_source_contributions')
                                        ->numeric()
                                        ->default(12)
                                        ->suffix('contributions')
                                        ->required(),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\FileUpload::make('profile_image')
                                        ->label('Profile Image')
                                        ->image()
                                        ->directory('profiles')
                                        ->visibility('public')
                                        ->imageEditor()
                                        ->imageEditorAspectRatios([
                                            '1:1',
                                            '16:9',
                                            '4:3',
                                        ])
                                        ->maxSize(2048)
                                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                        ->helperText('Upload a square image for best results. Max 2MB.'),
                                    
                                    Forms\Components\FileUpload::make('resume_file')
                                        ->label('Resume/CV')
                                        ->directory('resumes')
                                        ->acceptedFileTypes(['application/pdf'])
                                        ->maxSize(5120)
                                        ->helperText('Upload your resume in PDF format. Max 5MB.'),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Social Links')
                        ->schema([
                            Forms\Components\Repeater::make('social_links')
                                ->schema([
                                    Forms\Components\Select::make('platform')
                                        ->options([
                                            'github' => 'GitHub',
                                            'linkedin' => 'LinkedIn',
                                            'twitter' => 'Twitter/X',
                                            'dribbble' => 'Dribbble',
                                            'behance' => 'Behance',
                                            'instagram' => 'Instagram',
                                            'youtube' => 'YouTube',
                                            'medium' => 'Medium',
                                            'devto' => 'Dev.to',
                                            'stackoverflow' => 'Stack Overflow',
                                        ])
                                        ->required()
                                        ->searchable(),
                                    Forms\Components\TextInput::make('url')
                                        ->url()
                                        ->required()
                                        ->maxLength(255)
                                        ->prefix('https://'),
                                ])
                                ->columns(2)
                                ->defaultItems(3)
                                ->maxItems(10)
                                ->addActionLabel('Add Social Link')
                                ->reorderable(false)
                                ->grid(2),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}