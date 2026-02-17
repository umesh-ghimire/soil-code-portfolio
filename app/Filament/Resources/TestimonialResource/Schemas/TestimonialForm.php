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
                                ->placeholder('John Doe'),
                            
                            Forms\Components\TextInput::make('position')
                                ->maxLength(255)
                                ->placeholder('CEO'),
                            
                            Forms\Components\TextInput::make('company')
                                ->maxLength(255)
                                ->placeholder('Company Name'),
                            
                            Forms\Components\Select::make('rating')
                                ->options([
                                    5 => '5 Stars',
                                    4 => '4 Stars',
                                    3 => '3 Stars',
                                    2 => '2 Stars',
                                    1 => '1 Star',
                                ])
                                ->native(false),
                        ]),
                    
                    Forms\Components\Textarea::make('content')
                        ->required()
                        ->rows(4)
                        ->maxLength(1000)
                        ->placeholder('Write the testimonial content here...'),
                    
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\FileUpload::make('avatar')
                                ->label('Avatar')
                                ->image()
                                ->directory('testimonials')
                                ->visibility('public')
                                ->imageEditor()
                                ->imageEditorAspectRatios(['1:1'])
                                ->maxSize(1024)
                                ->helperText('Square image recommended. Max 1MB.'),
                            
                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured Testimonial')
                                ->helperText('Show this testimonial in featured section')
                                ->default(false),
                            
                            Forms\Components\Toggle::make('is_published')
                                ->label('Published')
                                ->helperText('Make this testimonial visible on the website')
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