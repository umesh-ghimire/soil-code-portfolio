<?php

namespace App\Filament\Resources\ProjectResource\Schemas;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use App\Models\Project;
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
                                    
                                    // ===== FIXED: Client field - Now using TextInput =====
                                    Forms\Components\TextInput::make('client')
                                        ->maxLength(255)
                                        ->placeholder('Enter client name (e.g., Acme Corp, Government of Nepal, etc.)')
                                        ->helperText('Type any client name - new ones will be saved automatically')
                                        ->datalist(function () {
                                            // Show previous clients as suggestions
                                            return Project::whereNotNull('client')
                                                ->distinct()
                                                ->pluck('client')
                                                ->toArray();
                                        }),
                                    
                                    Forms\Components\TextInput::make('role')
                                        ->maxLength(255)
                                        ->placeholder('e.g., Lead Developer, Consultant')
                                        ->helperText('Your role in this project'),
                                    
                                    Forms\Components\DatePicker::make('project_date')
                                        ->maxDate(now())
                                        ->placeholder('Select project date'),
                                ]),
                            
                            Forms\Components\Textarea::make('description')
                                ->required()
                                ->rows(3)
                                ->maxLength(65535)
                                ->placeholder('Brief description of the project'),
                            
                            Forms\Components\RichEditor::make('content')
                                ->required()
                                ->columnSpanFull()
                                ->fileAttachmentsDirectory('projects/content')
                                ->toolbarButtons([
                                    'blockquote',
                                    'bold',
                                    'bulletList',
                                    'codeBlock',
                                    'h2',
                                    'h3',
                                    'italic',
                                    'link',
                                    'orderedList',
                                    'redo',
                                    'strike',
                                    'underline',
                                    'undo',
                                ])
                                ->placeholder('Detailed project description, challenges, solutions, etc.'),
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
                                        ->imageEditorAspectRatios([
                                            '16:9',
                                            '4:3',
                                            '1:1',
                                        ])
                                        ->maxSize(5120)
                                        ->helperText('Recommended size: 1200x630px. Max 5MB.'),
                                    
                                    Forms\Components\FileUpload::make('gallery')
                                        ->label('Project Gallery')
                                        ->multiple()
                                        ->image()
                                        ->directory('projects/gallery')
                                        ->visibility('public')
                                        ->imageEditor()
                                        ->maxFiles(10)
                                        ->reorderable()
                                        ->maxSize(3072)
                                        ->helperText('Upload multiple images. Max 3MB each.'),
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
                                        ->prefix('https://')
                                        ->placeholder('example.com'),
                                    
                                    Forms\Components\TextInput::make('github_url')
                                        ->label('GitHub Repository')
                                        ->url()
                                        ->maxLength(255)
                                        ->prefix('https://')
                                        ->placeholder('github.com/username/repo'),
                                ]),
                            
                            Forms\Components\TagsInput::make('technologies')
                                ->placeholder('Add technology')
                                ->splitKeys(['Tab', ' ', 'Enter'])
                                ->suggestions([
                                    'Laravel', 'PHP', 'JavaScript', 'Vue.js', 'React', 
                                    'Tailwind CSS', 'MySQL', 'PostgreSQL', 'Redis', 
                                    'Docker', 'AWS', 'Filament', 'Livewire', 'Alpine.js',
                                    'HTML', 'CSS', 'Python', 'Node.js', 'MongoDB',
                                    'TypeScript', 'Next.js', 'Nuxt.js', 'GraphQL',
                                    'REST API', 'jQuery', 'Bootstrap', 'SASS',
                                ])
                                ->helperText('Type and press Enter/Tab to add technologies'),
                        ]),
                    
                    Tabs\Tab::make('Settings')
                        ->schema([
                            Forms\Components\Grid::make(3)
                                ->schema([
                                    Forms\Components\Toggle::make('is_featured')
                                        ->label('Featured Project')
                                        ->helperText('Show this project in featured section')
                                        ->default(false),
                                    
                                    Forms\Components\Toggle::make('is_published')
                                        ->label('Published')
                                        ->helperText('Make this project visible on the website')
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