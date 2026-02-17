<?php

namespace App\Filament\Resources\ExperienceResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class ExperienceForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Experience')
                ->tabs([
                    Forms\Components\Tabs\Tab::make('Basic Information')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Senior Developer'),
                                    Forms\Components\TextInput::make('company')
                                        ->required()
                                        ->maxLength(255)
                                        ->placeholder('Company Name'),
                                    Forms\Components\TextInput::make('location')
                                        ->maxLength(255)
                                        ->placeholder('Remote / City, Country'),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Dates')
                        ->schema([
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\DatePicker::make('start_date')
                                        ->required()
                                        ->maxDate(now()),
                                    Forms\Components\DatePicker::make('end_date')
                                        ->after('start_date')
                                        ->nullable(),
                                    Forms\Components\Toggle::make('is_current')
                                        ->label('Current Position')
                                        ->reactive()
                                        ->afterStateUpdated(fn (callable $set) => $set('end_date', null))
                                        ->default(false),
                                ]),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Description')
                        ->schema([
                            Forms\Components\RichEditor::make('description')
                                ->required()
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'bulletList',
                                    'orderedList',
                                    'link',
                                ]),
                            
                            Forms\Components\Repeater::make('achievements')
                                ->schema([
                                    Forms\Components\Textarea::make('achievement')
                                        ->required()
                                        ->rows(2)
                                        ->maxLength(500),
                                ])
                                ->columnSpanFull()
                                ->defaultItems(0)
                                ->addActionLabel('Add Achievement'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Technologies')
                        ->schema([
                            Forms\Components\TagsInput::make('technologies')
                                ->placeholder('Add technology')
                                ->splitKeys(['Tab', ' '])
                                ->suggestions([
                                    'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React',
                                    'MySQL', 'PostgreSQL', 'Redis', 'Docker', 'AWS',
                                    'Tailwind CSS', 'Filament', 'Livewire', 'Alpine.js',
                                ])
                                ->columnSpanFull(),
                            
                            Forms\Components\FileUpload::make('company_logo')
                                ->label('Company Logo')
                                ->image()
                                ->directory('experiences/logos')
                                ->visibility('public')
                                ->imageEditor()
                                ->maxSize(1024)
                                ->helperText('Upload company logo. Max 1MB.'),
                        ]),
                    
                    Forms\Components\Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\Toggle::make('is_published')
                                        ->label('Published')
                                        ->helperText('Make this experience visible on the website')
                                        ->default(true),
                                    Forms\Components\TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0)
                                        ->helperText('Lower numbers appear first'),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}