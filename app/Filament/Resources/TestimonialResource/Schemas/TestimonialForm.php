<?php

namespace App\Filament\Resources\TestimonialResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;

class TestimonialForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Testimonial Information')
                ->schema([
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('e.g., Sita Sharma'),
                            
                            Forms\Components\TextInput::make('position')
                                ->maxLength(255)
                                ->placeholder('e.g., Program Director'),
                            
                            Forms\Components\TextInput::make('company')
                                ->maxLength(255)
                                ->placeholder('e.g., Code for Nepal'),
                            
                            Forms\Components\Select::make('rating')
                                ->options([
                                    1 => '⭐',
                                    2 => '⭐⭐',
                                    3 => '⭐⭐⭐',
                                    4 => '⭐⭐⭐⭐',
                                    5 => '⭐⭐⭐⭐⭐',
                                ])
                                ->default(5)
                                ->required(),
                        ]),
                    
                    Forms\Components\Textarea::make('content')
                        ->required()
                        ->rows(4)
                        ->maxLength(65535)
                        ->placeholder('Enter testimonial content...'),
                    
                    Forms\Components\FileUpload::make('avatar')
                        ->label('Avatar Image')
                        ->image()
                        ->directory('testimonials')
                        ->visibility('public')
                        ->imageEditor()
                        ->maxSize(2048)
                        ->helperText('Optional: Upload a photo of the person. Max 2MB.'),
                ]),
            
            Forms\Components\Section::make('Settings')
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured Testimonial')
                                ->helperText('Show this testimonial in featured section')
                                ->default(false),
                            
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->helperText('Make this testimonial visible on the website')
                                ->default(true),
                            
                            // ===== FIXED: Add default value for sort_order =====
                            Forms\Components\TextInput::make('sort_order')
                                ->numeric()
                                ->default(0)  // ADD THIS LINE
                                ->helperText('Lower numbers appear first'),
                        ]),
                ]),
        ]);
    }
}