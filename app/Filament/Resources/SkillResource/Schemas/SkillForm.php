<?php

namespace App\Filament\Resources\SkillResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class SkillForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Skill Information')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true),
                            
                            Forms\Components\Select::make('category')
                                ->required()
                                ->options([
                                    'frontend' => 'Frontend',
                                    'backend' => 'Backend',
                                    'database' => 'Database',
                                    'devops' => 'DevOps',
                                    'tools' => 'Tools',
                                    'design' => 'Design',
                                    'soft' => 'Soft Skills',
                                ])
                                ->searchable(),
                            
                            Forms\Components\TextInput::make('icon')
                                ->label('Icon Class')
                                ->helperText('Enter Font Awesome or custom icon class')
                                ->placeholder('fab fa-laravel')
                                ->maxLength(255),
                            
                            Forms\Components\TextInput::make('proficiency')
                                ->numeric()
                                ->minValue(1)
                                ->maxValue(100)
                                ->suffix('%')
                                ->helperText('Optional: Skill proficiency percentage'),
                            
                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured Skill')
                                ->helperText('Show this skill in featured section')
                                ->default(false),
                            
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->helperText('Make this skill visible on the website')
                                ->default(true),
                            
                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()
                                ->default(0)
                                ->helperText('Lower numbers appear first'),
                        ]),
                ]),
        ]);
    }
}