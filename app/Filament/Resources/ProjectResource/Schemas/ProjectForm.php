<?php

namespace App\Filament\Resources\ProjectResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Project')
                ->tabs([
                    Tabs\Tab::make('Basic Information')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->required()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                    Forms\Components\TextInput::make('slug')
                                        ->required()
                                        ->maxLength(255)
                                        ->unique(ignoreRecord: true),
                                    Forms\Components\TextInput::make('client')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('role')
                                        ->maxLength(255),
                                    Forms\Components\DatePicker::make('project_date')
                                        ->maxDate(now()),
                                ]),
                            Forms\Components\Textarea::make('description')
                                ->required()
                                ->rows(3)
                                ->maxLength(65535),
                            Forms\Components\RichEditor::make('content')
                                ->columnSpanFull()
                                ->fileAttachmentsDirectory('projects/content'),
                        ]),
                    
                    Tabs\Tab::make('Media')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\FileUpload::make('featured_image')
                                        ->label('Featured Image')
                                        ->image()
                                        ->directory('projects/featured')
                                        ->visibility('public')
                                        ->imageEditor()
                                        ->maxSize(5120),
                                    
                                    Forms\Components\FileUpload::make('gallery')
                                        ->label('Project Gallery')
                                        ->multiple()
                                        ->image()
                                        ->directory('projects/gallery')
                                        ->visibility('public')
                                        ->maxFiles(10)
                                        ->reorderable()
                                        ->maxSize(3072),
                                ]),
                        ]),
                    
                    Tabs\Tab::make('Links & Technologies')
                        ->schema([
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('project_url')
                                        ->label('Live Project URL')
                                        ->url()
                                        ->maxLength(255)
                                        ->prefix('https://'),
                                    Forms\Components\TextInput::make('github_url')
                                        ->label('GitHub Repository')
                                        ->url()
                                        ->maxLength(255)
                                        ->prefix('https://'),
                                ]),
                            
                            Forms\Components\TagsInput::make('technologies')
                                ->placeholder('Add technology')
                                ->splitKeys(['Tab', ' '])
                                ->suggestions([
                                    'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 
                                    'Tailwind CSS', 'MySQL', 'PostgreSQL', 'Redis', 
                                    'Docker', 'AWS', 'Filament', 'Livewire', 'Alpine.js',
                                ]),
                        ]),
                    
                    // ===== NEW CASE STUDY TAB =====
                    Tabs\Tab::make('Case Study')
                        ->schema([
                            Forms\Components\Toggle::make('has_case_study')
                                ->label('Enable Case Study')
                                ->helperText('Turn on to add detailed case study')
                                ->reactive()
                                ->default(false),
                            
                            Forms\Components\Grid::make(2)
                                ->schema([
                                    Forms\Components\TextInput::make('case_study_title')
                                        ->label('Case Study Title')
                                        ->maxLength(255)
                                        ->placeholder('e.g., How we built a platform for 10,000+ farmers')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                    
                                    Forms\Components\TextInput::make('duration')
                                        ->label('Project Duration')
                                        ->maxLength(100)
                                        ->placeholder('e.g., 6 months, Q1-Q4 2024')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                    
                                    Forms\Components\TextInput::make('team_size')
                                        ->label('Team Size')
                                        ->maxLength(50)
                                        ->placeholder('e.g., 4 developers, 2 designers')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                ])
                                ->visible(fn ($get) => $get('has_case_study')),
                            
                            Forms\Components\RichEditor::make('case_study_content')
                                ->label('Full Case Study')
                                ->helperText('The complete story of this project')
                                ->fileAttachmentsDirectory('case-studies/content')
                                ->visible(fn ($get) => $get('has_case_study')),
                            
                            Forms\Components\Section::make('Challenge, Solution, Results')
                                ->schema([
                                    Forms\Components\Textarea::make('challenge')
                                        ->label('The Challenge')
                                        ->rows(3)
                                        ->placeholder('What problem were you trying to solve?')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                    
                                    Forms\Components\Textarea::make('solution')
                                        ->label('The Solution')
                                        ->rows(3)
                                        ->placeholder('How did you solve it?')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                    
                                    Forms\Components\Textarea::make('results')
                                        ->label('The Results')
                                        ->rows(3)
                                        ->placeholder('What were the outcomes? (numbers, impact)')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                ])
                                ->visible(fn ($get) => $get('has_case_study')),
                            
                            Forms\Components\Section::make('Testimonial')
                                ->schema([
                                    Forms\Components\Textarea::make('testimonial')
                                        ->label('Client/User Testimonial')
                                        ->rows(3)
                                        ->placeholder('What did the client say about this project?')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                    
                                    Forms\Components\TextInput::make('testimonial_author')
                                        ->label('Testimonial Author')
                                        ->maxLength(255)
                                        ->placeholder('e.g., John Doe, CEO of Company')
                                        ->visible(fn ($get) => $get('has_case_study')),
                                ])
                                ->visible(fn ($get) => $get('has_case_study')),
                            
                            Forms\Components\FileUpload::make('case_study_images')
                                ->label('Case Study Images')
                                ->multiple()
                                ->image()
                                ->directory('case-studies/images')
                                ->visibility('public')
                                ->maxFiles(5)
                                ->reorderable()
                                ->helperText('Additional images for the case study')
                                ->visible(fn ($get) => $get('has_case_study')),
                        ]),
                    
                    Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Featured Project')
                                        ->default(false),
                                    Forms\Components\Toggle::make('is_published')
                                        ->label('Published')
                                        ->default(true),
                                    Forms\Components\TextInput::make('sort_order')
                                        ->numeric()
                                        ->default(0),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
        ]);
    }
}